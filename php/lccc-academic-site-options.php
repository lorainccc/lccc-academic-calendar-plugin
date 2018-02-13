<?php 

 /*
  *
  *  Adds a custom field to the general settings tab.
  *  The field contains the desired path to the subsite.
  *  
  *  Example: "student-resources/academic-resources"
  *
  *  No leading or trailing "/" or else it will throw off the explode.
  *
  */

 $lccc_base_site_path = new new_lccc_academic_calendar_date_settings();

class new_lccc_academic_calendar_date_settings {
 function new_lccc_academic_calendar_date_settings() {
  add_filter( 'admin_init', array( &$this , 'lccc_register_fields' ) );
 }
 
 /**
  *
  * Each field needs to be registered using register_setting and then added via add_settings_field
  *
  */

 function lccc_register_fields() {
  register_setting( 'general', 'lccc_spring_semester_startdate', 'esc_attr' );
		register_setting( 'general', 'lccc_spring_semester_enddate', 'esc_attr' );
		register_setting( 'general', 'lccc_spring_active_category', 'esc_attr' );
		
		register_setting( 'general', 'lccc_summer_semester_startdate', 'esc_attr' );
		register_setting( 'general', 'lccc_summer_semester_enddate', 'esc_attr' );
		register_setting( 'general', 'lccc_summer_active_category', 'esc_attr' );
		
		register_setting( 'general', 'lccc_fall_semester_startdate', 'esc_attr' );
		register_setting( 'general', 'lccc_fall_semester_enddate', 'esc_attr' );
		register_setting( 'general', 'lccc_fall_active_category', 'esc_attr' );		
	
  add_settings_section( 'lccc-settings', 'LCCC Academic Calendar Settings', '__return_false', 'general' );
  
		add_settings_field( 'lccc_spring_semester_startdate', '<label for="lccc_spring_semester_startdate">'.__('Spring Semester Start Date:' , 'lccc_spring_semester_startdate').'</label>', array(&$this, 'lccc_spring_semster_fields_html') , 'general', 'lccc-settings' );
		
		add_settings_field( 'lccc_spring_semester_enddate', '<label for="lccc_spring_semester_enddate">'.__('Spring Semester End Date:' , 'lccc_spring_semester_enddate').'</label>', array(&$this, 'lccc_spring_semster_end_fields_html') , 'general', 'lccc-settings' );
		
		add_settings_field( 'lccc_spring_active_category', '<label for="lccc_spring_active_category">'.__('Spring Active Category:', 'lccc_spring_active_category').'</label>', array(&$this, 'lccc_spring_active_category_fields_html') , 'general', 'lccc-settings' );
		
		add_settings_field( 'lccc_summer_semester_startdate', '<label for="lccc_summer_semester_startdate">'.__('Summer Semester Start Date:' , 'lccc_summer_semester_startdate').'</label>', array(&$this, 'lccc_summer_semster_fields_html') , 'general', 'lccc-settings' ); 
		
		add_settings_field( 'lccc_summer_semester_enddate', '<label for="lccc_summer_semester_enddate">'.__('Summer Semester End Date:' , 'lccc_summer_semester_enddate').'</label>', array(&$this, 'lccc_summer_semster_end_fields_html') , 'general', 'lccc-settings' ); 
		
		add_settings_field( 'lccc_summer_active_category', '<label for="lccc_summer_active_category">'.__('Summer Active Category:', 'lccc_summer_active_category').'</label>', array(&$this, 'lccc_summer_active_category_fields_html') , 'general', 'lccc-settings' );
		
		add_settings_field( 'lccc_fall_semester_startdate', '<label for="lccc_fall_semester_startdate">'.__('Fall Semester Start Date:' , 'lccc_fall_semester_startdate').'</label>', array(&$this, 'lccc_fall_semster_fields_html') , 'general', 'lccc-settings' );
		
		add_settings_field( 'lccc_fall_semester_enddate', '<label for="lccc_fall_semester_enddate">'.__('Fall Semester End Date:' , 'lccc_fall_semester_enddate').'</label>', array(&$this, 'lccc_fall_semster_end_fields_html') , 'general', 'lccc-settings' );
		
		add_settings_field( 'lccc_fall_active_category', '<label for="lccc_fall_active_category">'.__('Fall Active Category:', 'lccc_fall_active_category').'</label>', array(&$this, 'lccc_fall_active_category_fields_html') , 'general', 'lccc-settings' );
		
 }
 
 function lccc_spring_semster_fields_html() {

?>
<script>
jQuery(document).ready(function(){
jQuery('#lccc_spring_semester_startdate').datepicker({
	dateFormat: "mm/dd/yy"
});
});
</script>
	<?php
  $value = get_option( 'lccc_spring_semester_startdate', '' );
  echo '<input type="text" id="lccc_spring_semester_startdate" name="lccc_spring_semester_startdate" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the start date of the spring semester.</p>';
  echo '<p class="description" id="tagline-description"><strong>Example: January 17, 2016</strong></p>';
 }
	 
