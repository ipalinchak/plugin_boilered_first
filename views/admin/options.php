

<form method="post">
    <input type="hidden" value="1" name="submitted">
    <div class="wrap">
        <h1>Mod options</h1>
        <table class="form-table">
            <tbody>
            <tr>
                <th>option1</th>
                <td>
                    <label>
                        <input type="checkbox"
                               name="first_check" <?php echo checked($options['0'], 'on') ?> >
                        <?php _e('Some checkbox') ?>
                    </label>
                </td>
            </tr>
            <tr>
                <th>option</th>
                <td>
                    <label>
                        <select name="first_selct">
                            <?php foreach ($select_items as $key => $val) { ?>
                                <option value="<?php echo $key ?>" <?php selected($options['1'], $key ); ?>  >
                                    <?php echo $val ?>
                                </option>

                            <?php } ?>
                            <?php _e('Some select') ?>
                        </select>
                    </label>
                </td>
            </tr>

            <tr>
                <th>Input</th>
                <td>
                    <label>
                        <input name="some_input" value="<?=$options['2']?>"/>
                        <?php _e('Description input') ?>
                    </label>
                </td>
            </tr>

            </tbody>
        </table>
    </div>
    <?php submit_button() ?>
</form>
<?php