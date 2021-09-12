<?php




/**
 * Parser for role based dropdowns. Stores dropdown filter data.
 */
class ParserRoleDropDownFilter extends ModuleBuilderParser
{
    /**
     * Saves $data to the $name dropdown for the $role name
     *
     * @param $fieldName
     * @param $role
     * @param $data
     * @return boolean
     */
    public function handleSave($fieldName = null, $role = null, $data = null)
    {
        $path = $this->getFilePath($fieldName, $role);
        $dir = dirname($path);
        if (!DotbAutoLoader::ensureDir($dir)) {
            $GLOBALS['log']->error("ParserRoleDropDownFilter :: Cannot create directory $dir");
            return false;
        }
        $result = write_array_to_file(
            "role_dropdown_filters['{$fieldName}']",
            $this->convertFormData($data),
            $path
        );
        if ($result) {
            $this->rebuildExtension($role);
            MetaDataManager::refreshSectionCache(MetaDataManager::MM_EDITDDFILTERS, array(), array(
                'role' => $role,
            ));
        }
        return $result;
    }

    /**
     * Returns a file path to the file that stores options for a given role and a dropdown name
     *
     * @param string $fieldName Dropdown field name
     * @param string $role Role ID
     * @return string
     */
    protected function getFilePath($fieldName, $role)
    {
        return 'custom/Extension/application/Ext/DropdownFilters/roles/' . $role . '/' . $fieldName . '.php';
    }

    /**
     * Converts form data to internal representation
     *
     * @param array $data Form data
     * @return array Internal representation
     */
    protected function convertFormData($data)
    {
        $converted = array();
        $blank = translate('LBL_BLANK', 'ModuleBuilder');
        foreach ($data as $key => $item) {
            if ($key === $blank) {
                $key = '';
            }

            $converted[$key] = (bool) $item;
        }

        return $converted;
    }

    protected function rebuildExtension($role)
    {
        DotbAutoLoader::requireWithCustom('ModuleInstall/ModuleInstaller.php');
        $moduleInstallerClass = DotbAutoLoader::customClass('ModuleInstaller');
        $moduleInstaller = new $moduleInstallerClass();
        $moduleInstaller->silent = true;
        $moduleInstaller->rebuild_role_dropdown_filters($role);
    }
}
