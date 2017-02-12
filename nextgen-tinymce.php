<?php
/*
Plugin Name: NextGen TinyMCE Picture Description
Plugin URI: http://marbu.org/wordpress-plugin-tinymce-in-nextgen/
Description: add TinyCME to NextGEN gallery picture description
Author: Marco Buttarini & Giorgio Martello & Andrea Brugnolo & Berend Dekens
Version: 1.5
Author URI: http://marbu.org
*/

if( !empty($_SERVER['SCRIPT_FILENAME']) && __FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('direct access not alowed '); }

if( is_admin() && isset($_GET['page']) && $_GET['page'] == 'nggallery-manage-gallery' ){

    add_filter('admin_head','load_tiny_mce_editor');
    add_action('admin_footer', 'load_nextgen_tinymce');
    
    function load_nextgen_tinymce(){
    ?>
        <script type="text/javascript">
          jQuery(document).ready(function(){
            var newnextgen = false;
            var elements=[];

            jQuery('textarea').filter(function() {
              if(jQuery(this).attr('name').match(/\[[0-9]{1,}\]+\[description\]/)) { 	
                newnextgen = true;
                return jQuery(this).attr('name').match(/\[[0-9]{1,}\]+\[description\]/)
              } else {
                newnextgen = false;
                return jQuery(this).attr('name').match(/description\[[0-9]{1,}\]+/)
              }	
            }).each(function(k){
              if(newnextgen = false) {
                var elem_id = 'description-'+jQuery(this).parent().parent().attr('id');
              } else {
                var elem_id = 'description-'+jQuery(this).parent().parent().find('.column-2').text();						
              }	

              jQuery(this).attr('class', 'nextgen_description');
            });

            tinymce.init({
              selector: 'textarea.nextgen_description',
              width:"100%",
              height:"200",
              browser_spellcheck: true,
              toolbar:'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | nonbreaking | link unlink',
              menubar: false
            });
          });
        </script>
    <?php
    }

    /**
     * Load TinyMCE, without using wp_editor() as we don't want to actualy print the editor here
     * 
     * http://wordpress.stackexchange.com/a/219800
     */
    function load_tiny_mce_editor() {
      wp_enqueue_script( 'tinymce_js', includes_url( 'js/tinymce/' ) . 'wp-tinymce.php', array( 'jquery' ), false, true );
    }
    
}
