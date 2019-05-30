<?php
/*
*** urbanangels_projects Custom Posts 1.0 ***
*/
?>

<?php 
	get_header();
?>

<div class="outer-wrapper shadow">
	<div class="container">
		<main id="maincontent" role="main">

	<header>
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
	</header>

	<div id="urbanangels_projects-list">
		<div class="row">

			<?php if ( have_posts () ) : ?>

				<?php  $args = array(
					'posts_per_page' => '9',
					'post_type' => 'urbanangels_projects',
					'paged' => get_query_var('paged') ? get_query_var('paged') : 1
				);?>

				<?php $urbanangels_projects = new WP_Query ( $args );

				while ( $urbanangels_projects->have_posts() ) : $urbanangels_projects->the_post(); ?>

			<div class="urbanangels_projects three-columns">
			<header>
				<h2 class="urbanangels_projects-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
				</h2>
			</header>
			<?php if ( has_post_thumbnail() ) :?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('medium'); ?>
				</a>
			<?php endif; ?>
			<div class="urbanangels_projects_entry">
				<?php the_excerpt() ?>
			</div><!--.urbanangels_projects_entry-->

			</div><!--.urbanangels_projects .three-columns-->
	<?php $urbanangels_projects_count = $urbanangels_projects->current_post + 1; ?>
					<?php if ( $urbanangels_projects_count % 9 == 0): ?>
					<?php elseif ( $urbanangels_projects_count % 3 == 0): ?>
						</div><!--.row--><div class="row">	
					<?php endif; ?>
				<?php endwhile; else :?>
				<?php endif; ?>

		</div><!--.row-->
	</div><!--#urbanangels_projects-list-->

	<!--bottom navigation to older and newer posts if there is more than one page of posts-->
	<div class="page-navigation">
		<?php
		/*
		** pagination
		*/

		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $urbanangels_projects->max_num_pages,
		) );
		?>

		<?php wp_reset_postdata(); ?>
	</div><!--.navigation-->

</main>

<?php get_footer(); ?>
