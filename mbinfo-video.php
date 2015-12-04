<?php
/**
 * Plugin Name: MBInfo Video
 * Plugin URI: https://github.com/mbikyaw/mbinfo-pinfo
 * Description: Insert MBInfo video.
 * Version: 0.1
 * Author: Kyaw Tun
 * Author URI: https://github.com/mbikyaw/
 * License: MIT
 */

require_once 'includes/video.php';

add_action( 'wp_enqueue_scripts', 'mbinfo_video_enqueue_scripts' );

function mbinfo_video_enqueue_scripts() {
    $css_url = plugins_url('css/mbinfo-video.css', __FILE__ );
    wp_enqueue_style('mbinfo-video-css', $css_url, false, '1.0.0', 'screen');
}


/**
 * Register a new shortcode: [video-box id="7RrrIBHAbXE"]
 */
add_shortcode('youtube', 'mbinfo_video');
add_shortcode('video-box', 'mbinfo_video');
function mbinfo_video($attr, $content)
{
    $pinfo = new MBInfoVideo();
    return $pinfo->parse_short_code($attr, $content);
}


if ( defined( 'WP_CLI' ) && WP_CLI ) {
    include __DIR__ . '/includes/MbinfoVideoCliRunner.php';
}