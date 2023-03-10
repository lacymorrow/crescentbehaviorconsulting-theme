<?php
/**
 * The main Portfolio page template file.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php /* Portfolio Filter */ echo thinkup_input_portfoliofilter(); ?>
			
			<?php /* Portfolio Slider */ thinkup_input_portfolioslider(); ?>

			<?php
				$loop = new WP_Query(array('post_type' => 'portfolio', 'posts_per_page' => -1, 'paged' => $paged));
				$count =0;
			?>

			<div id="container" class="portfolio-wrapper">
			<div id="container-inner">

				<?php if ( $loop ) : 
					while ( $loop->have_posts() ) : $loop->the_post();
					$terms = get_the_terms( $post->ID, 'tagportfolio' );

					if ( $terms && ! is_wp_error( $terms ) ) : 
							$links = array();
							foreach ( $terms as $term ) { $links[] = $term->name; }
							$tax = join( ",", $links );		
						else :	
							$tax = '';	
						endif; ?>

						<?php if ( has_post_thumbnail() ) : ?>

						<div class="element <?php thinkup_input_portfoliolayout(); ?> image_grid" data-tags="<?php if ( !empty($tax)) { echo $tax; } else { echo 'thinkup_remove_tag'; }?>">
							<ul class="sc-carousel port-thumb">
								<li class="entry-header">
									<?php thinkup_input_portfoliosize();
									/* Hover Content */ thinkup_input_portfoliohover(); ?>
								</li><div class="clearboth"></div>
							</ul>
						</div>

						<?php endif; ?>

					<?php endwhile; else: ?>

				<div class="portfolio-error"><?php _e( 'No portfolio items have been found.', 'consulting' ); ?></div>

				<?php endif; wp_reset_query(); ?>

			<div class="clearboth"></div>
			</div>
			</div>

			<?php /* Featured Content */ thinkup_input_portfoliofeatured(); ?>

<?php get_footer(); ?>