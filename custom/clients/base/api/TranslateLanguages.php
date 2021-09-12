<?php

class TranslateLanguages extends DotbApi
{
    function registerApiRest()
    {
        return array(
            'translate_language_get_list_modules' => array(
                'reqType' => 'GET',
                'path' => array('translate_language', 'get_list_modules'),
                'pathVars' => array(),
                'method' => 'getListModules',
            ),
            'translate_language_save_langs' => array(
                'reqType' => 'POST',
                'path' => array('translate_language', 'save_langs'),
                'pathVars' => array(),
                'method' => 'saveLangs',
            )
        );
    }

    function arrayValueToKey($arr)
    {
        $data = array();
        foreach ($arr as $a) {
            $data[$a] = $a;
        }
        return $data;
    }

    function getListModules(ServiceBase $api, array $args)
    {
        $data = array();
        $modules = $this->arrayValueToKey(scandir('modules'));
        $modules2 = $this->arrayValueToKey(scandir('custom/modules'));
        $modules = array_merge($modules2, $modules);
        $ex = array(
            'MySettings',
            'ProjectResources'
        );
        foreach ($ex as $e) unset($modules[$e]);
        ksort($modules);
        foreach ($modules as $module)
            if (is_dir('modules/' . $module))
                if (is_dir('modules/' . $module . '/language') || is_dir('custom/modules/' . $module . '/language'))
                    $data[$module] = array(
                        'module' => $module,
                        'mod_strings' => array(
                            'vn_vn' => return_module_language('vn_vn', $module),
                            'en_us' => return_module_language('en_us', $module)
                        ),
                        'mod_list_strings' => array(
                            'vn_vn' => return_mod_list_strings_language('vn_vn', $module),
                            'en_us' => return_mod_list_strings_language('en_us', $module)
                        )
                    );
        return array('success' => 1, 'data' => $data);
    }

    function saveLangs(ServiceBase $api, array $args)
    {
        foreach ($args['data'] as $module=>$moduleData) {
            $langVN = $moduleData['mod_strings']['vn_vn'];
            ksort($langVN);
            $langEN = $moduleData['mod_strings']['en_us'];
            ksort($langEN);
            $langVNList = $moduleData['mod_list_strings']['vn_vn'];
            ksort($langVNList);
            $langENList = $moduleData['mod_list_strings']['en_us'];
            ksort($langENList);

            $strVN = "<?php";
            if (count($langVNList) > 0) $strVN .= "\n\$mod_list_strings=" . var_export($langVNList, true) . ';';
            if (count($langVN) > 0) $strVN .= "\n\n\$mod_strings=" . var_export($langVN, true) . ';';
            file_put_contents('modules/' . $module . '/language/vn_vn.lang.php', $strVN);

            $strEN = "<?php";
            if (count($langENList) > 0) $strEN .= "\n\$mod_list_strings=" . var_export($langENList, true) . ';';
            if (count($langEN) > 0) $strEN .= "\n\n\$mod_strings=" . var_export($langEN, true) . ';';
            file_put_contents('modules/' . $module . '/language/en_us.lang.php', $strEN);
        }
        return array('success' => 1);
    }
}