<div id="secondary" class="widget-area " role="complementary">
    <aside id="categories-2" class="widget widget_categories">
    <span class="widget-title "><span>Chuyên mục bài viết</span></span>
    <div class="is-divider small"></div>
    <ul>
        @foreach ($categories as $cate)
            <li class="cat-item cat-item-1 current-cat"><a aria-current="page" href="{{route('front.list-blog', $cate->slug)}}">{{$cate->name}}</a> ({{count($cate->posts)}})</li>
        @endforeach
    </ul>
    </aside>
    <aside id="flatsome_recent_posts-2" class="widget flatsome_recent_posts">
    <span class="widget-title "><span>Tin mới</span></span>
    <div class="is-divider small"></div>
    <ul>
        @foreach ($newBlogs as $blog)
        <li class="recent-blog-posts-li">
            <div class="flex-row recent-blog-posts align-top pt-half pb-half">
                <div class="flex-col mr-half">
                <div class="badge post-date  badge-square">
                    <div class="badge-inner bg-fill" style="background: url({{$blog->image->path}}); border:0;">
                    </div>
                </div>
                </div>
                <div class="flex-col flex-grow">
                <a href="{{route('front.detail-blog', $blog->slug)}}" title="{{$blog->name}}">{{$blog->name}}</a>
                <span class="post_comments op-7 block is-xsmall"><a href="{{route('front.detail-blog', $blog->slug)}}#respond"></a></span>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    </aside>
</div>
