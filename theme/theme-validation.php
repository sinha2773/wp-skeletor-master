<?php
// validation

add_action('wp_print_scripts','my_publish_admin_hook');
function my_publish_admin_hook(){
if (is_admin()){
		
        ?>
		<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/libs/jquery-2.1.1.min.js?ver=1.11.3'></script>
        <script language="javascript" type="text/javascript">
            jQuery(document).ready(function() {
			
				//	checking the address field on front-end
				function isValid(str) {
					var iChars = "()',%#";
					for (var i = 0; i < str.length; i++) {
					   if (iChars.indexOf(str.charAt(i)) != -1) {
						   alert ("Address has special characters ()',%# \nThese are not allowed\n");
						   return false;
					   }
					}
					return true;
				}
					
                jQuery('#post').submit(function() {
					
					var address = $('#acf-field-address').val();					
					
					var allowToServer = isValid(address);

																
                    
                    var data = {
                        action: 'my_pre_submit_validation',
                        form_data: address
                    };
					
					if(allowToServer){
						jQuery.post(ajaxurl, data, function(response) {
							if (response=="true") {
								return true;
							}else{
								alert ("Address has special characters ()',%# \nThese are not allowed\n");                            
								return false;
							}
						});
					}else{
						return false;
					}
                    
                });
            });
        </script>
        <?php
    }
}

add_action('wp_ajax_my_pre_submit_validation', 'pre_submit_validation');
function pre_submit_validation(){
	$address = $_POST['form_data'];
	//	checking the address field on serverside
	if (preg_match ('/[()\',%#]+/', $address)){
		echo "false";
		die();
	}else{
		echo "true";
		die();
	}    
}
?>