<?php


require_once 'modules/UpgradeWizard/LumiaUpdate/LumiaAbstractMetaDataUpgrader.php';

class LumiaMenuMetaDataUpgrader extends LumiaAbstractMetaDataUpgrader
{
    protected $isExt = false;

    /**
     * name of the menu var
     * @var string
     */
    protected $menuName;

    public function setLegacyViewdefs()
    {
        global $current_language;

        $GLOBALS['mod_strings'] = return_module_language($current_language, $this->module);
        DotbACL::setACL($this->module, array(new LumiaMenuMetaDataUpgraderACL()));
        $module_menu = null;
        include $this->fullpath;

        if($this->basename === 'globalControlLinks'){
            if(isset($global_control_links)){
                $module_menu = $global_control_links;
                $this->deleteOld = false;
            }
        }

        DotbACL::resetACLs($this->module);
        $this->legacyViewdefs = $module_menu;
    }

    public function convertLegacyViewDefsToLumia()
    {
        if(empty($this->legacyViewdefs)) {
            return true;
        }
        // Upgrading globalcontrollinks to profileaction metadata
        if($this->basename === 'globalControlLinks'){
            $newMenu = $this->metaDataConverter->fromLegacyProfileActions($this->legacyViewdefs);
        }else{
            $this->isExt = (substr($this->fullpath, 0, 16) == 'custom/Extension');
            $newMenu = $this->metaDataConverter->fromLegacyMenu($this->module, $this->legacyViewdefs, $this->isExt);
        }
        if(empty($newMenu['data'])) {
            return true;
        }
        $this->lumiaViewdefs = $newMenu['data'];
        $this->menuName = $newMenu['name'];
    }

    public function handleSave()
    {
        if(empty($this->lumiaViewdefs)) {
            return true;
        }
        if($this->isExt) {
            $newExtLocation = "custom/Extension/modules/{$this->module}/Ext/clients/base/menus/header/";
            if (!is_dir($newExtLocation)) {
                dotb_mkdir($newExtLocation, null, true);
            }

            $content = "<?php \n";
            foreach($this->lumiaViewdefs as $menuItem) {
                $content .= "\${$this->menuName}[] = ".var_export($menuItem, true).";\n";
            }
            return dotb_file_put_contents($newExtLocation . "/" . $this->filename, $content);
        } elseif($this->basename === 'globalControlLinks'){
            return $this->handleSaveArray($this->menuName, "custom/clients/base/views/profileactions/profileactions.php");
        } else {
            return $this->handleSaveArray($this->menuName, "custom/modules/{$this->module}/clients/base/menus/header/header.php");
        }
    }
}

/**
 * This is a mock ACL so that Menu files that have ACLs won't do weird things
 */
class LumiaMenuMetaDataUpgraderACL extends DotbACLStrategy
{
    public function checkAccess($module, $action, $context)
    {
        return true;
    }
}
