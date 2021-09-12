<?php



/**
 * This defines a bunch of core classes and where they can be loaded from
 * Only non PSR-0 classes need to be named here, other classes will be found automatically
 */
$class_map = array(
    'XTemplate'=>'vendor/XTemplate/xtpl.php',
    'Javascript'=>'include/javascript/javascript.php',
    'ListView'=>'include/ListView/ListView.php',
    'CustomDotbView' => 'custom/include/MVC/View/DotbView.php',
    'Dotb_Smarty' => 'include/DotbSmarty/Dotb_Smarty.php',
    'HTMLPurifier_Bootstrap' => 'vendor/HTMLPurifier/HTMLPurifier.standalone.php',
    'DotbCurrency'=>'include/DotbCurrency/DotbCurrency.php',
    'DotbRelationshipFactory' => 'data/Relationships/RelationshipFactory.php',
    'DBManagerFactory' => 'include/database/DBManagerFactory.php',
    'Localization' => 'include/Localization/Localization.php',
    'TimeDate' => 'include/TimeDate.php',
    'DotbDateTime' => 'include/DotbDateTime.php',
    'DotbBean' => 'data/DotbBean.php',
    'LanguageManager' => 'include/DotbObjects/LanguageManager.php',
    'VardefManager' => 'include/DotbObjects/VardefManager.php',
    'MetaDataManager' => 'include/MetaDataManager/MetaDataManager.php',
    'TemplateText' => 'modules/DynamicFields/templates/Fields/TemplateText.php',
    'TemplateField' => 'modules/DynamicFields/templates/Fields/TemplateField.php',
    'DotbEmailAddress' => 'include/DotbEmailAddress/DotbEmailAddress.php',
    'JSON' => 'include/JSON.php',
    'LoggerManager' => 'include/DotbLogger/LoggerManager.php',
    'ACLController' => 'modules/ACL/ACLController.php',
    'ACLJSController' => 'modules/ACL/ACLJSController.php',
    'Administration' => 'modules/Administration/Administration.php',
    'OutboundEmail' => 'include/OutboundEmail/OutboundEmail.php',
    'MailerFactory' => 'modules/Mailer/MailerFactory.php',
    'LogicHook' => 'include/utils/LogicHook.php',
    'LegacyJsonServer' => 'include/utils/LegacyJsonServer.php',
    'DotbTheme' => 'include/DotbTheme/DotbTheme.php',
    'DotbThemeRegistry' => 'include/DotbTheme/DotbTheme.php',
    'DotbModule' => 'include/MVC/DotbModule.php',
    'DotbApplication' => 'include/MVC/DotbApplication.php',
    'ControllerFactory' => 'include/MVC/Controller/ControllerFactory.php',
    'ViewFactory' => 'include/MVC/View/ViewFactory.php',
    'BeanFactory' => 'data/BeanFactory.php',
    'Audit' => 'modules/Audit/Audit.php',
    'Link2' => 'data/Link2.php',
    'DotbJobQueue' => 'include/DotbQueue/DotbJobQueue.php',
    'EmbedLinkService' => 'include/EmbedLinkService.php',
    'DotbApi' => 'include/api/DotbApi.php',
    'ParseCSV' => 'vendor/parsecsv/php-parsecsv/parsecsv.lib.php'
);
