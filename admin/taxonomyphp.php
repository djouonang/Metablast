<?php

$options = get_option('category');
 $var = $options['cat'];
 $variable = $options['postag'];

 	$selected_option = $options['buddy_radio_field_0'];
	if($var == '1')
	{
			$taxonomies = get_taxonomies($args);
							array_push($taxonomies,'category');
							array_push($taxonomies,'post_tag');
		foreach($taxonomies as $tax)
		{
add_action( 'category_add_form_fields', 'tax_add_custom_form_fields' );
add_action( 'category_edit_form_fields', 'tax_edit_custom_form_fields' );
add_action('edited_category', 'tax_save_custom_form_fields');
add_action('created_category', 'tax_save_custom_form_fields');
}
}

if($variable == '2')
	{
		
add_action( 'post_tag_add_form_fields', 'tax_add_custom_form_fields' );
add_action( 'post_tag_edit_form_fields', 'tax_edit_custom_form_fields' );
add_action('edited_post_tag', 'tax_save_custom_form_fields');
add_action('created_post_tag', 'tax_save_custom_form_fields');
		
		}
 
//Add custom meta data fields for taxonomy 

function tax_add_custom_form_fields()
	{
	
		?>
		
		<div class="form-field">    
			<label for="term_meta[taxonomy_title]"><?php _e('Meta tag title', 'metablast'); ?></label>
			<input type="text" id="term_meta[taxonomy_title]" name="term_meta[taxonomy_title]" size="40" value="" />
			<p><?php _e('Title meta of the post/page.Please note that this will replace your default page or post title.(Optional)', 'metablast'); ?></p>
		</div>
		<div class="form-field">    
			<label for="term_meta[taxonomy_titlei]"><?php _e(' Meta tag description', 'metablast'); ?></label>
			<textarea cols="40" rows="5" id="term_meta[taxonomy_titlei]" name="term_meta[taxonomy_titlei]"></textarea>
			<p><?php _e('Description meta of the post/page.', 'metablast'); ?></p>
		</div>
		<div class="form-field">
			<label for="term_meta[taxonomy_keywords]"><?php _e('Meta tag keywords', 'metablast'); ?></label>
			<input type="text" id="term_meta[taxonomy_keywords]" name="term_meta[taxonomy_keywords]" size="40" value="" />
			<p><?php _e('Enter keywords relevant to the page or post', 'metablast'); ?></p>
		</div>
		
		
		

     
		
		<?php
		
		}
		
	
		
		function tax_edit_custom_form_fields($term){
			
    $term_id = $term->term_id;
    $term_meta = get_option( "category_$term_id" );   
	
	
			
			?>
			
			<tr class="form-field">
			<th valign="top" scope="row"> 
			<label for="term_meta[taxonomy_title]"><?php _e('Meta tag title', 'metablast'); ?></label>
			</th>
			<td>
			<input type="text" id="term_meta[taxonomy_title]" name="term_meta[taxonomy_title]" size="40" value="<?php if(esc_attr($term_meta['taxonomy_title']))
				{
					echo esc_attr($term_meta['taxonomy_title']);
				}
				else
				{
					echo '';
				}
				?>" />
			
			<p><?php _e('Title meta of the post/page.Please note that this will replace your default page or post title.(Optional)', 'metablast'); ?></p>
			</td>
		</tr>
		
		<tr class="form-field">
			<th valign="top" scope="row">  
			<label for="term_meta[taxonomy_titlei]"><?php _e(' Meta tag description', 'metablast'); ?></label>
			</th>
			<td>
			<textarea cols="40" rows="5" id="term_meta[taxonomy_titlei]" name="term_meta[taxonomy_titlei]"><?php if(esc_attr($term_meta['taxonomy_titlei']))
				{
					echo esc_attr($term_meta['taxonomy_titlei']);
				}
				else
				{
					echo '';
				}
				?></textarea>
			<p><?php _e('Description meta of the post/page.', 'metablast'); ?></p>
			
			</td>
		</tr>
			<tr class="form-field">
			<th valign="top" scope="row"> 
			<label for="term_meta[taxonomy_keywords]"><?php _e('Meta tag keywords', 'metablast'); ?></label>
			</th>
			<td>
			<input type="text" id="term_meta[taxonomy_keywords]" name="term_meta[taxonomy_keywords]" size="40" value="<?php if(esc_attr($term_meta['taxonomy_keywords']))
				{
					echo esc_attr($term_meta['taxonomy_keywords']);
				}
				else
				{
					echo '';
				}
				?>" />
			<p><?php _e('Enter keywords relevant to the page or post', 'metablast'); ?></p>
		</td>
		</tr>
		
<tr style="background: #445f7b; padding: 1rem 2rem; border-radius: 2px;">
<a href="https://www.silentblast.com/search-engine-optimization-toronto/" style=" text-decoration:none; display: flex; align-items: center;">
<img src="https://www.silentblast.com/wp-content/uploads/2016/01/sb-logo.png">
<span style="margin: 0 1rem; flex-grow: 1; text-align: center; font-size: 1.5rem; color: #fff">Rank High on Search Engines</span>
<button class="Button u-bsa-outline" style="flex-shrink: 0; background-color: transparent; border: 2px solid #ec5645; color: #ec5645; transition: opacity 0.7s;">Learn More</button>
</a>
</tr>
			
				<?php
			
		}
		
		//remember to do same for post_tag
		
		// Hook to category and post tag to add custom form fields(meta data) 
		


