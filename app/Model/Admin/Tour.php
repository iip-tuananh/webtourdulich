<?php

namespace App\Model\Admin;

use Auth;
use App\Model\BaseModel;
use App\Model\Common\User;
use Illuminate\Database\Eloquent\Model;
use App\Model\Common\File;
use DB;
use App\Model\Common\Notification;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Tour extends BaseModel
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $dates = ['created_at', 'updated_at'];
    protected $appends = ['parent_category'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title_short'
            ]
        ];
    }

    public const XUAT_BAN = 1;
    public const LUU_NHAP = 2;

    public const STATUSES = [
        [
            'id' => self::XUAT_BAN,
            'name' => 'Xuất bản',
            'type' => 'success'
        ],
        [
            'id' => self::LUU_NHAP,
            'name' => 'Lưu nháp',
            'type' => 'danger'
        ],
    ];

    public function canEdit()
    {
        return Auth::user()->id = $this->created_by;
    }

    public function canDelete()
    {
        return true;
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function image()
    {
        return $this->morphOne(File::class, 'model');
    }

    public function image_back()
    {
        return $this->morphOne(File::class, 'model')->where('custom_field', 'image_back');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id', 'id');
    }

    public function getParentCategoryAttribute()
    {
        if ($this->category) {
            if ($this->category->parent_id == 0) {
                return null;
            }

            return $this->category->parent;
        }
        return null;
    }

    public function category_specials()
    {
        return $this->belongsToMany(CategorySpecial::class,'tour_category_special', 'tour_id', 'category_special_id');
    }

    public static function searchByFilter($request)
    {
        $result = self::with([
            'user',
            'image'
        ]);

        if (!empty($request->title_short)) {
            $result = $result->where('title_short', 'like', '%' . $request->title_short . '%');
        }

        if (!empty($request->user_id)) {
            $result = $result->where('user_id', $request->user_id);
        }

        if ($request->status) {
            $result = $result->where('status', $request->status);
        }

        if (!empty($request->cate_id)) {
            $result = $result->where('cate_id', $request->cate_id);
        }

        if (!empty($request->cate_special_id)) {
            $cate_special_id = $request->cate_special_id;
            $result = $result->whereHas('category_specials', function ($q) use ($cate_special_id) {
                $q->where('category_special_id', $cate_special_id) ;
            });
        }

        $result = $result->orderBy('created_at', 'desc')->get();
        return $result;
    }

    public static function getForSelect()
    {
        return self::where('status', 1)
            ->select(['id', 'name'])
            ->orderBy('name', 'ASC')
            ->get();
    }

    public static function getDataForEdit($id)
    {
        $post = self::where('id', $id)
            ->with([
                'image','image_back'
            ])
            ->firstOrFail();

        $post->category_special_ids = $post->category_specials->pluck('id')->toArray();

        return $post;
    }

    public static function getDataForShow($id)
    {
        return self::where('id', $id)
            ->with([
                'image'
            ])
            ->firstOrFail();
    }

    public function canView()
    {
        return $this->status == 1 || $this->created_by == Auth::user()->id;
    }

    public function send()
    {
        foreach (User::all() as $user) {
            $notification = new Notification();
            $notification->url = route("Post.show", $this->id, false);
            $notification->content = Auth::user()->name . " vừa đăng bài viết mới <b>" . $this->name . "</b>";
            $notification->status = 0;
            $notification->receiver_id = $user->id;
            $notification->created_by = Auth::user()->id;
            $notification->save();

            $notification->send();
        }
    }

    public function getRelate() {
        return self::query()->whereNotIn('id', [$this->id])->get();
    }
}
