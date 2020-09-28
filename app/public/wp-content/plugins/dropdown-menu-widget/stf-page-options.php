<div class="wrap stf_options_page">
	<h2><?php echo esc_html( $title ); ?></h2>

<!-- Notifications -->
<?php if ( isset($_GET['message']) && isset($messages[$_GET['message']]) ) { ?>
<div id="message" class="updated fade"><p><?php echo $messages[$_GET['message']]; ?></p></div>
<?php } ?>
<?php if ( isset($_GET['error']) && isset($errors[$_GET['error']]) ) { ?>
<div id="message" class="error fade"><p><?php echo $errors[$_GET['error']]; ?></p></div>
<?php } ?>
<!-- [End] Notifications -->

<div id="nav"><?php if(!empty($navigation)){echo $navigation;} ?></div>

<div class="stf_opts_wrap">
<div class="stf_options">

<div id="demo"><h3>Menu Demo:</h3><?php shailan_dropdown_menu(); ?><br />
<em>Please note, demo uses <a href="https://metinsaylan.com/4598/dropdown-menu-widget-template-tag-usage-explained/" target="_blank">php template tag</a>.</em></div>

<form method="post">
<div id="ddmw_options">

<div class="ddmw_options_container">

	<div id="tabs-footer" class="clearfix">
		<p class="submit">
			<?php submit_button( 'Save Changes', 'primary', 'save', false ); ?>
			<input type="hidden" name="action" value="save" />
		</p>
		</form>

		<form method="post">
			<?php submit_button( 'Reset Options', 'secondary', 'reset', false ); ?>
			<input type="hidden" name="action" value="reset" />
		</form>
	</div>

<?php foreach ($options as $field) {
switch ( $field['type'] ) {

	case 'section': ?>

<h3 id="<?php echo sanitize_title( $field['name'] ); ?>" class="section-title"><?php echo $field['label']; ?></h3>

<?php

	case 'open': ?>

<div class="settings-section">

<?php break;

	case 'close': ?>

</div>
<div id="tabs-footer" class="clearfix">
	<p class="submit">
		<?php submit_button( 'Save Changes', 'primary', 'save', false ); ?>
		<input type="hidden" name="action" value="save" />
	</p>
	</form>

	<form method="post">
		<?php submit_button( 'Reset Options', 'secondary', 'reset', false ); ?>
		<input type="hidden" name="action" value="reset" />
	</form>
</div>

<?php break;

	case 'paragraph': ?>

<div class="stf_paragraph clearfix">
	<?php echo $field['desc']; ?>
</div>

<?php
break;

	case 'text': ?>

<div class="stf_input stf_text clearfix">
	<label for="<?php echo $field['id']; ?>"><?php echo $field['name']; ?></label>
 	<input name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>" type="<?php echo $field['type']; ?>" value="<?php if ( isset($current[ $field['id'] ]) && $current[ $field['id'] ] != "") { echo esc_html(stripslashes($current[ $field['id'] ] ) ); } ?>" />
	<small><?php echo $field['desc']; ?></small>
</div>

<?php
break;

case 'textarea':
?>

<div class="stf_input stf_textarea clearfix">
	<label for="<?php echo $field['id']; ?>"><?php echo $field['name']; ?></label>
 	<textarea name="<?php echo $field['id']; ?>" type="<?php echo $field['type']; ?>" cols="" rows=""><?php if ( $current[ $field['id'] ] != "") { echo stripslashes($current[ $field['id'] ] ); } else { echo $field['std']; } ?></textarea>
 <small><?php echo $field['desc']; ?></small>

 </div>

<?php
break;

case 'htmlarea':
?>

<div class="stf_input stf_textarea clearfix">
	<label for="<?php echo $field['id']; ?>"><?php echo $field['name']; ?></label>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#<?php echo $field['id']; ?>').wysiwyg();
});
</script>

 	<textarea name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>" type="<?php echo $field['type']; ?>" cols="" rows=""><?php if ( $current[ $field['id'] ] != "") { echo stripslashes($current[ $field['id'] ] ); } else { echo $field['std']; } ?></textarea>
 <small><?php echo $field['desc']; ?></small>

</div>

<?php
break;

case 'select':
?>

<div class="stf_input stf_select clearfix">
	<label for="<?php echo $field['id']; ?>"><?php echo $field['name']; ?></label>

<select name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>">
<?php foreach ($field['options'] as $key=>$name) { ?>
		<option <?php if ( isset($current[ $field['id'] ]) && $current[ $field['id'] ] == $key) { echo 'selected="selected"'; } ?> value="<?php echo $key;?>"><?php echo $name; ?></option><?php } ?>
</select>

	<small><?php echo $field['desc']; ?></small>
</div>
<?php
break;

case "checkbox":
?>

<div class="stf_input stf_checkbox clearfix">
	<label for="<?php echo $field['id']; ?>"><?php echo $field['name']; ?></label>

	<input type="checkbox" name="<?php echo $field['id']; ?>" id="<?php echo $field['id']; ?>" value="on" <?php checked($current[ $field['id'] ], "on") ?> />

	<small><?php echo $field['desc']; ?></small>
 </div>
<?php break;
case "section":

?>

<div class="stf_section tab_content" id="<?php echo sanitize_title( $field['name'] ); ?>">

<?php break;

case "splitter":
?>
<div class="shailan_dm_input shailan_dm_splitter"></div>
<?php break;

case 'picker':
?>
	<div id="picker"></div>

<?php break;

}
}
?>

</div>
</div>
</div>

<?php if(WP_DEBUG){ ?>
<h3>Debug information</h3>
<p>You are seeing this because your WP_DEBUG variable is set to true.</p>
<pre><?php print_r($current) ?></pre>
<?php } ?>

</div>
