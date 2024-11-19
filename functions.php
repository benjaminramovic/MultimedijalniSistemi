<?php


add_theme_support('custom-logo');
add_image_size( 'my-custom-image-size', 640, 999 );


function my_custom_theme_enqueue() {
	
    wp_enqueue_style( 'my-mms', get_template_directory_uri() . '/assets/css/style.css' );
   // wp_enqueue_script( 'my-js', get_template_directory_uri() . '/inc/js/myJS.js' , array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_custom_theme_enqueue' );

function register_navigation_menus(){
    $locations = array(
        'menu-1' => esc_html__('Primary menu','mymms'),
        'menu-2' => esc_html__('Footer menu','mymms')
    );

    register_nav_menus($locations);
}
add_action('init','register_navigation_menus');


//promena boje
function mytheme_customize_register( $wp_customize ) {
    // Dodaj sekciju za boju navigacije
    $wp_customize->add_section( 'nav_color_section', array(
        'title'    => __( 'Navigation Color', 'mytheme' ),
        'priority' => 30,
    ) );

    // Dodaj opciju za boju navigacije
    $wp_customize->add_setting( 'nav_color', array(
        'default'   => '#ffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'nav_color', array(
        'label'    => __( 'Navigation Color', 'mytheme' ),
        'section'  => 'nav_color_section',
        'settings' => 'nav_color',
    ) ) );
}
add_action( 'customize_register', 'mytheme_customize_register' );


?>

<?php 

// Add featured image functionality.
add_theme_support( 'post-thumbnails' );

add_image_size( 'my-custom-image-size', 640, 999 );

// Add title tag functionality.
add_theme_support( 'title-tag' );

?>


<?php
//CUSTOM POSTOVI

function register_movie_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Film',
            'singular_name' => 'Film',
            'add_new' => 'Dodaj novi film',
            'add_new_item' => 'Dodaj novi film',
            'edit_item' => 'Izmeni film',
            'new_item' => 'Novi film',
            'view_item' => 'Pogledaj film',
            'search_items' => 'Pretraži filmove',
            'not_found' => 'Nema filmova',
            'not_found_in_trash' => 'Nema filmova u kanti',
            'all_items' => 'Svi filmovi',
            'archives' => 'Arhiva filmova',
            'taxonomies' => array('zanr', 'tag'), // Dodato za taksonomije
        ),
        'public' => true,
        'has_archive' => true, // Omogućava arhivu
        'rewrite' => array('slug' => 'filmovi'), // URL slug za arhivu filmova
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments'), // Podrška za naslov, sadržaj, sliku i izvod
    );
    register_post_type('movies', $args);
}
add_action('init', 'register_movie_post_type');

add_theme_support( 'post-thumbnails', array( 'movies' ) );
?>

<?php function movie_custom_fields() {
    add_meta_box(
        'movie_details',
        'Detalji o filmu',
        'movie_custom_fields_callback',
        'movies',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'movie_custom_fields');


// CUSTOM POLJA
function movie_custom_fields_callback($post) {
    wp_nonce_field(basename(__FILE__), 'movie_nonce');

    // Dohvatanje postojećih vrednosti
    $movie_year = get_post_meta($post->ID, '_movie_year', true);
    $movie_plot = get_post_meta($post->ID, '_movie_plot', true);
    $movie_cast = get_post_meta($post->ID, '_movie_cast', true);
    $movie_rating = get_post_meta($post->ID, '_movie_rating', true);
    $movie_image = get_post_meta($post->ID, '_movie_image',true);
    ?>
    <p>
        <label for="movie_year">Godina:</label>
        <input type="text" name="movie_year" id="movie_year" value="<?php echo esc_attr($movie_year); ?>" />
    </p>
    <p>
        <label for="movie_plot">Radnja:</label>
        <textarea name="movie_plot" id="movie_plot"><?php echo esc_textarea($movie_plot); ?></textarea>
    </p>
    <p>
        <label for="movie_cast">Glavni glumci:</label>
        <input type="text" name="movie_cast" id="movie_cast" value="<?php echo esc_attr($movie_cast); ?>" />
    </p>
    <p>
        <label for="movie_rating">Ocena:</label>
        <input type="number" step="0.1" name="movie_rating" id="movie_rating" value="<?php echo esc_attr($movie_rating); ?>" min="0" max="10" />
    </p>
    <p>
        <label for="movie_image">Slika filma:</label><br>
        <input type="text" name="movie_image" id="movie_image" value="<?php echo esc_url($movie_image); ?>" style="width: 80%;" />
        <input type="button" id="movie_image_button" class="button" value="Odaberite ili postavite sliku" />
        <input type="file" name="movie_image_file" id="movie_image_file" style="display:none;" />
    </p>
    <script>
        document.getElementById('movie_image_button').addEventListener('click', function() {
            var fileInput = document.getElementById('movie_image_file');
            fileInput.click();
        });

        document.getElementById('movie_image_file').addEventListener('change', function(event) {
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('movie_image').value = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <?php
}?>

<?php function save_movie_custom_fields($post_id) {
    if (!isset($_POST['movie_nonce']) || !wp_verify_nonce($_POST['movie_nonce'], basename(__FILE__))) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Čuvanje vrednosti polja
    if (isset($_POST['movie_year'])) {
        update_post_meta($post_id, '_movie_year', sanitize_text_field($_POST['movie_year']));
    }
    if (isset($_POST['movie_plot'])) {
        update_post_meta($post_id, '_movie_plot', sanitize_textarea_field($_POST['movie_plot']));
    }
    if (isset($_POST['movie_cast'])) {
        update_post_meta($post_id, '_movie_cast', sanitize_text_field($_POST['movie_cast']));
    }
    if (isset($_POST['movie_rating'])) {
        update_post_meta($post_id, '_movie_rating', sanitize_text_field($_POST['movie_rating']));
    }
    if (isset($_POST['movie_image'])) {
        update_post_meta($post_id, '_movie_rating', sanitize_text_field($_POST['movie_image']));
    }
}
add_action('save_post', 'save_movie_custom_fields');
?>



<?php
function widget_registration($name, $id, $description,$beforeWidget, $afterWidget, $beforeTitle, $afterTitle){
	register_sidebar( array(
		'name' =>  __( $name, 'mymms' ),
		'id' => $id,
		'description' => $description,
		'before_widget' => $beforeWidget,
		'after_widget' => $afterWidget,
		'before_title' => $beforeTitle,
		'after_title' => $afterTitle,
	));
}
function multiple_widget_init(){
	widget_registration('Footer widget ', 'footer-widget', 'test', '', '', '', '');
	
}
add_action('widgets_init', 'multiple_widget_init'); 
?>

<?php
add_theme_support( 'post-thumbnails', array( 'movies' ) );


//CUSTOM TAXONOMIES
function register_custom_taxonomies(){
    register_taxonomy(
        'zanr',
        'movies',
        array(
            'label' => __('Zanrovi'),
            'rewrite' => array('slug' => 'zanr'),
            'hierarchical' => true,
            'show_ui' => true
        )

        );
        register_taxonomy(
        'tag',
        'movies',
        array(
            'label' => __('Tagovi'),
            'rewrite' => array('slug' => 'tag'),
            'hierarchical' => false,
            'show_ui' => true

        )
        );
}
add_action('init','register_custom_taxonomies',0);



?>