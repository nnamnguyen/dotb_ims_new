<?php
$admin = new Administration();
$admin->retrieveSettings();
if ($_GET['download_type'] == 'quote') {
    $html = $admin->settings['orderconfig_quote_template'];
    // Get quote data
    $quote = BeanFactory::getBean($_GET['module'],$_GET['record']);
    if($quote->parent_type == 'Contact')
        $person = BeanFactory::getBean('Contacts',$quote->billing_contact_id);
    else
        $person = BeanFactory::getBean('Leads',$quote->lead_id);

    $bundle = $GLOBALS['db']->fetchArray("SELECT id, name, quantity,unit,discount_price,discount_amount,total_amount,description 
                                            FROM products WHERE quote_id ='{$quote->id}' AND deleted = 0");
    foreach ($bundle as $product){
        $product['unit'] = $GLOBALS['app_list_strings']['unit_ProductTemplates_list'][$product['unit']];
    }
    //end get data
    $filehtml = 'cache/' . time() . '.html';
    file_put_contents($filehtml, $html);

    $smarty = new Dotb_Smarty();
    $smarty->assign('subtotal',$quote->subtotal);
    $smarty->assign('deal_tot',$quote->deal_tot);
    $smarty->assign('new_sub',$quote->new_sub);
    $smarty->assign('total',$quote->total);
    $smarty->assign('paid',$quote->paid_amount);
    $smarty->assign('unpaid',$quote->unpaid_amount);
    $smarty->assign('invoice_name',$quote->name);
    $smarty->assign('contact_name',$person->name);
    $smarty->assign('contact_address',$person->primary_address_street);
    $smarty->assign('contact_phone',$person->phone_mobile);
    $smarty->assign('contact_email',$person->email1);
    $smarty->assign('bundle',$bundle);
    $smarty->assign('logo',trim($GLOBALS['dotb_config']['site_url'],'/').'/'.DotbThemeRegistry::current()->getImageURL('company_logo.png', true, true));

    $html = $smarty->fetch($filehtml);
} else {
    $html = $admin->settings['orderconfig_invoice_template'];
    // Get quote data
    $quote = BeanFactory::getBean($_GET['module'],$_GET['record']);
    if($quote->parent_type == 'Contact')
        $person = BeanFactory::getBean('Contacts',$quote->billing_contact_id);
    else
        $person = BeanFactory::getBean('Leads',$quote->lead_id);
    $bundle = $GLOBALS['db']->fetchArray("SELECT id, name, quantity,unit,discount_price,discount_amount,total_amount,description 
                                            FROM products WHERE quote_id ='{$quote->id}' AND deleted = 0");
    foreach ($bundle as $product){
        $product['unit'] = $GLOBALS['app_list_strings']['unit_ProductTemplates_list'][$product['unit']];
    }
    //end get data
    $filehtml = 'cache/' . time() . '.html';
    file_put_contents($filehtml, $html);

    $smarty = new Dotb_Smarty();
    $smarty->assign('subtotal',$quote->subtotal);
    $smarty->assign('deal_tot',$quote->deal_tot);
    $smarty->assign('new_sub',$quote->new_sub);
    $smarty->assign('total',$quote->total);
    $smarty->assign('paid',$quote->paid_amount);
    $smarty->assign('unpaid',$quote->unpaid_amount);
    $smarty->assign('invoice_name',$quote->name);
    $smarty->assign('contact_name',$person->name);
    $smarty->assign('contact_address',$person->primary_address_street);
    $smarty->assign('contact_phone',$person->phone_mobile);
    $smarty->assign('contact_email',$person->email1);
    $smarty->assign('bundle',$bundle);
    $smarty->assign('logo',trim($GLOBALS['dotb_config']['site_url'],'/').'/'.DotbThemeRegistry::current()->getImageURL('company_logo.png', true, true));

    $html = $smarty->fetch($filehtml);
}
/**
 * fetch html here
 * $_GET = module,record
 */


/**
 * end fetch html
 */
$filehtml = 'cache/' . time() . '.html';
file_put_contents($filehtml, $html);
$filepdf = 'cache/' . $_GET['name'] . '_' . $_GET['download_type'] . '.pdf';
shell_exec("xvfb-run wkhtmltopdf $filehtml $filepdf");
$filepdfname = $_GET['name'] . '_' . $_GET['download_type'] . '.pdf';
ob_clean();
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$filepdfname.'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filepdf));
readfile($filepdf);

unlink($filehtml);
unlink($filepdf);
exit;
