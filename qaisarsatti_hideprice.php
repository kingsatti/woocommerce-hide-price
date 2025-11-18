<?php
/**
 * Plugin Name: Qaisar Satti Hide Price
 * Plugin URI: https://store.qaisarsatti.com
 * Description: Hide Price for not logged in 
 * Version: 1.0.0
 * Text Domain: Qaisar Satti Store
 * Author: Qaisar Satti
 * Author URI: https://store.qaisarsatti.com
 */
 if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) ) {
	function qaisarsatti_hideprice_admin_notice() {
		$qhideprice_allowed_tags = array(
			'a' => array(
				'class' => array(),
				'href'  => array(),
				'rel'   => array(),
				'title' => array(),
			),
			'b' => array(),
			'div' => array(
				'class' => array(),
				'title' => array(),
				'style' => array(),
			),
			'p' => array(
				'class' => array(),
			),
			'strong' => array(),
		);
		// Deactivate the plugin
		deactivate_plugins(__FILE__);
		$qhideprice_ = '<div id="message" class="error">
			<p><strong>Hide Price plugin is inactive.</strong> The <a href="http://wordpress.org/extend/plugins/woocommerce/">WooCommerce plugin</a> must be active for this plugin to work. Please install &amp; activate WooCommerce »</p></div>';
		echo wp_kses( __( $qhideprice__woo_check, 'qaisarsatti-hideprice' ), $qhideprice_allowed_tags);
	}
		add_action('admin_notices', 'qaisarsatti_completeorder_admin_notice');

			

}
add_filter('woocommerce_get_price_html','qaisarsatti_hideprice');
function qaisarsatti_hideprice( $priceHtml ) {	

	if(is_user_logged_in() ){
    return $priceHtml;
  }
  else {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
    if ( is_product() ){
    	return $priceHtml = ' <a href="' .get_permalink(woocommerce_get_page_id('myaccount')). '">Login To View Price</a> ';
	}
  }
}