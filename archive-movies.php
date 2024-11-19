<?php get_template_part('template-parts/header'); ?>

<?php get_template_part('template-parts/image-div'); ?>

<div class="content">
<div class="movie-archive">
    <h1>Svi Filmovi</h1>

    <!-- Select za filtriranje po kategorijama -->
    <div class="movie-filter">
        <div class="select-wrapper">
            <select id="category-filter" name="category-filter">
                <option value="">Filtriranje po zanru</option>
                <?php
                $zanrovi = get_terms('zanr'); // Dohvati sve žanrove
                if ($zanrovi && !is_wp_error($zanrovi)) :
                    foreach ($zanrovi as $zanr) : ?>
                        <option value="<?php echo esc_url(get_term_link($zanr)); ?>">
                            <?php echo esc_html($zanr->name); ?>
                        </option>
                    <?php endforeach;
                endif;
                ?>
            </select>
        </div>
        <div class="select-wrapper">
            <select id="category-filter" name="category-filter">
                <option value="">Sortiranje</option>
                <!-- Ostale opcije -->
            </select>
        </div>
        
    </div>

    <div class="movie-list">
        <p>aaaaa</p>
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
                                <?php the_title(); ?>
                            </a>
                        </h2>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Nema filmova za prikazivanje.</p>
        <?php endif; ?>
    </div>
</div>
</div>

<?php get_template_part('template-parts/footer'); ?>

<script>
    document.getElementById('category-filter').addEventListener('change', function() {
        var url = this.value;
        if (url) { // Ako je izabrana kategorija, preusmeri na URL
            window.location.href = url;
        }
    });
</script>
