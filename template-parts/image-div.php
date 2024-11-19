<div class="image-div">
    <?php if (!is_front_page()): ?>
        <h2 id="title">
            <?php the_title(); ?>
        </h2>
        
    <?php else:
        echo "<div id='image-div-inner'>
                <h1>Movingly</h1>
                <p>Sajt za najbolje recenzije stranih i domacih filmova!</p>
              </div>";
        ?>
    <?php endif; ?>
</div>