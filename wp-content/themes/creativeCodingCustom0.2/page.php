<?php get_header(); ?>


<div id="content" class="default">

  <div class="hero">
    <img src="<?php the_field('hero_image'); ?>">
    <h3><?php the_title() ?></h3>
  </div>

	<div id="inner-content" class="wrap cf">

			<main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					<section class="entry-content cf">
						<?php echo $post->post_content ?>
					</section>


			</main>

	</div>

</div>


<?php get_footer(); ?>
