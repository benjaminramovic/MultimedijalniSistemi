<div id="best-movies">
    <div id="best-movies-inner">
        <h3>Najnoviji filmovi</h3>
        <div id="best-movies-list">
            <?php
            // WP_Query za uzimanje 5 poslednjih filmova
            $args = array(
                'post_type' => 'movies', // Specifikacija custom post type-a
                'posts_per_page' => 5, // Ograničenje na 5 filmova
                'orderby' => 'date', // Sortiranje po datumu
                'order' => 'DESC' // Najnoviji filmovi prvo
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); 
                    // Dohvatanje URL-a slike iz custom polja
                    $movie_image = get_post_meta(get_the_ID(), '_movie_image', true); // Polje 'movie_image' je gde se čuva slika
                    $image_url = $movie_image ? $movie_image : get_the_post_thumbnail_url(get_the_ID(), 'full'); // Ako slika postoji u metapodatku, koristi je, inače koristi istaknutu sliku
            ?>
                    <div class="list-item" style="background:url('<?php echo esc_url($image_url); ?>'); background-position: center; background-size: cover;">
                        <div class="list-item-details">
                            <p><?php the_title(); ?></p>
                            <p><?php echo get_post_meta(get_the_ID(), 'rating', true); // Ovde stavite prilagodbu za ocenu ?></p>
                            <button><a id="movie-title" href="<?php the_permalink(); ?>">Pogledaj detalje</a></button>
                        </div>
                    </div>
                <?php endwhile;
            else :
                echo '<p>' . __('Nema filmova.', 'multimedijalni-sistemi') . '</p>';
            endif;
            wp_reset_postdata(); // Resetovanje globalnog post objekta
            ?>
        </div>
    </div>
</div>
