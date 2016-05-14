<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * Index Template
 *
 * Here we setup all logic and XHTML that is required for the index template, used as both the homepage
 * and as a fallback template, if a more appropriate template file doesn't exist for a specific context.
 *
 * @package WooFramework
 * @subpackage Template
 */
	get_header();
	global $woo_options;

	$settings = array(
					'homepage_enable_product_categories' => 'true',
					'homepage_enable_featured_products' => 'true',
					'homepage_enable_recent_products' => 'true',
					'homepage_enable_testimonials' => 'true',
					'homepage_enable_content' => 'true',
					'homepage_product_categories_title' => '',
					'homepage_product_categories_limit' => 4,
					'homepage_featured_products_title' => '',
					'homepage_featured_products_limit' => 4,
					'homepage_recent_products_title' => '',
					'homepage_recent_products_limit' => 4,
					'homepage_number_of_testimonials' => 4,
					'homepage_testimonials_area_title' => '',
					'homepage_content_type' => 'posts',
					'homepage_page_id' => '',
					'homepage_posts_sidebar' => 'true'
					);
	$settings = woo_get_dynamic_values( $settings );

	$layout_class = 'col-left';
	if ( 'true' != $settings['homepage_posts_sidebar'] ) { $layout_class = 'full-width'; }
?>

    <div id="content" class="col-full">

    	

    	<div id="main" class="woocommerce woocommerce-wrap woocommerce-columns-4 col-left">
    		<?php woo_main_before(); ?>
	    	<?php
	    		if ( ! dynamic_sidebar( 'homepage' ) ) {
	    			if ( 'true' == $settings['homepage_enable_product_categories'] && is_woocommerce_activated() ) {
	    				the_widget( 'Woo_Product_Categories', array( 'title' => stripslashes( $settings['homepage_product_categories_title'] ), 'categories_per_page' => intval( $settings['homepage_product_categories_limit'] ) ) );
	    			}

	    			if ( 'true' == $settings['homepage_enable_featured_products'] && is_woocommerce_activated() ) {
	    				the_widget( 'Woo_Featured_Products', array( 'title' => stripslashes( $settings['homepage_featured_products_title'] ), 'products_per_page' => intval( $settings['homepage_featured_products_limit'] ) ) );
	    			}

	    			if ( 'true' == $settings['homepage_enable_recent_products'] && is_woocommerce_activated() ) {
	    				the_widget( 'Woo_Recent_Products', array( 'title' => stripslashes( $settings['homepage_recent_products_title'] ), 'products_per_page' => intval( $settings['homepage_recent_products_limit'] ) ) );
	    			}

	    			if ( 'true' == $settings['homepage_enable_testimonials'] ) {
	    				do_action( 'woothemes_testimonials', array( 'title' => stripslashes( $settings['homepage_testimonials_area_title'] ), 'limit' => $settings['homepage_number_of_testimonials'], 'per_row' => 4 ) );
	    			}
	    		}
	    	?>
		</div><!--/.woocommerce-->
		
        <?php if ( 'true' == $settings['homepage_posts_sidebar'] ) { get_sidebar(); } ?>

    </div><!-- /#content -->

<?php get_footer(); ?>