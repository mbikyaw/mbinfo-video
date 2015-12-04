<?php
/**
 * Created by PhpStorm.
 * User: mbikyaw
 * Date: 22/10/15
 * Time: 1:33 PM
 */



class MBInfoVideo
{
    public static $KEY = 'AIzaSyBrRPlQlnvoA_5UKqRbNtZiuSttncL3FrA';

    /**
     * MBInfoVideo constructor.
     */
    public function __construct()
    {
    }


    /**
     * Parse short code.
     * @param $attr
     * @param string $content
     * @return string
     */
    public function parse_short_code($attr, $content) {
        $id = $attr['id'];
        if (!$id) {
            return '<div class="wpcf7-validation-errors">YouTube id attribute required.</div>';
        }
        $html = '<iframe width="640" height="480" src="https://www.youtube.com/embed/' . $id .
            '" frameborder="0" allowfullscreen></iframe>';
        $html = '<div class="youtube-frame">' . $html . "</div>";
        $url = 'https://www.googleapis.com/youtube/v3/videos?id=' . $id . '&part=snippet&key=' . MBInfoVideo::$KEY;
        $data = json_decode(MBInfoVideo::get_remote_data($url));
        $item = $data->items[0];
        if (!$item) {
            return '<div class="wpcf7-validation-errors">YouTube video id: ' . $id . ' not found.</div>';
        }
        $title = $item->snippet->title;
        if (isset($attr['title'])) {
            $title = $attr['title'];
        }
        if (!$content) {
            $content = $item->snippet->description;
        }
        $title = esc_html($title);
        $content = esc_html($content);

        $html .= '<div class="video-caption"><span class="video-title">Video. ' . $title . ': </span><span class="video-summary">' . $content . '</span></div>';
        return '<div class="video-box">' . $html . '</div>';
    }


    static public function get_remote_data( $url) {
        $c = curl_init();
        curl_setopt( $c, CURLOPT_URL, $url );
        curl_setopt( $c, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $c, CURLOPT_SSL_VERIFYHOST, false );
        curl_setopt( $c, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0" );
        curl_setopt( $c, CURLOPT_MAXREDIRS, 10 );
        curl_setopt( $c, CURLOPT_FOLLOWLOCATION, 1 );
        curl_setopt( $c, CURLOPT_CONNECTTIMEOUT, 9 );
        curl_setopt( $c, CURLOPT_REFERER, $url );
        curl_setopt( $c, CURLOPT_TIMEOUT, 60 );
        curl_setopt( $c, CURLOPT_AUTOREFERER, true );
        curl_setopt( $c, CURLOPT_ENCODING, 'gzip,deflate' );
        $data   = curl_exec( $c );
        curl_close( $c );
        return $data;
    }

}