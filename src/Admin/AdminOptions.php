<?php namespace Permmerce\PluginBoilerNew\Admin;


use Permmerce\PluginBoilerNew\FileManager;

class AdminOptions
{

    const SLUG = 'plugin-slug-palOptions';


    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;

        add_action('admin_menu', [$this, 'addMenuPage']);


    }

    public function addMenuPage()
    {

        add_menu_page('Title Plagin', 'Plagin palinchak menu itemOptions', 'manage_options', 'plugin-slug-palOptions', function () {
//        delete_option('chek_key');
            if (!get_option('chek_key')) {
                add_option('chek_key', 'on');
            }

//        delete_option('select_key');
            if (!get_option('select_key')) {
                add_option('select_key', '1');
            }
            if (!get_option('some_input')) {
                add_option('some_input', 'some-input text', '', 'yes');
            }

            self::mod_settings_init();
        }
            , 'dashicons-dashboard', 1);


    }

    public function mod_settings_init()
    {

        $data = $_POST;
        if (isset($data['submitted']) && isset($data['first_check'])) {
            update_option('chek_key', isset($data['first_check']) ? $data['first_check'] : []);
        } elseif (isset($data['submitted']) && !isset($data['first_check'])) {
            update_option('chek_key', '');
        }

        if (isset($data['submitted']) && isset($data['first_selct'])) {
            update_option('select_key', $data['first_selct']);
        }
        if (isset($data['submitted']) && isset($data['some_input'])) {

            update_option('some_input', isset($data['some_input']) ? $data['some_input'] : []);
        }
        $arg_check = get_option('chek_key');
        $args_select = get_option('select_key');
        $args_input = get_option('some_input');

        $options = [$arg_check, $args_select, $args_input];
        $select_items = ['aaaa', 'bbb'];


        wp_register_script('optiion_pal_script', $this->fileManager->locateAsset('admin/js/optiion_pal_script.js'));
        $options_for_script = ['data' => '22112121'];
        wp_localize_script('optiion_pal_script', 'object_name', $options_for_script);

        wp_enqueue_script('optiion_pal_script');

        wp_register_style('optiion_pal_css', $this->fileManager->locateAsset('admin/css/optiion_pal_css.css'));
        wp_enqueue_style('optiion_pal_css');
        $this->fileManager->includeTemplate('admin/options.php', ['options' => $options, 'select_items' => $select_items]);


    }

    public function optionsPageHandler()
    {
        $data = $_POST;

        if (isset($data['submitted'])) {
            update_option(self::OPTION, isset($data[self::OPTION]) ? $data[self::OPTION] : []);
        }

        $options = get_option(self::OPTION, []);

        $this->fileManager->includeTemplate('admin/options.php', ['options' => $options]);
    }


}
