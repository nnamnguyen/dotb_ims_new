<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/



class Fixed {

	function is_readonly() {
		return '';
	}
	
	function get_edit_html() {
		return "<input id='pricing_factor_Fixed' type='hidden' value='1'>";
	}
	
	function get_detail_html($formula, $factor) {
		global $current_language, $app_list_strings;
		$template_mod_strings = return_module_language($current_language, "ProductTemplates");
		return $app_list_strings['pricing_formula_dom'][$formula];
	}
	
	function get_formula_js() {
		return "form.discount_price.readOnly=false;\n";  
	}

	function calculate_price($cost_price=1, $list_price=1, $discount_price=1, $factor=1) {
		return $discount_price;
	}
}
?>
