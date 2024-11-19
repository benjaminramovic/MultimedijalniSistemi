<?php get_template_part('template-parts/header'); ?>

<h1><?php single_term_title(); ?></h1>

<?php if (have_posts()) : ?>
    <div class="movie-list">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="movie-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="movie-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="movie-details">
                        <h2>
                            <a id="movie-title" href="<?php the_permalink(); ?>">
                                <p>Zanr: </p><?php the_title(); ?>
                            </a>
                        </h2>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Nema filmova za prikazivanje.</p>
        <?php endif; ?>
    </div>
<?php else : ?>
    <p>Nema filmova u ovom žanru.</p>
<?php endif; ?>

<?php get_template_part('template-parts/footer'); ?>
