<?php /* Template Name: Main Page 3 COL */ ?>
<?php get_header(); ?>

<?php if ( ! have_posts() ) : ?>
<div class="content">
	<?php get_template_part( 'framework/parts/not-found' ); ?>
</div>
<?php endif; ?>





<?php
echo  do_shortcode('[metaslider id="112"]');
?>

<div class="row3">
  <div class="column3 column31">
	<?php if ( is_active_sidebar( 'home_right_1' ) ) : ?>
		<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'home_right_1' ); ?>
		</div><!-- #primary-sidebar -->
	<?php endif; ?>
  </div>
  <div class="column3 column32">
	<?php if ( is_active_sidebar( 'home_right_2' ) ) : ?>
		<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'home_right_2' ); ?>
		</div><!-- #primary-sidebar -->
	<?php endif; ?>
</div>
  <div class="column3 column33">
	<?php if ( is_active_sidebar( 'home_right_3' ) ) : ?>
		<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
			<?php dynamic_sidebar( 'home_right_3' ); ?>
		</div><!-- #primary-sidebar -->
	<?php endif; ?>
  </div>
</div>


		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_below"][0]) ).'</div>';
			else tie_banner('banner_below' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>

		<?php if( !function_exists('bp_current_component') || (function_exists('bp_current_component') && !bp_current_component() ) )  comments_template( '', true );  ?>
	</div><!-- .content -->





<?php get_sidebar(); ?>
<?php get_footer(); ?>