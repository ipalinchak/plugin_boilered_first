<?php namespace Permmerce\PluginBoilerNew\Admin;


use Permmerce\PluginBoilerNew\FileManager;

class AdminSettings
{

    const SLUG = 'plugin-slug-palSettings';
    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
        add_action('admin_init', [$this, 'initSettingsPl']);
        add_action('admin_menu', [$this, 'add_submenu_page']);

    }


    public function initSettingsPl()
    {
        register_setting('palinchak_sets', 'chek_key');

        $options = get_option('chek_key');

        add_settings_section(
            'some_settings_section',
            'TITLE some_settings_section',
            function () {
                echo _e('Check some data');
            },
            'plugin-slug-palSettings'
        );

        add_settings_field(
            'chek_key',
            'Lable for chek_key',
            [$this, 'renderCheckboxHtmlS'],
//            self::renderCheckboxHtml(),
            'plugin-slug-palSettings',
            'some_settings_section',
            [
                'label_text' => 'Add perfect style to your site',
                'label_for' => 'chek_key',
                'value' => isset($options) ? $options : $options,
            ]
        );
        /*-----------------------------*/
        register_setting('palinchak_sets', 'select_key');
        $select_options = get_option('select_key');


        add_settings_field(
            'select_key',
            'Lable for select_key',
            [$this, 'renderSelectHtml'],
            'plugin-slug-palSettings',
            'some_settings_section',
            [
                'label_text' => 'Add perfect style to your select',
                'label_for' => 'select_key',
                'value' => isset($select_options) ? $select_options : $select_options,
            ]
        );


        /*-----------------------------*/
        register_setting('palinchak_sets', 'some_input');
        $some_input_options = get_option('some_input');

        add_settings_field(
            'some_input',
            'Lable for some_input',
            [$this,'renderInputHtml'],
            'plugin-slug-palSettings',
            'some_settings_section',
            [
                'label_text' => 'Add perfect style to your input',
                'label_for' => 'some_input',
                'value' => isset($some_input_options) ? $some_input_options : '',
            ]
        );
// Перевірка прав доступу
        if (!current_user_can('manage_options')) {
            return;
        }

        // Перевірити чи користувач засабмітив налаштування
        // Wordpress додає "settings-updated" до $_GET
        if (isset($_GET['settings-updated'])) {
            // Додати повідомлення "updated"
            add_settings_error('premmerce_messages', 'premmerce_message', 'Settings Saved', 'updated');
        }

        // Показати повідомлення повідомлення error/update
        settings_errors('premmerce_messages');


    }


    public function add_submenu_page()
    {
        add_submenu_page(AdminOptions::SLUG, 'Settings',
            'SettingsMy',
            'manage_options',
            self::SLUG,
            [$this, 'sub_menu_api_settings'],
            'dashicons-dashboard');

    }



    public function renderCheckboxHtmlS($args)
    {

        $this->fileManager->includeTemplate('admin/field-checkbox.php', ['args' => $args]);

    }
    public function renderSelectHtml($args)
    {

        $this->fileManager->includeTemplate('admin/field-select.php', ['args' => $args]);

    }
    public function renderInputHtml($args)
    {
        $this->fileManager->includeTemplate('admin/input-text.php', ['args' => $args]);

    }
    public function sub_menu_api_settings()
    {
        $this->fileManager->includeTemplate('admin/settings_api.php');

    }


}
