<?php

namespace Sync\Api\Admin;


/**
 * Menu class
 */
class Menu {
    public function __construct() {
        add_action('admin_menu', [$this, 'admin_menu_callback']);
    }

    /**
     * Register Admin Menu
     *
     * @return void
     */
    public function admin_menu_callback() {
        add_menu_page(__('Nex Auto Sync', 'nexautosync'), __('Nex Auto Sync', 'nexautosync'), 'manage_options', 'auto-sync-api', [$this, 'main_menu_page_cb'], 'dashicons-saved');
        add_submenu_page(__('auto-sync-api', 'nexautosync'), __('Sync Dashboard', 'nexautosync'), 'Sync Dashboard', 'manage_options', 'auto-sync-api', [$this, 'main_menu_page_cb']);
        add_submenu_page(__('auto-sync-api', 'nexautosync'), __('Settings', 'nexautosync'), __('Settings', 'nexautosync'), 'manage_options', 'nex_sync_settings', [$this, 'settings_callback']);
    }


    /**
     * Dashboard Main Page Callback
     *
     * @return void
     */
    public function main_menu_page_cb() {
        $dashboard = new Dashboard();
        $dashboard->dashboard_page();
    }

    /**
     * Woo Solutions Plugin Callback
     *
     * @return void
     */
    public function settings_callback() {
        $setiings_template = new Settings();
        $setiings_template->settings_page();
    }
}
