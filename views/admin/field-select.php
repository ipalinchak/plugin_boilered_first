<?php
/** @var array $args */
?>
<?php $select_items = ['aaaa', 'bbb'];

?>
<label for='<?php echo $args['label_for'] ?>'>
    <select name="<?php echo $args['label_for'] ?>">
        <?php foreach ($select_items as $key => $val) { ?>
            <option value="<?php echo $key ?>" <?php selected($args['value'], $key ); ?>  >
                <?php echo $val ?>
            </option>

        <?php } ?>

    </select>
    <?php echo  $args['label_text'] ?>
</label>
<br/>