<div class="share-post">
    <span class="share-text">{{ trans('webed-theme::base.share_this_post') }}</span>
    <div class="share-post-btn btn-tweet">
        <a class="twitter-share-button" data-count="horizontal" data-lang="en" data-related=" "
           data-text="{{ $object->title or '' }}"
           data-url="{{ Request::fullUrl() }}"
           data-via=" " href="https://twitter.com/share" rel="nofollow"></a>
        <script src="https://platform.twitter.com/widgets.js" type="text/javascript">
        </script>
    </div>
    <div class="share-post-btn btn-like">
        <iframe allowTransparency="true" frameborder="0" scrolling="no"
                src="https://www.facebook.com/plugins/like.php?href={{ Request::fullUrl() }}&send=false&layout=button_count&show_faces=false&width=90&action=like&font=arial&colorscheme=light&height=32"
                style="border:none; overflow:hidden; width:90px; height:32px;"></iframe>
    </div>
    <div class="share-post-btn btn-plus">
        <script src="https://apis.google.com/js/plusone.js" type="text/javascript"></script>
        <g:plusone count="true"
                   href="{{ Request::fullUrl() }}"
                   size="medium"></g:plusone>
    </div>
</div>
<div class="comment-post">
    <h4 class="article-content-subtitle">
        {{ trans('webed-theme::base.comments') }}
    </h4>
    <div class="facebook-comment">
        <div class="fb-comments"
             data-href="{{ Request::fullUrl() }}"
             data-numposts="15"></div>
    </div>
</div>
