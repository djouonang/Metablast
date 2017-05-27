<?php
/**
 * Adds a meta box to the post editing screen
 */
function metablast_options_box() {
	
/**

 * Hook to add custom meta data to posts and pages
 */
	
	add_meta_box('post_info', __('Add Meta Information','metablast'), 'metablast_add_custom_field', 'post', 'normal', 'default');
	add_meta_box('post_info', __('Add Meta Information','metablast'), 'metablast_add_custom_field', 'page', 'normal', 'default');
	
	$args = array(
			'public'   => true,
			'_builtin' => false
		);
		$custom_post_types = get_post_types($args);
		foreach($custom_post_types as $custom_post_type)
		{
			add_meta_box('post_meta_tags', __('Add Meta Information','metablast'), 'metablast_add_custom_field', $custom_post_type, 'normal', 'default');
		}
	
}
add_action( 'add_meta_boxes', 'metablast_options_box' );

/**

 * Add custom field to posts and pages
 */
function metablast_add_custom_field( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'metablast_nonce' );
	$tags = get_post_meta( $post->ID );
	?>
	
	<div class="form-field">
			<label for="meta-title"><?php _e('Meta tag title', 'metablast'); ?></label>
			<input type="text" id="meta-title" name="meta-title" size="40" value="<?php  if ( isset ( $tags['meta-title'] ) ) echo esc_attr($tags['meta-title'][0]);?>" />
			<p class="description"><?php _e('Title meta of the post/page.Please note that this will replace your default page or post title.(Optional)', 'metablast'); ?></p>
		</div>
		
		<div class="form-field">
			<label for="meta-titlei"><?php _e(' Meta tag description', 'metablast'); ?></label>
			<textarea cols="40" rows="5" id="meta-titlei" name="meta-titlei"><?php  if ( isset ( $tags['meta-titlei'] ) ) echo esc_attr($tags['meta-titlei'][0]);?></textarea>
			<p class="description"><?php _e('Description meta of the post/page.', 'metablast'); ?></p>
		</div> 
		
		
		<div class="form-field">
		<label for="meta_keywords"><?php _e('Meta tag keywords', 'metablast'); ?></label>
			<input type="text" id="meta_keywords" name="meta_keywords" size="40" value="<?php  if ( isset ( $tags['meta_keywords'] ) ) echo esc_attr($tags['meta_keywords'][0]);?>" />
			<p class="description"><?php _e('Enter keywords relevant to the page or post', 'metablast'); ?></p>
		</div>    
		
		<div style="background-color: #445f7b; width:95%; border: 10px solid #445f7b; padding: 2px;">
		
		<a href="https://www.silentblast.com/search-engine-optimization-toronto/" style= "text-decoration: none; display: flex; align-items: center;"  > 
<img src="https://www.silentblast.com/wp-content/uploads/2016/01/sb-logo.png">
<span style ="text-align: right; font-size: 1.5rem; color:#fff; margin-left: 198px  !important; "> Rank High on Search Engines</span>
</a>
		</div>
		
	

	<?php
}

/**
 * Saves the custom meta data 
 */
function metablast_save_meta_box( $post_id ) {

	// Checks save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = ( isset( $_POST[ 'metablast_nonce' ] ) && wp_verify_nonce( $_POST[ 'metablast_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

	// Exits script depending on save status
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		return;
	}

	// Checks for input and sanitizes/saves if needed
	if( isset( $_POST[ 'meta-title' ] ) ) {
		update_post_meta( $post_id, 'meta-title', sanitize_text_field( $_POST[ 'meta-title' ] ) );
		update_post_meta( $post_id, 'meta-titlei', sanitize_text_field( $_POST[ 'meta-titlei' ] ) );
		update_post_meta( $post_id, 'meta_keywords', sanitize_text_field( $_POST[ 'meta_keywords' ] ) );
	}

}
add_action( 'save_post', 'metablast_save_meta_box' );

/**

 * Outputs the content of the meta box
 */

function metablast_meta_tags_output()
	{
		global $post;	
			
		if(is_single() || is_page())
		{
		$tags = get_post_meta( $post->ID );
      if (isset($tags) && is_array($tags)) {
		  
		
        if (isset($tags['meta-titlei']) && (esc_attr($tags['meta-titlei'][0]) != ''))
        {
          echo '<meta name="description" content="'.esc_attr($tags['meta-titlei'][0]).'" />'."\r\n";
        }
        if (isset($tags['meta_keywords']) && (esc_attr($tags['meta_keywords'][0]) != ''))
        {
          echo '<meta name="keywords" content="'.esc_attr($tags['meta_keywords'][0]).'" />'."\r\n";
        }
       
      }
		}
	}
	
	add_action( 'wp_head', 'metablast_meta_tags_output', 1 );
	
//function to change and output title of post or page. New hook has been implemented as of wp 4.4

add_filter( 'document_title_parts', 'metablast_meta_title_output', 10, 2);
	
function metablast_meta_title_output($title){
		
			global $post;
		if(!$sep)
		{
			$sep = '|';
		}
		
		if(is_single() || is_page())
		{
			$tags = get_post_meta( $post->ID );
			 if (isset($tags) && is_array($tags)) {
				  if (isset($tags['meta-title']) && (esc_attr($tags['meta-title'][0]) != ''))
        {
		 $title['title']  = esc_attr($tags['meta-title'][0]);
		 
        }
		
		}
		}
		
		return $title;
		
	}
	
	
