<?php

class WPRadioDir_Admin {
    /** Constructor **/

    public function __construct() {
        // Add menu and admin page
        $this->add_action('admin_menu', 'add_admin_menu');
    }

    /** Plugin actions **/

    public function add_admin_menu() {
        // $menu_icon = 'data:image/svg+xml;base64,' . base64_encode(file_get_contents(DEZOTOOLS_DIR."assets/admin/img/dezotools-icon-no-bck.svg"));
        $menu_icon = "dashicons-album";

        add_menu_page(
            'WP radio directory : Réglages', 'WP radio directory', 'manage_options',
            'wpradiodir_main', [&$this, 'admin_main_page'],
            $menu_icon, 95
        );
    }

    public function admin_main_page() {
        include WPRADIODIR_DIR.'admin/templates/main.php';
    }

    /** Plugin helpers **/
    private function add_action($action, $fn, $priority = 10, $accepted_args = 1) {
        add_action($action, array(&$this, $fn), $priority, $accepted_args);
    }
}
