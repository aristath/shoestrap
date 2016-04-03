<?php

class Shoestrap_Data_Conditionals extends Shoestrap_Data {

	function __construct() {

		$conditionals = array(
			'is_home'              => is_home(),
			'is_front_page'        => is_front_page(),
			'is_single'            => is_single(),
			'is_sticky'            => is_sticky(),
			'is_post_type_archive' => is_post_type_archive(),
			'comments_open'        => comments_open(),
			'pings_open'           => pings_open(),
			'is_page'              => is_page(),
			'is_page_template'     => is_page_template(),
			'is_category'          => is_category(),
			'is_tag'               => is_tag(),
			'has_tag'              => has_tag(),
			'is_tax'               => is_tax(),
			'is_author'            => is_author(),
			'is_multi_author'      => is_multi_author(),
			'is_date'              => is_date(),
			'is_year'              => is_year(),
			'is_month'             => is_month(),
			'is_day'               => is_day(),
			'is_time'              => is_time(),
			'is_new_day'           => is_new_day(),
			'is_archive'           => is_archive(),
			'is_page'              => is_page(),
			'is_404'               => is_404(),
			'is_paged'             => is_paged(),
			'is_attachment'        => is_attachment(),
			'is_singular'          => is_singular(),
			'is_main_query'        => is_main_query(),
			'is_feed'              => is_feed(),
			'is_preview'           => is_preview(),
			'has_excerpt'          => has_excerpt(),
			'in_the_loop'          => in_the_loop(),
			'is_dynamic_sidebar'   => is_dynamic_sidebar(),
			'is_rtl'               => is_rtl(),
			'is_multisite'         => is_multisite(),
			'is_main_site'         => is_main_site(),
			'is_user_logged_in'    => is_user_logged_in(),
		);
		parent::$data = wp_parse_args( parent::$data, $conditionals );

	}

}
