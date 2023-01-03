<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>
<div id="thinkupshortcodestabswoo" class="tabs style1">
	<div class="tab-buttons tab-buttons-left">
		<ul class="nav nav-tabs">

		<?php $count = NULL; $class = NULL; ?>
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>

			<?php $count = $count + 1; ?>
			<?php if ( $count == '1' ) { $class = ' active'; } else { $class = NULL; } ?>

				<li class="<?php echo $key ?>_tab<?php echo $class; ?>">
					<a href="#tab-<?php echo $key ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ?></a>
				</li>
			<?php endforeach; ?>
		<?php $count = NULL; $class = NULL; ?>

		</ul>
	</div>

	<div class="tab-content">
	
		<?php $count = NULL; $class = NULL; ?>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>

			<?php $count = $count + 1; ?>
			<?php if ( $count == '1' ) { $class = ' active in'; } else { $class = NULL; } ?>

			<div class="tab-pane fade<?php echo $class; ?>" id="tab-<?php echo $key ?>">
				<?php call_user_func( $product_tab['callback'], $key, $product_tab ) ?>
			</div>
		<?php endforeach; ?>
		<?php $count = NULL; $class = NULL; ?>

	</div>
</div>
<?php endif; ?>