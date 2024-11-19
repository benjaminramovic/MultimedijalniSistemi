<?php get_template_part('template-parts/') ?>

<main>
    <?php
    the_archive_title( '<h1 class="page-title">', '</h1>' );
    ?>
    <ul>
        <p>paragraf</p>
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : ?> 
           <li><?php the_post(); ?></li>
            
        <?php endwhile; ?>

    <?php else : ?>
        <p>Nema postova za prikaz.</p>
    <?php endif; ?>
    </ul>
</main>

<?php get_footer(); ?>
