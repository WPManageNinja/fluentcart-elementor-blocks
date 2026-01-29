<?php

namespace FluentCartElementorBlocks\App\Hooks\Handlers;

use FluentCartElementorBlocks\App\Core\App;
use FluentCartElementorBlocks\App\Utils\Enqueuer\Enqueue;

class AdminMenuHandler
{
    /**
     * Add Custom Menu
     * 
     * @return null
     */
    public function add()
    {
        add_menu_page(
            __('FluentCart Elementor Blocks', 'fluentcartelementorblocks'),
            __('FluentCart Elementor Blocks', 'fluentcartelementorblocks'),
            'manage_options',
            'FluentCart Elementor Blocks',
            [$this, 'render'],
            $this->getMenuIcon(),
            6
        );
    }

    /**
     * Render the menu page
     * 
     * @return null
     */
    public function render()
    {
        $this->enqueueAssets(
            $app = App::getInstance(),
            $slug = $app->config->get('app.slug')
        );

        $baseUrl = $app->applyFilters(
            'fluent_connector_base_url',
            admin_url('admin.php?page=' . $slug . '#/')
        );

        $menuItems = [
            [
                'key'       => 'dashboard',
                'label'     => __('Dashboard', 'fluentcartelementorblocks'),
                'permalink' => $baseUrl
            ]
        ];

        $app->view->render('admin.menu', [
            'name'      => $app->config->get('app.name'),
            'slug'      => $slug,
            'menuItems' => $menuItems,
            'baseUrl'   => $baseUrl,
            'logo'      => Enqueue::getStaticFilePath('images/logo.svg'),
        ]);
    }

    /**
     * Enqueue all the scripts and styles
     * @param  WPFluent\Foundation\Application $app
     * @param  string $slug
     * @return null
     */
    public function enqueueAssets($app, $slug)
    {
        Enqueue::style($slug . '_admin_app', 'scss/admin.scss');

        $app->doAction($slug . '_loading_app');

        Enqueue::script(
            $slug . '_admin_app',
            'admin/app.js',
            ['jquery'],
            '1.0',
            true
        );

        Enqueue::script(
            $slug . '_global_admin',
            'admin/global_admin.js',
            [],
            '1.0',
            true
        );

        $this->localizeScript($app, $slug);
    }

    /**
     * Push/Localize the JavaScript variables
     * to the browser using wp_localize_script.
     * 
     * @param  WPFluent\Foundation\Application $app
     * @param  string $slug
     * @return null
     */
    protected function localizeScript($app, $slug)
    {
        $currentUser = get_user_by('ID', get_current_user_id());

        wp_localize_script($slug . '_admin_app', 'fluentFrameworkAdmin', [
            'slug'  => $slug,
            'nonce' => wp_create_nonce($slug),
            'user_locale' => get_locale(),
            'rest'  => $this->getRestInfo($app),
            'brand_logo' => $this->getMenuIcon(),
            'asset_url' => $app['url.assets'],
            'me'            => [
                'id'        => $currentUser->ID,
                'full_name' => trim($currentUser->first_name . ' ' . $currentUser->last_name),
                'email'     => $currentUser->user_email
            ],
        ]);
    }

    /**
     * Gether rest info/settings for http client.
     * 
     * @param  WPFluent\Foundation\Application $app
     * @return array
     */
    protected function getRestInfo($app)
    {
        $ns = $app->config->get('app.rest_namespace');
        $ver = $app->config->get('app.rest_version');

        return [
            'base_url'  => esc_url_raw(rest_url()),
            'url'       => rest_url($ns . '/' . $ver),
            'nonce'     => wp_create_nonce('wp_rest'),
            'namespace' => $ns,
            'version'   => $ver
        ];
    }

    /**
     * Get the default icon for custom menu
     * added by the add_menu in the WP menubar.
     * 
     * @return string
     */
    protected function getMenuIcon()
    {
        return 'dashicons-wordpress-alt';
    }

    /**
     * Makes the class invokable.
     * 
     * @return null
     */
    public function __invoke()
    {
        $this->add();
    }
}

