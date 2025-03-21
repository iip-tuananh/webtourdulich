<?php

namespace App\Http\Controllers\Front;

use App\Helpers\FileHelper;
use App\Http\Traits\ResponseTrait;
use App\Model\Admin\Block;
use App\Model\Admin\Category;
use App\Model\Admin\CategorySpecial;
use App\Model\Admin\Config;
use App\Model\Admin\Gallery;
use App\Model\Admin\Product;
use App\Model\Admin\Tour;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Response;
use App\Http\Controllers\Controller;
use App\Model\Admin\Banner;
use App\Model\Admin\Contact;
use App\Model\Admin\DesignDetail;
use App\Model\Admin\DesignOrder;
use App\Model\Admin\Partner;
use App\Model\Admin\Post;
use App\Model\Admin\PostCategory;
use App\Model\Admin\ProductRate;
use App\Model\Admin\Review;
use App\Model\Admin\Voucher;
use DB;
use Mail;
use SluggableScopeHelpers;

class FrontController extends Controller
{
    use ResponseTrait;

    public $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function homePage() {
        // danh mục đặc biệt
        $categoriesSpecial = CategorySpecial::query()->with(['tours' => function($q) {
            $q->where('tours.status', Tour::XUAT_BAN);
        }, 'tours.image'])
            ->where('show_home_page', 1)
            ->orderBy('order_number')->get();

        // danh mục tour
        $categoryParents = Category::with([
            'childs' => function($q) {
                $q->where('show_home_page', 1);
            },
            'childs.tours' => function ($q2) {
                $q2->where('status', Tour::XUAT_BAN)->orderBy('created_at', 'desc');
            }
        ])->where([
            'show_home_page' => 1,
            'parent_id' => 0
        ])->get();

        foreach ($categoryParents as $category) {
            $category->tours = $category->childs->flatMap(function($child) {
                return $child->tours;
            });
        }

        // thư viện ảnh
        $galleries = Gallery::query()->with(['image'])->latest()->get();

        // nhân viên hỗ trợ
        $supportsStaff = Partner::query()->with(['image'])->get();

        $banners = Banner::query()->with('image')->latest()->get();

        $newBlogs = Post::with(['image'])->where(['status'=>1])
            ->orderBy('id','DESC')
            ->select(['id','name','slug'])
            ->limit(5)->get();

        return view('site.home', compact('categoriesSpecial', 'categoryParents', 'galleries', 'supportsStaff', 'banners', 'newBlogs'));
    }

    public function tourCategory(Request $request, $slug, $childSlug = null) {
        $categorySpecial = CategorySpecial::findBySlug($slug);

        if($categorySpecial) {
            $tours = $categorySpecial->tours()->where('status', Tour::XUAT_BAN)->latest()->paginate(10);
            $category = $categorySpecial;
        } else {
            if($childSlug) {
                $childCategory = Category::findBySlug($childSlug);
                $tours = Tour::query()->where(['status' => 1, 'cate_id' => $childCategory->id])->latest()->paginate(10);
                $category = $childCategory;
            } else {
                $categoryParent = Category::findBySlug($slug);
                $child_categories = $this->categoryService->getChildCategory($categoryParent, 1);
                $tours = Tour::query()->whereIn('cate_id', $child_categories->pluck('id')->toArray())
                    ->where('status', Tour::XUAT_BAN)->latest()->paginate(10);
                $category = $categoryParent;
            }
        }

        return view('site.tours.tour_category', compact('tours', 'category'));
    }

    public function searchTour(Request $request) {
        $departure = $request->query('departure');
        $destination = $request->query('destination');
        $tourName  = $request->query('tourName');

        $query = Tour::query();

        if (!empty($departure)) {
            $query->where('start_off', 'like', '%' . $departure . '%');
        }

        if (!empty($destination)) {
            $query->where('destination', 'like', '%' . $destination . '%');
        }

        if (!empty($tourName)) {
            $query->orWhere(function($q) use ($tourName) {
                $q->where('title', 'like', '%' . $tourName . '%')
                    ->orWhere('title_short', 'like', '%' . $tourName . '%');
            });
        }

        $results = $query->get();

        return view('site.tours.result_search', ['results' => $results]);
    }

