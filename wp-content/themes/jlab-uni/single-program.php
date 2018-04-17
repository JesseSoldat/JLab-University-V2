<?php get_header(); ?>

<?php 
  while(have_posts()) {
    the_post();
?>
  <div class="page-banner">
    <div class="page-banner__bg-image" 
      style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg'); ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php the_title(); ?></h1>
      <div class="page-banner__intro">
        <p></p>
      </div>
    </div>  
  </div>

  <div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
      <p>
        <a href="<?php echo get_post_type_archive_link('program'); ?>" 
          class="metabox__blog-home-link">
          <i class="fa fa-home" aria-hidden="true"></i> 
          All Programs
        </a>
        <span class="metabox__main">
          <?php the_title(); ?>
        </span>
      </p>
    </div>

    <div class="generic-content">
      <?php the_content(); ?>
    </div>
  

    <?php
      //Events----------------------------------------
      $today = date('Ymd');
      $events = new WP_Query(array(
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
          ),
          array(
            'key' => 'related_programs',
            'compare' => 'LIKE',
            'value' => '"' . get_the_ID() . '"'
          )
        )
      ));
      if($events->have_posts()) {
        echo '<hr class="section-break">';
        echo '<h4 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h4><br>';
        while($events->have_posts()) {
          $events->the_post();
          get_template_part('template-parts/content', 'event');
        }
      }
      wp_reset_postdata();
    ?>
  </div>
<?php
  }
?>


<?php get_footer(); ?>