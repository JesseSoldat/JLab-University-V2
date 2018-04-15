<?php get_header(); ?>

<?php
  while(have_posts()) {
    the_post();
?>
    <h2><?php the_title(); ?></h2>
    <h4><?php the_content(); ?></h4>
<?php
  }
?>

<?php get_footer(); ?>
