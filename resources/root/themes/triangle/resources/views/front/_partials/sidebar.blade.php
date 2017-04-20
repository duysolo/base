<div class="sidebar blog-sidebar">
    <div class="sidebar-item recent">
        <h3>Popular</h3>
        @foreach($popularPosts as $post)
            <div class="media">
                <div class="media-body">
                    <h4><a href="{{ get_post_link($post) }}">{{ $post->title }}</a></h4>
                    <p>posted on {{ format_date($post->created_at, 'Y-m-d') }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="sidebar-item tag-cloud">
        <h3>Tags</h3>
        <ul class="nav nav-pills">
            @foreach($tags as $tag)
                <li><a href="{{ get_tag_link($tag) }}" title="{{ $tag->title }}">{{ $tag->title }}</a></li>
            @endforeach
        </ul>
    </div>
</div>