<?php /* Template Name: News */ ?>
<?php get_header(); ?>

<?php if ( ! have_posts() ) : ?>
<div class="content">
	<?php get_template_part( 'framework/parts/not-found' ); ?>
</div>
<?php endif; ?>

<?php
//Page Builder
$get_meta = get_post_custom( $post->ID );
if( !empty( $get_meta[ 'tie_builder_active' ][0] ) ):

		if( !empty( $get_meta[ 'featured_posts' ][0] ) )
			get_template_part('framework/parts/featured');

		if( !empty( $get_meta[ 'slider' ][0] ) && ( !empty( $get_meta[ 'slider_pos' ][0] ) && $get_meta[ 'slider_pos' ][0] == 'big' ) )
			get_template_part('framework/parts/slider-home');// Get Slider template ?>
	<div class="content">
		<?php
			if( !empty( $get_meta[ 'slider' ][0] ) && ( !empty( $get_meta[ 'slider_pos' ][0] ) && $get_meta[ 'slider_pos' ][0] != 'big' ) )
				get_template_part('framework/parts/slider-home'); // Get Slider template

			get_template_part( 'framework/blocks' );
		?>
	</div><!-- .content /-->


<?php
// Normal Page
else:?>


		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array( 'post_type' => 'post', 'posts_per_page' => 20, 'paged' => $paged );
		$wp_query = new WP_Query($args);
		while ( have_posts() ) : the_post(); ?>

 		<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

		<?php endwhile; ?>

		<!-- then the pagination links -->
		<div class="pagination w3-col m12  my-margin-sm innerpage-div-bc m-tb-note-t">
		<div class="w3-col m6 s6 ">
			<?php next_posts_link( '&rarr; قدیمی تر', $wp_query ->max_num_pages); ?>
		</div>
		<div class="w3-col m6 s6   text-right">
			<?php previous_posts_link( 'جدیدتر &larr;'  ); ?>
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



<?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>