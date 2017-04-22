<link rel="canonical" href="{{ asset('') }}">
<meta http-equiv="content-language" content="{{ app()->getLocale() }}">
<link rel="shortcut icon" href="{{ asset(get_setting('favicon')) }}">

<meta name="description" content="{{ custom_strip_tags(array_get($seoMeta, 'description'), '') }}">
<meta name="keywords" content="{{ array_get($seoMeta, 'keywords') }}">
<meta content="" name="author">

<!-- Google+ -->
<meta itemprop="name" content="{{ $pageTitle or '' }} - {{ get_setting('site_title', 'WebEd') ?: 'WebEd' }}">
<meta itemprop="description" content="{{ custom_strip_tags(array_get($seoMeta, 'description'), '') }}">
<meta itemprop="keywords" content="{{ array_get($seoMeta, 'keywords') }}">
<meta itemprop="image" content="{!! get_image(array_get($seoMeta, 'image'), get_setting('site_logo')) !!}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="{!! get_image(array_get($seoMeta, 'image'), get_setting('site_logo')) !!}">
<meta name="twitter:site" content="{!! request()->fullUrl() !!}">
<meta name="twitter:title" content="{{ $pageTitle or '' }} - {{ get_setting('site_title', 'WebEd') ?: 'WebEd' }}">
<meta name="twitter:description" content="{{ custom_strip_tags(array_get($seoMeta, 'description'), '') }}">
<meta name="twitter:creator" content="{{ request()->url() }}">
<!-- Twitter summary card with large image must be at least 280x150px -->
<meta name="twitter:image:src" content="{!! get_image(array_get($seoMeta, 'image'), get_setting('site_logo')) !!}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $pageTitle or '' }} - {{ get_setting('site_title', 'WebEd') ?: 'WebEd' }}">
<meta property="og:type" content="article">
<meta property="og:url" content="{!! request()->fullUrl() !!}">
<meta property="og:image" content="{!! get_image(array_get($seoMeta, 'image'), get_setting('site_logo')) !!}">
<meta property="og:description" content="{{ custom_strip_tags(array_get($seoMeta, 'description'), '') }}">
<meta property="og:site_name" content="{{ get_setting('site_title', 'WebEd') ?: 'WebEd' }}">
<meta property="article:published_time"
      content="{{ (isset($object) && isset($object->created_at)) ? $object->created_at->toDatetimeString() : date('Y-m-d H:i:s') }}">
<meta property="article:modified_time"
      content="{{ (isset($object) && isset($object->updated_at)) ? $object->updated_at->toDatetimeString() : date('Y-m-d H:i:s') }}">
<meta property="article:section" content="{{ $pageTitle or '' }} - {{ get_setting('site_title', 'WebEd') ?: 'WebEd' }}">
<meta property="article:tag" content="{{ array_get($seoMeta, 'keywords') }}">
<meta property="fb:admins" content="">
