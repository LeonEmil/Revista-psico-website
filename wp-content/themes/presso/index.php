<?php get_header(); ?>

<div id="page-wrapper" class="container">

<div class="flexslider no-control-nav post-slider">
	<ul class="slides">

	<?php while( have_posts() ) : the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'envirra'), the_title_attribute('echo=0') ); ?>" rel="bookmark">
				<div class="post-thumbnail-wrapper">
					<?php the_post_thumbnail( 'vw_large' ); ?>
				</div>

				<div class="post-box-inner">
					<?php $post_date = get_the_time(get_option('date_format')); ?>

					<h3 class="title">
						<span class="super-title"><?php echo $post_date; ?></span>
						<span><?php the_title(); ?></span>
					</h3>
					<span class="read-more label label-large">
						<?php _e( 'Leer más', 'envirra' ); ?> <i class="icon-entypo-right-open"></i>
					</span>
				</div>
			</a>
		</li>
	<?php endwhile; ?>
	
	</ul>
</div>



	<div class="row">
		<div id="page-content" class="col-sm-7 col-md-8">
			
			<?php if (have_posts()) : ?>

				<?php get_template_part( 'templates/page-title' ); ?>
				
				<?php $blog_layout = vw_get_option( 'blog_layout' ); ?>
				
				<?php if ( 'classic' == $blog_layout ) : ?>

				<div class="row archive-posts post-box-list">
					<?php while (have_posts()) : the_post(); ?>
					<div class="col-sm-12 post-box-wrapper">
						<?php get_template_part( 'templates/post-box/classic', get_post_format() ); ?>
					</div>
					<?php endwhile; ?>
				</div>

				<?php else: ?>

				<div class="row archive-posts vw-isotope post-box-list">
					<?php while (have_posts()) : the_post(); ?>
					<div class="col-sm-6 post-box-wrapper">
						<?php get_template_part( 'templates/post-box/large-thumbnail', get_post_format() ); ?>
					</div>
					<?php endwhile; ?>
				</div>

<?php $curcategory = get_the_category(); ?>
<h1 class="post-title title title-large"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'envirra'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php single_cat_title(); ?></a></h1>
<h2 class="post-subtitle subtitle"><?php echo $curcategory[0]->category_description ?></h2>

				<?php endif; ?>

				<?php get_template_part( 'templates/pagination' ); ?>

				<?php comments_template(); ?>

			<?php else : ?>

				<h2><?php _e('Sorry, no posts were found', 'envirra') ?></h2>

			<?php endif; ?>
			
		</div>

		<aside id="page-sidebar" class="sidebar-wrapper col-sm-5 col-md-4">
			<?php get_sidebar(); ?>
		</aside>
	</div>
</div>

<?php get_footer(); ?>