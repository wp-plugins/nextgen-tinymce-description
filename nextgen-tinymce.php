<?php
/*
Plugin Name: NextGen TinyMCE Picture Description
Plugin URI: http://marbu.org/marbu/wordpress-plugin-tinymce-in-nextgen/
Description: add TinyCME to NextGEN gallery picture description
Author: Marco Buttarini
Version: 1.1
Author URI: http://marbu.og
*/


add_action("admin_head","load_custom_wp_tiny_mce");
function load_custom_wp_tiny_mce() {
if(($_GET['page'] == 'nggallery-manage-gallery')){

}else return;
?>
<script>
jQuery(document).ready(function(){
	var texts = document.getElementsByTagName("textarea");
	var elements=[];
	for(var i=0;i<texts.length;i++){
		if(/description\[[0-9]+\]/.test(texts[i].name)){
			var elem_id = texts[i].name.replace("[", "_").replace("]","_");
			texts[i].id = elem_id;
			elements.push(elem_id);
			
		}
	}
	tinyMCEPreInit.mceInit.elements = elements.join(',');
	tinyMCE.init(tinyMCEPreInit.mceInit);

})
</script>
<?php
	if (function_exists('wp_tiny_mce')) {
		add_filter('teeny_mce_before_init', 'init_tinymce');
		function init_tinymce($a){
			
			$a["theme"] = "advanced";
			$a["skin"] = "wp_theme";
			$a["height"] = "200";
			$a["width"] = "100%";
			//$a["onpageload"] = "";
			$a["mode"] = "exact";
			$a["elements"] = "";
			$a["editor_selector"] = "theEditor";
			$a["plugins"] = "fullscreen, inlinepopups, spellchecker";
						
			$a['theme_advanced_buttons1'] = "bold, italic, underline, blockquote, separator, strikethrough, link, unlink";
			$a['theme_advanced_buttons2'] = "bullist, numlist,justifyleft, justifycenter, justifyright, undo, redo, fullscreen";

			return $a;
		}
		wp_tiny_mce(true);
	}
}
?>
