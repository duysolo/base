<?php

if (!function_exists('search_url')) {
    /**
     * @return string
     */
    function search_url()
    {
        return route('front.search.get');
    }
}

if (!function_exists('parse_youtube_embedded')) {
    /**
     * @param string $url
     * @return string|null
     */
    function parse_youtube_embedded($url)
    {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $url, $matches);
        try {
            return $matches[1];
        } catch (\Exception $exception) {
            return null;
        }
    }
}
