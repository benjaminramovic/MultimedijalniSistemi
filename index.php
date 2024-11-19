<?php

get_template_part('template-parts/header'); ?>

<?php get_template_part('template-parts/image-div'); ?>

<?php if (is_front_page()) : ?>
        <?php get_template_part("template-parts/best-movies"); ?>
<?php else:  ?>
        <div class="content">
        <?php the_content(); ?>
        </div> 
<?php endif; ?>

<?php get_template_part('template-parts/footer'); ?>
  