<?php

/*-------------------------------------------------------------------------------*/
/*  This page contains all the code for the settings page form
/*-------------------------------------------------------------------------------*/

add_action( 'admin_menu', 'metablast_add_admin_menu' );


// Add plugin menu to backend

function metablast_add_admin_menu(  ) { 


$page = add_menu_page( 'Metablast Settings', 'Metablast Settings', 'manage_options', 'metablast__setting', 'metablast' );

   //load style sheet to particular admin page.......Metablast settings page
 
  add_action(   'load-' . $page, 'metablast_script' );


	}

/*-------------------------------------------------------------------------------*/
/*   Backend Register JS & CSS
/*-------------------------------------------------------------------------------*/
function metablast_script() {
	

    wp_register_style( 'metastyle', plugins_url( 'style.css' , (__FILE__) ) );
	wp_register_style( 'metaform', plugins_url( 'metaform.css' , (__FILE__) ));
	wp_register_script( 'can-introjs', plugins_url( 'loginbuilder/js/jQuery.stringify.js' , (__FILE__) ), false, ECF_VERSION );


	 wp_enqueue_style( 'metastyle' );	 
	 wp_enqueue_style( 'metaform' );	 
	 wp_enqueue_script( 'can-introjs' );


}

	 
function metablast() {	 

 $options = get_option('category');
 
?>

<h1  class='hndle' style="padding:5px;  color:#ffffff;"><span>Metablast Dashboard</span></h1>

<?php if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == 'success' ) : ?>

			<div class="notice notice-success">
				<p><?php _e( 'Settings successfully updated!', 'metablast' ); ?></p>
			</div>

			<?php endif; ?>

	  <div class="center_content">
    
    
    <div class="left_content">
    
    
    <div class="sidebarmenu">
            
                <a class="menuitem submenuheader"  target="_blank" href="https://www.silentblast.com/search-engine-optimization-toronto/">SEO Services</a>
                <a class="menuitem submenuheader" target="_blank"  href="https://www.silentblast.com/content-management/" >Content Management</a>
                <a class="menuitem submenuheader" target="_blank"  href="charlie.griefer.com/blog/2009/09/17/jquery-dynamically-adding-form-elements/">Website Design</a>
                
                <a class="menuitem" target="_blank"  href="https://www.silentblast.com/e-commerce-web-development/">E-commerce</a>
                <a class="menuitem" target="_blank"  href="https://www.silentblast.com/custom-web-development/">Custom Web Development</a>
                
                <a class="menuitem" target="_blank" href="https://www.silentblast.com/website-hosting-toronto/">Website Hosting</a>
                <a class="menuitem" target="_blank" href="https://www.silentblast.com/wordpress-security/">Maintenance and Security</a>
                
                    
            </div>
            
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                <h3>User help desk</h3>
               
                <p>
				
If you need support for this plugin or have any suggestions to make please <a target="_blank"  href="https://www.silentblast.com/get-in-touch/">Drop us a note</a>.
                </p>                
                </div>
                <div class="sidebar_box_bottom"></div>
				
            </div>
            
           
    
              
    </div> 
	
	<div class="right_content">            

    <h2>Metablast Powered by <a target="_blank"  href="https://www.silentblast.com">Silentblast.com</a></h2> 
	
		<form action="" method="post" id="plugin-form">
	
	<table id="rounded-corner" >
    <thead>
    	<tr>
        	<th scope="col" class="rounded-company"></th>
            <th scope="col" class="rounded">Enable meta tags for the following taxonomies</th>
            <th scope="col" class="rounded"></th>
            <th scope="col" class="rounded"></th>
            <th scope="col" class="rounded-q4"></th>
           
        </tr>
    </thead>
        <tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left"><em>Thank you for using our plugin. Your suggestions are welcome.<strong><a href="https://www.silentblast.com/get-in-touch/">Drop us a note</a></strong></em></td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
    <tbody>
    	<tr>
        	<td><input type="checkbox" name="category[cat]" id="category[cat]" value="1" <?php checked( isset( $options['cat'] ) ? intval( $options['cat'] ) : '', 1 ); ?>  /></td>
            <td>Category</td>
            <td></td>
            <td></td>
            <td></td>


        </tr>
        
    	<tr>
        	<td><input type="checkbox" name="category[postag]" id="category[postag]" value="2" <?php checked( isset( $options['postag'] ) ? intval( $options['postag'] ) : '', 2); ?>  /></td>
            <td>Post_tag</td>
            <td></td>
            <td></td>
            <td></td>


        </tr> 
        

      
        
    </tbody>
</table>
<br>
	<input type="submit"  name="submit" class="button-primary" value="<?php _e( 'Save Settings', 'metablast' ); ?>">
	 </form>
	 
	 
    </div>
	

	 <?php
}

/**
 *	Process the input, and save options
 */
add_action( 'admin_init', 'myplugin_process_settings' );

function myplugin_process_settings() {
	// Bail if query arg is not set, or not correct
	if  (isset( $_POST['submit'] )) {
			
			
	$new = isset( $_POST['category'] ) ? $_POST['category'] : array();
	$sanitized = array();
	// Bail if no inputs are posted
	if ( ! $new ) {
		return;
	}
	
		// Sanitize checkbox option
	if (isset( $new['cat'] ) || isset( $new['postag'] ) ) {
		$sanitized['cat'] = intval( $new['cat'] );
		$sanitized['postag'] = intval( $new['postag'] );
	}
	
	
	if ( empty( $sanitized ) ) {
		// Settings are empty, so delete from database
		delete_option( 'category' );
	} else {
		update_option( 'category', $sanitized );
	}
			
			// Redirect
	wp_redirect( add_query_arg( array(
		'page' => 'metablast__setting',
		'settings-updated' => 'success'
	), admin_url( 'admin.php' ) ) );
	exit;
	}

	

}
