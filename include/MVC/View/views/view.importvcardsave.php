<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

class ViewImportvcardsave extends DotbView
{
    public $type = 'save';

    /**
     * @see DotbView::display()
     */
    public function display()
    {
        $redirect = "index.php?action=Importvcard&module={$_REQUEST['module']}";

        if (!empty($_FILES['vcard'])
            && is_uploaded_file($_FILES['vcard']['tmp_name'])
            && $_FILES['vcard']['error'] == 0
        ) {
            $vcard = new vCard();
            try {
                $record = $vcard->importVCard($_FILES['vcard']['tmp_name'], $_REQUEST['module']);
            } catch (Exception $e) {
                DotbApplication::redirect($redirect . '&error=vcardErrorRequired');
            }

            DotbApplication::redirect("index.php?action=DetailView&module={$_REQUEST['module']}&record=$record");
        } else {
            switch ($_FILES['vcard']['error']) {
                case UPLOAD_ERR_FORM_SIZE:
                    $redirect .= "&error=vcardErrorFilesize";
                    break;
                default:
                    $redirect .= "&error=vcardErrorDefault";
                    $GLOBALS['log']->info('Upload error code: ' . $_FILES['vcard']['error'] . '.');
                    break;
            }

            DotbApplication::redirect($redirect);
        }
    }
}
