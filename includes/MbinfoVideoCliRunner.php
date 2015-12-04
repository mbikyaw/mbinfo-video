<?php

/**
 * Plugin Name: MbInfo PInfo CLI Runner
 * Version: 1.0
 * Description: Load image file from Google Cloud Storage as WordPress figure page.
 * Author: Kyaw Tun
 * Author URI: http://mbinfo.mbi.nus.edu.sg
 */


require_once 'video.php';


class MbinfoVideoCliRunner extends WP_CLI_Command {

	/**
	 * Print video code.
	 *
	 * ## OPTIONS
	 *
	 * <id>
	 *
	 *   YouTube id.
	 *
	 * ## EXAMPLES
	 *
	 *     wp mbinfo-video info --id=7RrrIBHAbXE
	 *
	 * @synopsis [--id]
	 */
	function info( $args, $assoc_args ) {
		$video = new MBInfoVideo();
		$content = $args[0];
		$html = $video->parse_short_code($assoc_args, $content);
		echo $html;
	}



}


WP_CLI::add_command( 'mbinfo-video', 'MbinfoVideoCliRunner' );