    public function tourDetail(Request $request, $slug) {
        $tour = Tour::with(['image', 'category.image', 'category.parent.image'])->where('slug', $slug)->first();
        $tourSuggest = Tour::query()->with(['image'])
            ->where('cate_id', $tour->cate_id)
            ->whereNotIn('id', [$tour->id])
            ->latest()->take('10')->get();
        $config = Config::query()->first();

        return view('site.tours.tour_detail', compact('tour', 'tourSuggest', 'config'));
    }

    public function bookingTour(Request $request, $slug = null) {
        $tours = Tour::query()->where('status', Tour::XUAT_BAN)->latest()->get();
        $tour = null;
        if($slug) {
            $tour = Tour::findBySlug($slug);
        }

        return view('site.tours.booking', compact('tours', 'tour'));
    }

    public function submitBooking(Request $request)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            $translate = [
                'customer_name.required' => 'Vui lòng nhập họ tên',
                'customer_phone.required' => 'Vui lòng nhập số điện thoại',
                'customer_phone.regex' => 'Số điện thoại không đúng định dạng',
                'customer_address.required' => 'Vui lòng nhập địa chỉ',
                'customer_email.required' => 'Vui lòng nhập email',
            ];

            $validate = \Illuminate\Support\Facades\Validator::make(
                $request->all(),
                [
                    'customer_name' => 'required',
                    'customer_phone' => 'required|regex:/^(0)[0-9]{9,11}$/',
                    'customer_address' => 'required',
                    'customer_email' => 'required',
                ],
                $translate
            );

            $json = new \stdClass();

            if ($validate->fails()) {
                $json->success = false;
                $json->errors = $validate->errors();
                $json->message = "Thao tác thất bại!";
                return \Illuminate\Support\Facades\Response::json($json);
            }


        $client = new \GuzzleHttp\Client();
        $googleSheetUrl = 'https://script.google.com/macros/s/AKfycbx6Ebc8OGh0qBbzE8xWxHzzEgETVBQzT7f_ZQ3q61ZCO-czKqB9ukNnXA9N6HF6apPBgQ/exec';

        $response = $client->post($googleSheetUrl, [
            'form_params' => [
                'customer_name'    => $request->customer_name,
                'customer_address' => $request->customer_address,
                'customer_phone'   => $request->customer_phone,
                'customer_email'   => $request->customer_email,
                'customer_time'   => $request->customer_time,
                'customer_ticket'  => $request->customer_ticket,
                'customer_content' => $request->customer_content,
            ]
        ]);

            $result = json_decode($response->getBody(), true);
            if (!isset($result['status']) || $result['status'] != 'success') {
                throw new \Exception("Không thể gửi dữ liệu lên Google Sheet: " . $response->getBody());
            }