function tax_save_custom_form_fields($term_id){
	
	if(isset($_POST['term_meta']))
		{
			
    $tax_id = $term_id;
	$term_meta = get_option( "category_$tax_id" );
	$term_meta = get_option( "post_tag_$tax_id" );
	$term_keys = array_keys($_POST['term_meta']);
            foreach ($term_keys as $key){
            if (isset($_POST['term_meta'][$key])){
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$term_id", $term_meta );
		update_option( "post_tag_$term_id", $term_meta );
    }
		}
	
	
	// function to output meta data or custom field values in head of taxonomies ; category and post tag.
	
	add_action( 'wp_head', 'metablast_meta_tax_output', 0 );
	 
	function  metablast_meta_tax_output($term_id){
		
		global $wp_query;
		
					
		if(!$sep)
		{
			$sep = '|';
		}
		
		if(is_category())
		{
			$current_id = get_cat_id(single_cat_title('',false));
			$term_meta = get_option( "category_$current_id" );
			
			
			
			if(esc_attr($term_meta['taxonomy_titlei']) != '')
			{
				echo '<meta name="description" content="'.esc_attr($term_meta['taxonomy_titlei']).'" />'."\r\n";
			}
			if(esc_attr($term_meta['taxonomy_keywords']) != '')
			{
				echo '<meta name="keywords" content="'.esc_attr($term_meta['taxonomy_keywords']).'" />'."\r\n";
			}
						
			
		}
		
		if(is_tag())
		{
			$current_id = get_query_var('tag_id');
			$term_meta = get_option( "post_tag_$current_id" );
			
			
			if(esc_attr($term_meta['taxonomy_titlei']) != '')
			{
				echo '<meta name="description" content="'.esc_attr($term_meta['taxonomy_titlei']).'" />'."\r\n";
			}
			if(esc_attr($term_meta['taxonomy_keywords']) != '')
			{
				echo '<meta name="keywords" content="'.esc_attr($term_meta['taxonomy_keywords']).'" />'."\r\n";
			}
			
		}
		
		
	}
	
	
// function to change and output title of category or  post tag taxonomy. New hook has been implemented as of wp 4.4
	
	
add_filter( 'document_title_parts', 'metablast_tax_title_output', 10, 2);
	
	function metablast_tax_title_output($title){
		
		global $wp_query;
		
		
		if(is_category())
		{
			
				$current_id = get_cat_id(single_cat_title('',false));
				$term_meta = get_option( "category_$current_id" );
				if(esc_attr($term_meta['taxonomy_title']) != '')
				{
					$title['title'] = esc_attr($term_meta['taxonomy_title']).' '.$sep.' ';;
				}
			
		}
		if(is_tag())
		{
			
				$current_id = get_query_var('tag_id');
				$term_meta = get_option( "post_tag_$current_id" );
				
				if(esc_attr($term_meta['taxonomy_title']) != '')
				{
					$title['title'] = esc_attr($term_meta['taxonomy_title']).' '.$sep.' ';;
				}
			
		}

		return $title;
		
	}
	


