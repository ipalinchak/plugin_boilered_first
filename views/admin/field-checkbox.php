<?php
/** @var array $args */
?>
<label for='<?php echo $args['label_for'] ?>'>
    <input type='checkbox' name='<?php echo $args['label_for'] ?>' <?php echo checked($args['value'], 'on') ?>>
	<?php echo $args['label_text'] ?>
</label>
<br/>