 function lccc_spring_semster_end_fields_html() {
?>
<script>
jQuery(document).ready(function(){
jQuery('#lccc_spring_semester_enddate').datepicker({
	dateFormat: "mm/dd/yy"
});
});
</script>
	<?php
  $value = get_option( 'lccc_spring_semester_enddate', '' );
  echo '<input type="text" id="lccc_spring_semester_enddate" name="lccc_spring_semester_enddate" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the end date of the spring semester.</p>';
  echo '<p class="description" id="tagline-description"><strong>Example: May 12, 2016</strong></p>';
 }
	
function lccc_spring_active_category_fields_html() {
		$lc_categories = get_categories( array(
			'taxonomy' => 'event_categories',
			'orderby' => 'name',
			'order' => 'ASC',
		) );
	
	$selectedCategory = get_option('lccc_spring_active_category', '' );

 echo '<select name="lccc_spring_active_category" id="lccc_spring_active_category">';
	echo '<option value="none" id="none">No calendar</option>';
	foreach($lc_categories as $category){
			echo '<option value="' . $category->slug .'" id="' . $category->slug . '"', $selectedCategory == $category->slug ? 'selected="selected"' : '', '>', $category->name, '</option>';
			}
		echo '</select>';
	
}
function lccc_summer_semster_fields_html() {
?>
<script>
jQuery(document).ready(function(){
jQuery('#lccc_summer_semester_startdate').datepicker({
	dateFormat: "mm/dd/yy"
});
});
</script>
	<?php
  $value = get_option( 'lccc_summer_semester_startdate', '' );
  echo '<input type="text" id="lccc_summer_semester_startdate" name="lccc_summer_semester_startdate" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the start date of the summer semester.</p>';
  echo '<p class="description" id="tagline-description"><strong>Example: May 23, 2016</strong></p>';
 }
	function lccc_summer_semster_end_fields_html() {
?>
<script>
jQuery(document).ready(function(){
jQuery('#lccc_summer_semester_enddate').datepicker({
	dateFormat: "mm/dd/yy"
});
});
</script>
	<?php
  $value = get_option( 'lccc_summer_semester_enddate', '' );
  echo '<input type="text" id="lccc_summer_semester_enddate" name="lccc_summer_semester_enddate" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the end date of the summer semester.</p>';
  echo '<p class="description" id="tagline-description"><strong>Example: July 31, 2016</strong></p>';
 }
	
	function lccc_summer_active_category_fields_html() {
		$lc_categories = get_categories( array(
			'taxonomy' => 'event_categories',
			'orderby' => 'name',
			'order' => 'ASC',
		) );
	
	$selectedCategory = get_option('lccc_summer_active_category', '' );

 echo '<select name="lccc_summer_active_category" id="lccc_summer_active_category">';
	echo '<option value="none" id="none">No calendar</option>';
	foreach($lc_categories as $category){
			echo '<option value="' . $category->slug .'" id="' . $category->slug . '"', $selectedCategory == $category->slug ? 'selected="selected"' : '', '>', $category->name, '</option>';
			}
		echo '</select>';
	
}
	
	function lccc_fall_semster_fields_html() {
?>
<script>
jQuery(document).ready(function(){
jQuery('#lccc_fall_semester_startdate').datepicker({
	dateFormat: "mm/dd/yy"
});
});
</script>
	<?php
  $value = get_option( 'lccc_fall_semester_startdate', '' );
  echo '<input type="text" id="lccc_fall_semester_startdate" name="lccc_fall_semester_startdate" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the start date of the fall semester.</p>';
  echo '<p class="description" id="tagline-description"><strong>Example: August 22, 2016</strong></p>';
 }
		function lccc_fall_semster_end_fields_html() {
?>
<script>
jQuery(document).ready(function(){
jQuery('#lccc_fall_semester_enddate').datepicker({
	dateFormat: "mm/dd/yy"
});
});
</script>
	<?php
  $value = get_option( 'lccc_fall_semester_enddate', '' );
  echo '<input type="text" id="lccc_fall_semester_enddate" name="lccc_fall_semester_enddate" value="' . $value . '" size="75" />';
  echo '<p class="description" id="tagline-description">Enter the end date of the fall semester.</p>';
  echo '<p class="description" id="tagline-description"><strong>Example: December 11, 2016</strong></p>';
 }

	function lccc_fall_active_category_fields_html() {
		$lc_categories = get_categories( array(
			'taxonomy' => 'event_categories',
			'orderby' => 'name',
			'order' => 'ASC',
		) );
	
	$selectedCategory = get_option('lccc_fall_active_category', '' );

 echo '<select name="lccc_fall_active_category" id="lccc_fall_active_category">';
	echo '<option value="none" id="none">No calendar</option>';
	foreach($lc_categories as $category){
			echo '<option value="' . $category->slug .'" id="' . $category->slug . '"', $selectedCategory == $category->slug ? 'selected="selected"' : '', '>', $category->name, '</option>';
			}
	echo '</select>';
	
}
	
}
?>