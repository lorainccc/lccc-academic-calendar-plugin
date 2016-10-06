<?php
/**
 * Generated by the WordPress Meta Box generator
 * at http://jeremyhixon.com/tool/wordpress-meta-box-generator/
 */

function academic_event_metabox_get_meta( $value ) {
	global $post;

	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}

function academic_event_metabox_add_meta_box() {
	add_meta_box(
		'academic_event_metabox-academic-event-metabox',
		__( 'Academic Event Metabox', 'academic_event_metabox' ),
		'academic_event_metabox_html',
		'lccc_academicevent',
		'advanced',
		'high'
	);
}
add_action( 'add_meta_boxes', 'academic_event_metabox_add_meta_box' );

function academic_event_metabox_html( $post) {
	wp_nonce_field( '_academic_event_metabox_nonce', 'academic_event_metabox_nonce' ); ?>
<script>
jQuery(document).ready(function(){
jQuery('#event_start_date').datepicker({
	dateFormat: "yy-mm-dd"
});
jQuery('#event_end_date').datepicker({
	dateFormat: "yy-mm-dd"
});

});
</script>


	<p>

		<input type="checkbox" name="academic_event_metabox_display_in_event_feed" id="academic_event_metabox_display_in_event_feed" value="show" <?php echo ( academic_event_metabox_get_meta( 'academic_event_metabox_display_in_event_feed' ) === 'show' ) ? 'checked' : ''; ?>>
		<label for="academic_event_metabox_display_in_event_feed"><?php _e( 'Display In Event Feed', 'academic_event_metabox-academic-event-metabox' ); ?></label>	</p>
<h4 class="metabox-field-title">Acdemic Event Start Date:</h4>

<p>		
		<label for="event_start_date"><?php _e( 'Academic Event Start date:', 'academic_event_metabox-academic-event-metabox' ); ?></label><br>
		<input type="text" name="event_start_date" id="event_start_date" value="<?php echo academic_event_metabox_get_meta( 'event_start_date' ); ?>">
	</p>
<p>
		<label for="event_end_date"><?php _e( 'Academic Event End date:', 'academic_event_metabox-academic-event-metabox' ); ?></label><br>
		<input type="text" name="event_end_date" id="event_end_date" value="<?php echo academic_event_metabox_get_meta( 'event_end_date' ); ?>">
	</p>	


<?php
}

function academic_event_metabox_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['academic_event_metabox_nonce'] ) || ! wp_verify_nonce( $_POST['academic_event_metabox_nonce'], '_academic_event_metabox_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['academic_event_metabox_display_in_event_feed'] ) )
		update_post_meta( $post_id, 'academic_event_metabox_display_in_event_feed', esc_attr( $_POST['academic_event_metabox_display_in_event_feed'] ) );
	else
		update_post_meta( $post_id, 'academic_event_metabox_display_in_event_feed', null );
	
		if ( isset( $_POST['event_start_date'] ) )
   update_post_meta( $post_id, 'event_start_date', esc_attr( $_POST['event_start_date'] ) );
	
		if ( isset( $_POST['event_end_date'] ) )
   update_post_meta( $post_id, 'event_end_date', esc_attr( $_POST['event_end_date'] ) ); 
	
}
add_action( 'save_post', 'academic_event_metabox_save' );

/*
	Usage: academic_event_metabox_get_meta( 'academic_event_metabox_display_in_event_feed' )
*/


?>