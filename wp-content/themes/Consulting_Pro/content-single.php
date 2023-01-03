<?php
/**
 * The Single Post content template file.
 *
 * @package ThinkUpThemes
 */
?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php thinkup_input_postmedia(); ?>
		<?php thinkup_input_postmeta(); ?>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'consulting' ), 'after'  => '</div>', ) ); ?>
		</div><!-- .entry-content -->

		<div class="entry-footer">
			<?php /* Add Social Share */ thinkup_input_share(); ?>
		</div><!-- .entry-footer -->

		</article>

		<div class="clearboth"></div>