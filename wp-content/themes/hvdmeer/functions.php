<?php

add_action('after_setup_theme', function() {
	// remove default credits
	remove_action('generate_credits', 'generate_add_footer_info');
	
	// remove achive title
	remove_action('generate_archive_title','generate_archive_title');
});
	
// add credits
add_action('generate_credits', function() {
	echo __('Copyright','generate') . ' &copy ' . date('Y') . ' H v/d Meer <br/>';
	echo 'Ontwerp en realisatie <a alt="wordpress website laten maken?" href="http://acservices.nl/internetdiensten/web-ontwikkeling/">ACServices Leeuwarden</a>';
});

// add slogan image to header
add_action('generate_after_header_content', function() {
	echo '<img class="slogan" alt="Bij wie ook alweer? Bij van der Meer" src="' . get_stylesheet_directory_uri() . '/img/bijvandermeer.png"></img>';
});

// add footer slogan image
add_action('dynamic_sidebar_after', function($name) {
	if($name === 'footer-2') {
		echo '<img src="' . get_stylesheet_directory_uri() . '/img/die-rijschool-uit-engelum.png"></img>';
	}
});

// disable link to post author page on blog page
add_filter('generate_post_author', function() {
	return false;
});

// disable categories link in the entry-meta of a post
add_filter('generate_show_categories', function() {
	return false;
});

// never show excerpt, force the full article
function generate_show_excerpt() {
	return false;
}

// disable comments
add_filter('comments_open', function() {
	return false;
});

// disable pingback
add_filter('xmlrpc_methods', function($methods) {
   unset($methods['pingback.ping']);
   unset($methods['pingback.extensions.getPingbacks']);
   
   return $methods;
});

// disable author pages
add_filter('template_redirect', function() {
	if(is_author()) {		
		global $wp_query;
		$wp_query->set_404();
		status_header(404);
		nocache_headers();
	}
});