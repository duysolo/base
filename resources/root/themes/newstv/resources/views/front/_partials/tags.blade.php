<div class="tags-wrap">
    <span>{{ trans('webed-theme::base.tags') }}:</span>
    @foreach($relatedTags as $tag)
        <a itemprop="keywords"
           class="text-capitalize"
           title="{{ $tag->title }}"
           href="{{ get_tag_link($tag) }}">{{ $tag->title }}</a>
    @endforeach
</div>
