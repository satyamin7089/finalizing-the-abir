<?php get_header(); ?>
<main style="max-width:900px;margin:50px auto;padding:0 24px">
  <?php while ( have_posts() ) : the_post(); ?><article <?php post_class(); ?>><h1><?php the_title(); ?></h1><?php the_content(); ?></article><?php endwhile; ?>
</main>
<?php get_footer(); ?>
