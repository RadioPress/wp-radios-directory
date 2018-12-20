<?php

class WPRadioDir_Admin {
    /** Constructor **/

    public function __construct() {
        // Add menu and admin page
        $this->add_action('admin_menu', 'add_admin_menu');

        // Add radio custom post type
        $this->add_action('init', 'create_radio_cpt', 0 );
        $this->add_action( 'init', 'create_radio_catgory_tax' );
    }

    /** Plugin actions **/

    public function add_admin_menu() {
        // $menu_icon = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents(DEZOTOOLS_DIR."assets/admin/img/dezotools-icon-no-bck.svg"));
        $menu_icon = "dashicons-album";

        add_menu_page(
            'WP radio directory : Réglages', 'WP radio dir.', 'manage_options',
            'wpradiodir_main', [&$this, 'admin_main_page'],
            $menu_icon, 95
        );
    }

    // Register Custom Post Type Radio
    public function create_radio_cpt() {
        $labels = array(
            'name'                      => _x( 'Radios', 'Post Type General Name', 'wp-radios-directory' ),
            'singular_name'             => _x( 'Radio', 'Post Type Singular Name', 'wp-radios-directory' ),
            'menu_name'                 => _x( 'Radios', 'Admin Menu text', 'wp-radios-directory' ),
            'name_admin_bar'            => _x( 'Radio', 'Add New on Toolbar', 'wp-radios-directory' ),
            'archives'                  => __( 'Archives radio', 'wp-radios-directory' ),
            'attributes'                => __( 'Attributs radio', 'wp-radios-directory' ),
            'parent_item_colon'         => __( 'Radio parentes :', 'wp-radios-directory' ),
            'all_items'                 => __( 'Toutes les radios', 'wp-radios-directory' ),
            'add_new_item'              => __( 'Ajouter une nouvelle Radio', 'wp-radios-directory' ),
            'add_new'                   => __( 'Ajouter', 'wp-radios-directory' ),
            'new_item'                  => __( 'Nouvelle la radio', 'wp-radios-directory' ),
            'edit_item'                 => __( 'Modifier la radio', 'wp-radios-directory' ),
            'update_item'               => __( 'Mettre à jour la radio', 'wp-radios-directory' ),
            'view_item'                 => __( 'Voir la radio', 'wp-radios-directory' ),
            'view_items'                => __( 'Voir les radios', 'wp-radios-directory' ),
            'search_items'              => __( 'Rechercher dans les Radio', 'wp-radios-directory' ),
            'not_found'                 => __( 'Aucune radio trouvé.', 'wp-radios-directory' ),
            'not_found_in_trash'        => __( 'Aucune radio trouvé dans la corbeille.', 'wp-radios-directory' ),
            'featured_image'            => __( 'Logo', 'wp-radios-directory' ),
            'set_featured_image'        => __( 'Définir le Logo', 'wp-radios-directory' ),
            'remove_featured_image'     => __( 'Supprimer le Logo', 'wp-radios-directory' ),
            'use_featured_image'        => __( 'Utiliser comme Logo', 'wp-radios-directory' ),
            'insert_into_item'          => __( 'Insérer dans la radio', 'wp-radios-directory' ),
            'uploaded_to_this_item'     => __( 'Téléversé sur cet radio', 'wp-radios-directory' ),
            'items_list'                => __( 'Liste des radios', 'wp-radios-directory' ),
            'items_list_navigation'     => __( 'Navigation de la liste radios', 'wp-radios-directory' ),
            'filter_items_list'         => __( 'Filtrer la liste radios', 'wp-radios-directory' ),
        );
        $rewrite = array(
            'slug'          => 'radios',
            'with_front'    => true,
            'pages'         => true,
            'feeds'         => true,
        );
        $args = array(
            'label'                 => __( 'Radio', 'wp-radios-directory' ),
            'description'           => __( 'Annuaire radios', 'wp-radios-directory' ),
            'labels'                => $labels,
            'menu_icon'             => 'dashicons-format-audio',
            'supports'              => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'comments', 'custom-fields'),
            'taxonomies'            => array(),
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 20,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => false,
            'hierarchical'          => true,
            'exclude_from_search'   => false,
            'show_in_rest'          => true,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'rewrite'               => $rewrite,
        );
        register_post_type( 'wprd-radio', $args );
    }

    // Register Taxonomy Catégorie
    public function create_radio_catgory_tax() {

        $labels = array(
            'name'              => _x( 'Catégories', 'taxonomy general name', 'wp-radios-directory' ),
            'singular_name'     => _x( 'Catégorie', 'taxonomy singular name', 'wp-radios-directory' ),
            'search_items'      => __( 'Rechercher dans les catégories', 'wp-radios-directory' ),
            'all_items'         => __( 'Toutes les catégories', 'wp-radios-directory' ),
            'parent_item'       => __( 'Catégorie parente', 'wp-radios-directory' ),
            'parent_item_colon' => __( 'Catégorie parente:', 'wp-radios-directory' ),
            'edit_item'         => __( 'Modifier la catégorie', 'wp-radios-directory' ),
            'update_item'       => __( 'Mettre à jour la catégorie', 'wp-radios-directory' ),
            'add_new_item'      => __( 'Ajouter une nouvelle catégorie', 'wp-radios-directory' ),
            'new_item_name'     => __( 'Nouveau nom de catégorie', 'wp-radios-directory' ),
            'menu_name'         => __( 'Catégorie', 'wp-radios-directory' ),
        );
        $rewrite = array(
            'slug'          => 'radio-category',
            'with_front'    => true,
            'hierarchical'  => false,
        );
        $args = array(
            'labels'                => $labels,
            'description'           => __( 'Catégorie des radios', 'wp-radios-directory' ),
            'hierarchical'          => false,
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'show_tagcloud'         => true,
            'show_in_quick_edit'    => true,
            'show_admin_column'     => false,
            'show_in_rest'          => true,
            'rewrite'               => $rewrite,
        );
        register_taxonomy( 'wprd-radio-catgory', array('wprd-radio'), $args );

    }

    public function admin_main_page() {
        include WPRADIODIR_DIR.'admin/templates/main.php';
    }

    /** Plugin helpers **/
    private function add_action($action, $fn, $priority = 10, $accepted_args = 1) {
        add_action($action, array(&$this, $fn), $priority, $accepted_args);
    }
}
