<?php
/*
Plugin Name: NextGen TinyMCE Picture Description
Plugin URI: http://marbu.org/marbu/wordpress-plugin-tinymce-in-nextgen/
Description: add TinyCME to NextGEN gallery picture description
Author: Marco Buttarini & Giorgio Martello
Version: 1.2
Author URI: http://marbu.org
*/

if( !empty($_SERVER['SCRIPT_FILENAME']) && __FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('direct access not alowed '); }

if( $_GET['page'] == 'nggallery-manage-gallery' ){
    
    add_action('admin_footer', 'load_nextgen_tinymce');
    
    function load_nextgen_tinymce(){
    ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                
                var elements=[];
                
                jQuery('textarea').filter(function() {
                    return jQuery(this).attr('name').match(/description\[[0-9]{1,}\]+/);
                }).each(function(k){
                    
                    var elem_id = 'description-'+jQuery(this).parent().parent().attr('id');
                    jQuery(this).attr('id', elem_id );
                    elements.push(elem_id);
                    
                });
                
                tinyMCE.init({
                    mode : "exact",
                    elements: elements.join(','),
                    width:"100%",
                    height:"200",
                    theme:"advanced",
                    skin:"default",
                    language: tinyMCE.settings.language, // get setting from WP tinymce
                    plugins : "fullscreen,inlinepopups,spellchecker", 
                    theme_advanced_buttons1 : "bold,italic,underline,blockquote,separator,strikethrough,link,unlink",
                    theme_advanced_buttons2 : "bullist,numlist,justifyleft,justifycenter,justifyright,undo,redo,fullscreen",
                    theme_advanced_buttons3 : "",      
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_resizing : true
                    
                });
                

            });
        </script>
    <?php
    }
    
}