            DB::commit();
            return Response::json(['success' => true]);
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }

    }

    public function getInfoTour(Request $request, $id) {
        $tour = Tour::with('image')->find($id);
        $json = new \stdClass();
        $json->success = true;
        $json->data = $tour;
        $json->message = "Lấy dữ liệu thành công";

        return Response::json($json);
    }

    public function aboutUs(Request $request) {
        $banners = Banner::query()->with('image')->latest()->get();
        $config = Config::query()->first();
        $newBlogs = Post::with(['image'])->where(['status'=>1])
            ->orderBy('id','DESC')
            ->select(['id','name','slug'])
            ->limit(6)->get();

        return view('site.about_us', compact('config', 'banners', 'newBlogs'));
    }

    // ajax load product home page
    public function loadProductHomePage(Request $request)
    {
        $category = CategorySpecial::findBySlug($request->handle);
        $products = $category->products()->with([
            'image', 'galleries',
            'product_rates' => function($q) {
                $q->where('status', 2);
            }
            ])->where('status', 1)->limit(10)->orderBy('created_at', 'desc')->get();
        $html = '';
        foreach ($products as $product) {
            $html .= view('site.partials.item_product', compact('product', 'category'))->render();
        }

        return Response::json([
            'html' => $html,
        ]);
    }

    // ajax get product quick view
    public function getProductQuickView(Request $request)
    {
        $product = Product::findBySlug($request->slug);
        $product->image = $product->image;
        $product->image_back = $product->image_back;
        $product->galleries = $product->galleries->map(function ($gallery) {
            $gallery->image = $gallery->image;
            return $gallery;
        });
        $product->product_rates = $product->product_rates;
        $attributes = [];
        foreach ($product->attributeValues as $attribute) {
            if(!isset($attributes[$attribute->id])) {
                $attributes[$attribute->id] = [
                    'name' => $attribute->name,
                    'values' => [$attribute->pivot->value]
                ];
            } else {
                $attributes[$attribute->id]['values'][] = $attribute->pivot->value;
            }
        }
        $product->attributes = $attributes;
        // $html = view('site.partials.quick_view_product', compact('product'))->render();

        return Response::json([
            'data' => $product,
        ]);

    }

    public function showProductDetail($slug) {
        try {
            $categories = Category::getAllCategory();
            $product = Product::findSlug($slug);
            $attributes = [];
            foreach ($product->attributeValues as $attribute) {
                if(!isset($attributes[$attribute->id])) {
                    $attributes[$attribute->id] = [
                        'name' => $attribute->name,
                        'values' => [$attribute->pivot->value]
                    ];
                } else {
                    $attributes[$attribute->id]['values'][] = $attribute->pivot->value;
                }
            }
            $product->attributes = $attributes;

            // sản phẩm tương tự
            $productsRelated = $product->category->products()->whereNotIn('id', [$product->id])->orderBy('created_at', 'desc')->get();

            $category = Category::query()->where('id', $product->cate_id)->first();

            $arr_product_rate_images = [];
            foreach ($product->product_rates as $rate) {
                foreach ($rate->images as $image) {
                    $arr_product_rate_images[] = $image->path;
                }
            }

            return view('site.products.product_detail', compact('categories', 'product', 'productsRelated', 'category', 'arr_product_rate_images'));
        }catch (\Exception $exception) {
            return view('site.errors');
            Log::error($exception);
        }
    }


    public function showProductCategory(Request $request, $categorySlug = null)
    {
        $categories = Category::parent()->with('products')->orderBy('sort_order')->get();
        $category = Category::findBySlug($categorySlug);
        $sort = $request->get('sort') ?: 'lasted';
        if($category) {
            $category_parent_id = $category->parent ? $category->parent->id : null;
            $arr_category_id = array_merge($category->childs->pluck('id')->toArray(), [$category->id, $category_parent_id]);

            $products = Product::where('status', 1)->whereIn('cate_id', $arr_category_id)->orderBy('created_at', 'desc')->paginate(12);
        } else {
            $category = CategorySpecial::findBySlug($categorySlug);
            $products = $category->products()->where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        }

        $categorySpecial = CategorySpecial::query()->with(['products' => function($q) {$q->where('status', 1)->limit(5);}])
            ->has('products')
            ->where('type',10)
            ->where('show_home_page', 1)
            ->orderBy('order_number')->get();

        $title = $category->name;
        $short_des = $category->short_des;
        $title_sub = $category->name;
        if(! $category) {
            return view('site.errors');
        }

        return view('site.products.product_category', compact('categories', 'category', 'sort', 'categorySpecial', 'products', 'title', 'short_des', 'title_sub'));
    }

    public function loadMoreProduct(Request $request)
    {
        $category = Category::query()->find($request->cate_id);

        $products = Product::query()->where('status', 1);

        if ($sort = $request->get('sort')) {
            if ($sort == 'lasted') {
                $products->orderBy('created_at', 'desc');
            } else if ($sort == 'priceAsc') {
                $products->orderBy('price', 'asc');
            } else if ($sort == 'priceDesc') {
                $products->orderBy('price', 'desc');
            }
        } else {
             $products->orderBy('created_at', 'desc');
        }

        $product_all_ids = $category->products()->pluck('id')->toArray();

        if( $request->product_ids_load_more) {
            $products->whereIn('id', array_diff($product_all_ids, $request->product_ids_load_more));
        }

        $products = $products->where('cate_id', $category->id)->limit(1)->get();

        // mảng product id
        $product_ids = $products->pluck('id')->toArray();

        $html = '';

        $product_ids_ = array_merge($request->product_ids_load_more ?? [], $product_ids);

        $hasProductsNextPage = false;

        if($product_ids && Product::query()->whereNotIn('id', $product_ids_)->count()) $hasProductsNextPage = true;

        foreach ($products as $product) {
            $html .= view( 'site.partials.card_product', compact('product', 'category'))->render();
        }


        return Response::json([
            'html' => $html,
            'product_ids' => $product_ids,
            'hasProductsNextPage' => $hasProductsNextPage,
        ]);

    }


    // Liên hệ
    public function contactUs()
    {
        return view('site.contact_us');
    }

    public function postContact(Request $request)
    {
        $rule  =  [
            'your_name' => 'required',
            'your_phone'  => 'required|regex:/^(0)[0-9]{9,11}$/',
            'your_email'  => 'required|email|max:255'
        ];

        $validate = Validator::make(
            $request->all(),
            $rule,
            [
                'your_name.required' => 'Vui lòng nhập họ tên',
                'your_phone.required' => 'Vui lòng nhập số điện thoại',
                'your_phone.regex' => 'Số điện thoại không đúng định dạng',
                'your_email.required' => 'Vui lòng nhập email',
            ]
        );

        if ($validate->fails()) {
            return $this->responseErrors('Gửi yêu cầu thất bại!', $validate->errors());
        }

        $contact = new Contact();
        $contact->user_name = $request->your_name;
        $contact->email = $request->your_email;
        $contact->phone_number = $request->your_phone;
        $contact->content = $request->your_message;
        $contact->save();

        return $this->responseSuccess('Gửi yêu cầu thành công!');
    }

    // Blogs
    public function listBlog(Request $request, $slug)
    {
        $category = PostCategory::where('slug', $slug)->first();
        $data['blogs'] = Post::with(['image'])->where(['status'=>1,'cate_id'=>$category->id])
            ->orderBy('id','DESC')
            ->select(['id','name','intro','created_at','slug', 'cate_id'])
            ->paginate(12);

        $data['cate_title'] = $category->name;
        $data['categories'] = PostCategory::with([
            'posts' => function ($query){
                $query->where(['status'=>1])->get();
            }
        ])->where(['parent_id' => 0, 'show_home_page' => 1])->latest()->get();
        $data['newBlogs'] = Post::with(['image'])->where(['status'=>1])
            ->orderBy('id','DESC')
            ->select(['id','name','slug'])
            ->limit(6)->get();

        return view('site.blogs.list', $data);
    }

    public function indexBlog(Request $request, $slug = null)
    {
        $banners = Banner::query()->with('image')->latest()->get();
        $data['newBlogs'] = Post::with(['image'])->where(['status'=>1])
            ->orderBy('id','DESC')
            ->select(['id','name','slug'])
            ->limit(5)->get();
        $category = null;
        if($slug) {
            $category = PostCategory::findBySlug($slug);

            $data['blogs'] = Post::with(['image', 'category'])->where(['status'=>1])
                ->where('cate_id', $category->id)
                ->orderBy('id','DESC')
                ->select(['id','name','intro','created_at','slug'])
                ->paginate(10);
        } else {
            $data['blogs'] = Post::with(['image', 'category'])->where(['status'=>1])
                ->orderBy('id','DESC')
                ->select(['id','name','intro','created_at','slug'])
                ->paginate(10);

            $data['cate_title'] = 'Tin tức';
            $data['categories'] = PostCategory::with([
                'posts' => function ($query){
                    $query->where(['status'=>1])->get();
                }
            ])->where(['parent_id' => 0, 'show_home_page' => 1])->latest()->get();
        }


        return view('site.blogs.list', compact('data', 'banners', 'category'));
    }

    public function detailBlog(Request $request, $slug)
    {
        $banners = Banner::query()->with('image')->latest()->get();
        $blog = Post::with(['image', 'user_create'])->where('slug', $slug)->first();
        $category = PostCategory::where('id', $blog->cate_id)->first();

        $data['other_blogs'] = Post::with(['image'])->where(['status'=>1,'cate_id'=>$blog->cate_id])
        ->where('id', '!=', $blog->id)
        ->select(['id','name','intro','created_at','slug'])
        ->limit(6)->inRandomOrder()->get();

        $data['newBlogs'] = Post::with(['image'])->where(['status'=>1])
            ->orderBy('id','DESC')
            ->select(['id','name','slug'])
            ->limit(5)->get();

        $data['blog_title'] = $blog->name;
        $data['blog_des'] = $blog->intro;
        $data['categories'] = PostCategory::with([
            'posts' => function ($query){
                $query->where(['status'=>1])->get();
            }
        ])->where(['parent_id' => 0, 'show_home_page' => 1])->latest()->get();
        $data['newBlogs'] = Post::with(['image'])->where(['status'=>1])
        ->orderBy('id','DESC')
        ->select(['id','name','slug'])
        ->limit(6)->get();
        $data['blog'] = $blog;
        $data['cate_title'] = $category->name;
        $data['category'] = $category;

        return view('site.blogs.detail', compact('data', 'banners'));
    }

    // Tìm kiếm
    public function autoSearchComplete(Request $request)
    {
        if (isset($request->keyword)) {
            $products = Product::with(['image'])->where('name','LIKE','%'.$request->keyword.'%')->where('status', 1)->orderBy('id','DESC')->limit(10)->get();
            $view = view("site.partials.ajax_search_results",compact('products'))->render();
        } else {
            $view = '';
        }

        return Response::json([
            'html'=>$view
        ]);
    }

    public function resetData() {
        \Illuminate\Support\Facades\DB::table('orders')->truncate();
        \Illuminate\Support\Facades\DB::table('contacts')->truncate();
    }

    // laster buy products
    public function lasterBuyProducts() {
        $product = \DB::table('products')
        ->where('status', 1)
        ->leftJoin('files', function($join) {
            $join->on('files.model_id', '=', 'products.id')
            ->where('files.custom_field', 'image')->where('files.model_type', Product::class);
        })
        ->inRandomOrder()->first(['products.id', 'products.name', 'products.slug', 'files.path']);
        return Response::json([
            'product' => $product,
        ]);
    }

    // review
    public function submitReview(Request $request) {
        $rule  =  [
            'name' => 'required',
            'email'  => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'phone'  => 'required|regex:/^(0)[0-9]{9,11}$/',
            'rating' => 'required|numeric|min:1|max:5',
            'title' => 'required',
            'galleries' => 'required|array|min:1|max:5',
            'galleries.*.image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'desc' => 'required',
            'product_id' => 'required|exists:products,id',
        ];

        $validate = Validator::make(
            $request->all(),
            $rule,
            [
                'name.required' => 'Vui lòng nhập họ tên',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone.regex' => 'Số điện thoại không đúng định dạng',
                'email.required' => 'Vui lòng nhập email',
                'email.regex' => 'Email không đúng định dạng',
                'rating.required' => 'Vui lòng đánh giá sản phẩm',
                'rating.numeric' => 'Đánh giá không hợp lệ',
                'rating.min' => 'Đánh giá không hợp lệ',
                'rating.max' => 'Đánh giá không hợp lệ',
                'title.required' => 'Vui lòng nhập tiêu đề',
                'galleries.required' => 'Vui lòng chọn ít nhất 1 hình ảnh',
                'galleries.array' => 'Dữ liệu không hợp lệ',
                'galleries.min' => 'Vui lòng chọn ít nhất 1 hình ảnh',
                'galleries.max' => 'Vui lòng chọn tối đa 5 hình ảnh',
                'desc.required' => 'Vui lòng nhập nội dung đánh giá',
                'galleries.*.image.image' => 'Vui lòng chọn file hình ảnh',
                'galleries.*.image.mimes' => 'File không hợp lệ',
                'galleries.*.image.max' => 'File không được lớn hơn 5MB',
                'product_id.required' => 'Sản phẩm không hợp lệ',
                'product_id.exists' => 'Sản phẩm không hợp lệ',
            ]
        );


        if ($validate->fails()) {
            return $this->responseErrors('Gửi yêu cầu thất bại!', $validate->errors());
        }

        $store_data = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'rating' => $request->rating,
            'title' => $request->title,
            'desc' => $request->desc,
        ];

		DB::beginTransaction();
		try {
			$object = new ProductRate();
			$object->fill($store_data);
			$object->save();

            $galleries = $request->galleries;
			foreach ($galleries as $gallery) {
                if (isset($gallery['image'])) {
                    $file = $gallery['image'];
                    FileHelper::uploadFile($file, 'product_rate', $object->id, ProductRate::class, 'image', 1);
                }
            }

			DB::commit();
			return $this->responseSuccess('Gửi đánh giá thành công!');
		} catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    // Tạo thiết kế
    public function productCustom(Request $request) {
        $product = Product::with(['image', 'image_back', 'galleries'])->find($request->product_id);
        return view('site.products.product_custom', compact('product'));
    }

    // Tìm kiếm trang list product
    public function searchProduct(Request $request) {
        $query = Product::query()->where('status', 1);
        if (!empty($request->cate_id)) {
            $query->where('cate_id', $request->cate_id);
        }
        if (!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        if (!empty($request->tag)) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where('name', $request->tag);
            });
        }
        if (!empty($request->type) && $request->type == 'response') {
            $products = $query->get();
            $products = $products->map(function ($product) {
                $product->image = $product->image;
                $product->image_back = $product->image_back;
                return $product;
            });
            return Response::json([
                'products' => $products,
            ]);
        }
        $products = $query->paginate(12);
        $title = 'Tìm kiếm';
        $short_des = 'Kết quả tìm kiếm';
        $title_sub = 'Tìm thấy '.count($products).' kết quả phù hợp';
        return view('site.products.product_category', compact('products', 'title', 'short_des', 'title_sub'));
    }

    // đặt hàng thiết kế
    public function designOrder(Request $request) {
        $formCustom = json_decode($request->input('formCustom'), true);
        $dataFront = json_decode($request->input('dataFront'), true);
        $dataBack = json_decode($request->input('dataBack'), true);
        $dataFrontImage = $request->file('dataFrontImage');
        $dataBackImage = $request->file('dataBackImage');
        $imageFront = $request->file('imageFront');
        $imageBack = $request->file('imageBack');

        $rule  =  [
            'name' => 'required',
            'email'  => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'phone'  => 'required|regex:/^(0)[0-9]{9,11}$/',
            'address' => 'required',
            'product_id' => 'required|exists:products,id',
        ];

        $validate = Validator::make(
            $formCustom,
            $rule,
            [
                'name.required' => 'Vui lòng nhập họ tên',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone.regex' => 'Số điện thoại không đúng định dạng',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'email.required' => 'Vui lòng nhập email',
                'email.regex' => 'Email không đúng định dạng',
                'product_id.required' => 'Sản phẩm không hợp lệ',
                'product_id.exists' => 'Sản phẩm không hợp lệ',
            ]
        );

        if ($validate->fails()) {
            return $this->responseErrors('Gửi yêu cầu thất bại!', $validate->errors());
        }

        $design_order = new DesignOrder();
        $design_order->customer_name = $formCustom['name'];
        $design_order->customer_phone = $formCustom['phone'];
        $design_order->customer_email = $formCustom['email'];
        $design_order->customer_address = $formCustom['address'];
        $design_order->customer_note = $formCustom['note'];
        $design_order->product_id = $formCustom['product_id'];
        $design_order->product_name = $formCustom['product_name'];
        $design_order->product_price = $formCustom['product_price'];
        $design_order->product_quantity = $formCustom['product_quantity'] ?? 1;
        $design_order->product_color = $formCustom['product_color'] ?? null;
        $design_order->product_size_length = $formCustom['product_size_length'] ?? null;
        $design_order->product_size_width = $formCustom['product_size_width'] ?? null;
        $design_order->product_size_height = $formCustom['product_size_height'] ?? null;
        $design_order->product_attributes = $formCustom['product_attributes'] ?? null;
        $design_order->save();

        if ($imageFront) {
            FileHelper::uploadFileToCloudflare($imageFront, $design_order->id, DesignOrder::class, 'image_front');
        }
        if ($imageBack) {
            FileHelper::uploadFileToCloudflare($imageBack, $design_order->id, DesignOrder::class, 'image_back');
        }

        // Gán ảnh vào đúng vị trí trong dataFront
        if ($dataFront) {
            foreach ($dataFront as $index => $layer) {
                $design_detail = new DesignDetail();
                $design_detail->design_order_id = $design_order->id;
                $design_detail->group = $layer['group'];
                $design_detail->type = $layer['type'];
                $design_detail->design_text = $layer['design_text'];
                $design_detail->design_color = $layer['design_color'] ?? null;
                $design_detail->design_font = $layer['design_font'] ?? null;
                $design_detail->design_font_size = $layer['design_font_size'] ?? null;
                $design_detail->design_font_weight = $layer['design_font_weight'] ?? null;
                $design_detail->design_font_style = $layer['design_font_style'] ?? null;
                $design_detail->save();
                if ($layer['type'] === 'image' && $request->hasFile("dataFrontImage.$index")) {
                    $image = $request->file("dataFrontImage.$index");
                    FileHelper::uploadFileToCloudflare($image, $design_detail->id, DesignDetail::class, 'image_layer');
                }
            }
        }

        // Gán ảnh vào đúng vị trí trong dataBack
        if ($dataBack) {
            foreach ($dataBack as $index => $layer) {
                $design_detail = new DesignDetail();
                $design_detail->design_order_id = $design_order->id;
                $design_detail->group = $layer['group'];
                $design_detail->type = $layer['type'];
                $design_detail->design_text = $layer['design_text'];
                $design_detail->design_color = $layer['design_color'] ?? null;
                $design_detail->design_font = $layer['design_font'] ?? null;
                $design_detail->design_font_size = $layer['design_font_size'] ?? null;
                $design_detail->design_font_weight = $layer['design_font_weight'] ?? null;
                $design_detail->design_font_style = $layer['design_font_style'] ?? null;
                $design_detail->save();
                if ($layer['type'] === 'image' && $request->hasFile("dataBackImage.$index")) {
                    $image = $request->file("dataBackImage.$index");
                    FileHelper::uploadFileToCloudflare($image, $design_detail->id, DesignDetail::class, 'image_layer');
                }
            }
        }

        return $this->responseSuccess('Đặt hàng thành công!');
    }
}
