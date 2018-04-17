<div class="event-summary">
  <a href="<?php the_permalink(); ?>" 
    class="event-summary__date t-center">
    <span class="event-summary__month">
      Jan
    </span>
    <span class="event-summary__day">
      14
    </span>
  </a>
  <div class="event-summary__content">
    <h5 class="event-summary__title headline headline--tiny">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h5>
    <p>
      <?php
        if(has_excerpt()) {
          echo get_the_excerpt();
        } else {
          echo wp_trim_words(get_the_content(), 18);
        }
      ?>
      <a href="<?php the_permalink(); ?>" class="nu gray">
        Learn more
      </a>
    </p>
  </div>
</div>
<br><br>