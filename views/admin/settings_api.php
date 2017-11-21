

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">

        <?php
        // Поля для безпеки для зареєстрованих налаштувань
        settings_fields('palinchak_sets');

        // Вивід секцій налаштувань та їх полів
                    do_settings_sections( 'plugin-slug-palSettings' );
//        do_settings_fields('plugin-slug-palSettings', 'some_settings_section');

        // Кнопка збереження
        submit_button('Save Settings');
        ?>
    </form>
</div>
