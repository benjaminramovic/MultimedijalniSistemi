<?php get_template_part("template-parts/header"); ?>


<div class="movie-details">
    <?php if (has_post_thumbnail()) : ?>
            <div class="featured-image">
                <?php the_post_thumbnail('medium'); // Adjust size as needed ?>
            </div>
        <?php endif; ?>
    <h1><?php the_title(); ?></h1>
    <?php
    $movie_year = get_post_meta(get_the_ID(), '_movie_year', true);
    $movie_plot = get_post_meta(get_the_ID(), '_movie_plot', true);
    $movie_cast = get_post_meta(get_the_ID(), '_movie_cast', true);
    $movie_rating = get_post_meta(get_the_ID(), '_movie_rating', true);
    ?>

    <div class="movie-details-view">
        <div class="movie-details-view-row">
            <div class="movie-details-view-row-right">
                <p><strong>Godina:</strong>
            </div>
            <div class="movie-details-view-row-left">
                <p><?php echo esc_html($movie_year); ?></p>
            </div>
        </div>
        <div class="movie-details-view-row">
            <div class="movie-details-view-row-right">
                <p><strong>Radnja:</strong>
            </div>
            <div class="movie-details-view-row-left">
                <p><?php echo esc_html($movie_plot); ?></p>
            </div>
        </div>
        <div class="movie-details-view-row">
            <div class="movie-details-view-row-right">
                <p><strong>Ocena:</strong>
            </div>
            <div class="movie-details-view-row-left">
                <p><?php echo strval($movie_rating); ?></p>
            </div>
        </div>
        <div class="movie-details-view-row">
            <div class="movie-details-view-row-right">
                <p><strong>Žanr:</strong></p>
            </div>
            <div class="movie-details-view-row-left">
                    <?php
                $zanrovi = get_the_terms(get_the_ID(), 'zanr');
                if ($zanrovi && !is_wp_error($zanrovi)) {
                    $zanrovi_nazivi = array();
                    foreach ($zanrovi as $zanr) {
                        $zanrovi_nazivi[] = esc_html($zanr->name);
                    }
                    echo "<p>" . implode(', ', $zanrovi_nazivi) . "</p>";
                } else {
                    echo 'Nema dostupnih žanrova';
                }
                ?>
            </div>
        </div>
    </div>
     
<!--     <p><strong>Glavni glumci:</strong> <?php echo esc_html($movie_cast); ?></p>
 -->     

    <!-- Prikaz žanra (kategorije) kojem film pripada -->
    
       

    <div class="movie-content">
        <?php the_content(); ?>
    </div>
</div>

