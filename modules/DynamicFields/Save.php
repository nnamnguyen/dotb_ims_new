<?php



use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

$request = InputValidation::getService();
$module = $request->getValidInputRequest('module_name', 'Assert\Mvc\ModuleName');
$custom_fields = new DynamicField($module);
if(!empty($module)){
    $mod = BeanFactory::newBean($module);
	$custom_fields->setup($mod);
}else{
	echo "\n".$mod_strings['ERR_NO_MODULE_INCLUDED'];
}

$fieldLabel = $request->getValidInputRequest('field_label');
$fieldType = $request->getValidInputRequest('field_type');
$fieldCount = $request->getValidInputRequest('field_count');
$fileType = $request->getValidInputRequest('file_type');

$name = $fieldLabel;
$options = '';
if($fieldType == 'enum'){
	$options = $request->getValidInputRequest('options');
}
$default_value = '';

$custom_fields->addField($name,$name, $fieldType,'255','optional', $default_value, $options, '', '' );
$html = $custom_fields->getFieldHTML($name, $fileType);

set_register_value('dyn_layout', 'field_counter', $fieldCount);
$label = $custom_fields->getFieldLabelHTML($name, $fieldType);
require_once('modules/DynamicLayout/AddField.php');
$af = new AddField();
$af->add_field($name, $html,$label, 'window.opener.');
echo $af->get_script('window.opener.');
echo "\n<script>window.close();</script>";

?>
