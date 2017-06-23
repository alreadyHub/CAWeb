<?php
		get_header();

		$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );
?>
<body <?php body_class('primary') ?>  >
<?php get_template_part('partials/content', 'header') ?>


<div id="page-container">
<div id="et-main-area">
<div id="main-content" class="main-content">
	<?php
		global $wp_query;
	 ?>


		<div class="et_pb_row">
	
	<h1>Search Results</h1>
	<h4 class="sform"><?php get_search_form() ?></h4><br/>
	<h4></h4>
	<hr class="divider" style="display: none;"/>
	<div class="searched-for">
			<p class="count"><?php echo $wp_query->post_count; ($wp_query->post_count) == 1 ? printf(" result found") : printf(" results found"); ?></p>
			<p class="query">Results for: <b><?php the_search_query();?></b></p>
	</div>
	<br/>




		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					$post_format = et_pb_post_format(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>

				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_pb_post_main_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					et_divi_post_format_content();

					if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
						if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
							printf(
								'<div class="et_main_video_container">
									%1$s
								</div>',
								$first_video
							);
						elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
							<a href="<?php the_permalink(); ?>">
								<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
							</a>
					<?php
						elseif ( 'gallery' === $post_format ) :
							et_pb_gallery_images();
						endif;
					} ?>

				<?php if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) : ?>
					<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) : ?>
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php endif; ?>

					<?php
						et_divi_post_meta();

						if ( 'on' !== et_get_option( 'divi_blog_style', 'false' ) || ( is_search() && ( 'on' === get_post_meta( get_the_ID(), '_et_pb_use_builder', true ) ) ) ) {
							truncate_post( 270 );
						} else {
							the_content();
						}
					?>
				<?php endif; ?>

					</article> <!-- .et_pb_post -->
			<?php
					endwhile;

					if ( function_exists( 'wp_pagenavi' ) )
						wp_pagenavi();
					else
						get_template_part( 'includes/navigation', 'index' );
				else :
					get_template_part( 'includes/no-results', 'index' );
				endif;
			?>

</div> <!-- #main-content -->
</div>
</div>
<style>
#searchform{
	float: right;
}
.entry-title a{
	color: #428bca;
}
.sform{
	border-bottom: none;
}
.searched-for{
	margin-top: 5px;
}
.query{
	float: right;
}
.count{
	float: left;
}
</style>
<?php if (ca_version_check(5)) : ?>
<style>
.divider{
	display: block !important;
	width: 100%;
	height: 2px;
	color: #e09900;
	border-color: #e09900;
	background-color: #e09900;
	margin: 0;
}
</style>
<?php endif; ?>
<?php get_footer(); ?>
</body>