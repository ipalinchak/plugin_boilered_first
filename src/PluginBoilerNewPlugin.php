<?php namespace Permmerce\PluginBoilerNew;


use Permmerce\PluginBoilerNew\Admin\AdminOptions;
use Permmerce\PluginBoilerNew\Frontend\Frontend;
use Permmerce\PluginBoilerNew\Admin\AdminSettings;
use Permmerce\PluginBoilerNew\Admin\MetaData;

/**
 * Class PluginBoilerNewPlugin
 *
 * @package Permmerce\PluginBoilerNew
 */
class PluginBoilerNewPlugin {

	/**
	 * @var FileManager
	 */
	private $fileManager;

	/**
	 * PluginManager constructor.
	 *
	 * @param FileManager $fileManager
	 */
	public function __construct( FileManager $fileManager ) {

		$this->fileManager = $fileManager;
        add_action( 'init', [$this,'custom_post_type'] );
        add_action( 'init', [ $this, 'loadTextDomain' ] );
        add_action('init', [$this, 'registerNewTaxonomy']);
        add_action( 'admin_enqueue_scripts', [$this,'script_for_admin']);
	}

    function custom_post_type() {
        register_post_type('palinchak_post_type',
            [
                'labels'              => [
                    'name'          => __('TextVideo','premmerce-palinchak-first-plugin-BoilerNew'),
                    'singular_name' => _e('VideosEn','premmerce-palinchak-first-plugin-BoilerNew'),
                ],
                'public'              => true,
                'has_archive'         => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 5,
                'menu_icon'           => 'dashicons-admin-page',
                'show_in_admin_bar'   => true,
                'show_in_nav_menus'   => true,
                'can_export'          => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
            ]
        );
    }


    public function registerNewTaxonomy() {

        register_taxonomy(
            'taxonomy_entity_class',
            'palinchak_post_type',
            [
                'label'   => __('Taxonomy entity class for Pal plugin')
            ]
        );
    }

	/**
	 * Run plugin part
	 */
	public function run() {
		if ( is_admin() ) {

            new AdminOptions($this->fileManager);
            new AdminSettings($this->fileManager);
            new MetaData($this->fileManager);
		} else {
			new Frontend( $this->fileManager );
		}

	}

    /**
     * Load plugin translations
     */
    public function loadTextDomain()
    {
        $name = $this->fileManager->getPluginName();
         
        load_plugin_textdomain($name, false, $name . '/languages/');
    }

	/**
	 * Fired when the plugin is activated
	 */
	public function activate() {
		// TODO: Implement activate() method.
	}

	/**
	 * Fired when the plugin is deactivated
	 */
	public function deactivate() {
		// TODO: Implement deactivate() method.
	}

	/**
	 * Fired during plugin uninstall
	 */
	public static function uninstall() {
		// TODO: Implement uninstall() method.
	}

    /**
     * @return FileManager
     */
    public function script_for_admin($post)
    {


        if ( 'toplevel_page_plugin-slug-palOptions' == $post ) {
            wp_register_script('optiion_pal_script_all_pages', $this->fileManager->locateAsset('admin/js/optiion_pal_script_all_pages.js'));
            $options_for_script1 = ['data' => 'Script to only this page'];
            wp_localize_script('optiion_pal_script_all_pages', 'object_name1', $options_for_script1);
            wp_enqueue_script('optiion_pal_script_all_pages');
        }else{
            wp_register_script('optiion_pal_script_all_pages', $this->fileManager->locateAsset('admin/js/optiion_pal_script_all_pages.js'));
            $options_for_script1 = ['data' => 'Script to all pages'];
            wp_localize_script('optiion_pal_script_all_pages', 'object_name1', $options_for_script1);
            wp_enqueue_script('optiion_pal_script_all_pages');
        }
    }
}