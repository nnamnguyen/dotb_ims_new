<?php


/**
 * Retrieves the requested js language file, building it if it doesn't exist.
 */

use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

function getJSLanguage()
{


    global $app_list_strings;

    if (empty($_REQUEST['lang'])) {
        echo "No language specified";

        return;
    }

    $lang = clean_path(InputValidation::getService()->getValidInputRequest('lang', 'Assert\Language'));
    $languages = get_languages();

    if (!preg_match("/^\w\w_\w\w$/", $lang) || !isset($languages[$lang])) {
        if (!preg_match("/^\w\w_\w\w$/", $lang)) {
            echo "did not match regex<br/>";
        } else {
            echo  "$lang was not in list . <pre>" . print_r($languages, true) . "</pre>";
        }
        echo "Invalid language specified";

        return;
    }

    $reqModule = InputValidation::getService()->getValidInputRequest('module', 'Assert\Mvc\ModuleName');
    if (empty($reqModule) || $reqModule === 'app_strings') {
        $file = dotb_cached('jsLanguage/') . $lang . '.js';
        if (!dotb_is_file($file)) {
            jsLanguage::createAppStringsCache($lang);
        }
    } else {
        $module = clean_path($reqModule);
        $fullModuleList = array_merge($GLOBALS['moduleList'], $GLOBALS['modInvisList']);
        if (!isset($app_list_strings['moduleList'][$module]) && !in_array($module, $fullModuleList)) {
            echo "Invalid module specified";

            return;
        }
        $file = dotb_cached('jsLanguage/') . $module . "/" . $lang . '.js';
        if (!dotb_is_file($file)) {
            jsLanguage::createModuleStringsCache($module, $lang);
        }
    }

    //Setup cache headers
    header("Content-Type: application/javascript");
    header("Cache-Control: max-age=31556940, private");
    header("Pragma: ");
    header("Expires: " . gmdate('D, d M Y H:i:s \G\M\T', time() + 31556940));

    readfile($file);
}

getJSLanguage();
