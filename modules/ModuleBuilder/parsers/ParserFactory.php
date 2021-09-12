<?php


require_once 'modules/ModuleBuilder/parsers/constants.php';

use Dotbcrm\Dotbcrm\Util\Files\FileLoader;

class ParserFactory
{
    private static $emptyModEntries = array(
        MB_DROPDOWN,
    );
    /**
     * @param $view
     * @return mixed
     * hack for portal to use its own constants
     */
    protected static function _helperConvertToViewConstant($view)
    {
        $map = array(
            'edit' => MB_PORTALEDITVIEW,
            'detail' => MB_PORTALDETAILVIEW,
            'record'=> MB_PORTALRECORDVIEW,
            'search' => MB_PORTALSEARCHVIEW,
            'list' => MB_PORTALLISTVIEW
        );

        // view variable sent to the factory has changed: remove 'view' suffix
        // in case of further change
        $view = strtolower($view);
        if (substr_compare($view,'view',-4) === 0) {
            $view = substr($view,0,-4);
        }

        return $map[$view];
    }

    /**
     * Create a new parser
     *
     * @param string $view          The view, for example EditView or ListView. For search views, use advanced_search or basic_search
     * @param string $moduleName    Module name
     * @param string $packageName   Package name. If present implies that we are being called from ModuleBuilder
     * @param string $client        The view client (e.g. portal, wireless, etc.)
     * @param array  $params        Additional parser parameters
     * @return AbstractMetaDataParser
     */
    public static function getParser(
        $view,
        $moduleName = null,
        $packageName = null,
        $subpanelName = null,
        $client = '',
        array $params = array()
    ) {
        $GLOBALS [ 'log' ]->info ( "ParserFactory->getParser($view,$moduleName,$packageName,$subpanelName,$client )" ) ;
        $sm = null;
        $lView = strtolower ( $view );

        if (!in_array($lView, self::$emptyModEntries) && (empty($packageName) || ($packageName == 'studio'))) {
            $packageName = null ;
            //For studio modules, check for view parser overrides
            $parser = self::checkForStudioParserOverride($view, $moduleName, $packageName);
            if ($parser) return $parser;
            $sm = StudioModuleFactory::getStudioModule($moduleName);
            //If we didn't find a specofic parser, see if there is a view to type mapping
            foreach ($sm->sources as $file => $def) {
                if (!empty($def['view']) && $def['view'] == $view && !empty($def['type'])) {
                    $lView = strtolower($def['type']);
                    break;
                }
            }
        }

        switch ( $lView) {
            case MB_RECORDVIEW:
                DotbAutoLoader::requireWithCustom(
                    'modules/ModuleBuilder/parsers/views/LumiaGridLayoutMetaDataParser.php'
                );
                $parserClass = DotbAutoLoader::customClass('LumiaGridLayoutMetaDataParser');
                return new $parserClass($view, $moduleName, $packageName, 'base', $params);
            case MB_EDITVIEW :
            case MB_DETAILVIEW :
            case MB_QUICKCREATE :
                DotbAutoLoader::requireWithCustom('modules/ModuleBuilder/parsers/views/GridLayoutMetaDataParser.php');
                $parserClass = DotbAutoLoader::customClass('GridLayoutMetaDataParser');
                return new $parserClass($view, $moduleName, $packageName);
            case MB_WIRELESSEDITVIEW :
            case MB_WIRELESSDETAILVIEW :
            case MB_PORTALRECORDVIEW:
            case MB_PORTALDETAILVIEW:
            case MB_PORTALEDITVIEW:
                if (empty($client)) {
                    $client = MB_WIRELESS;
                    if ($lView == MB_PORTALRECORDVIEW || $lView == MB_PORTALDETAILVIEW || $lView == MB_PORTALEDITVIEW) {
                        $client = MB_PORTAL;
                }
                }
                DotbAutoLoader::requireWithCustom(
                    'modules/ModuleBuilder/parsers/views/LumiaGridLayoutMetaDataParser.php'
                );
                $parserClass = DotbAutoLoader::customClass('LumiaGridLayoutMetaDataParser');
                return new $parserClass($view, $moduleName, $packageName, $client, $params);
            case MB_WIRELESSLISTVIEW:
                // Handle client settings if we can
                if (empty($client)) {
                    $client = MB_WIRELESS;
                }
                DotbAutoLoader::requireWithCustom(
                    'modules/ModuleBuilder/parsers/views/LumiaListLayoutMetaDataParser.php'
                );
                $parserClass = DotbAutoLoader::customClass('LumiaListLayoutMetaDataParser');
                return new $parserClass($view, $moduleName, $packageName, $client);
            case MB_PORTALLISTVIEW:
                // Handle client settings if we can
                if (empty($client)) {
                    $client = MB_PORTAL;
                }
                DotbAutoLoader::requireWithCustom(
                    'modules/ModuleBuilder/parsers/views/LumiaPortalListLayoutMetaDataParser.php'
                );
                $parserClass = DotbAutoLoader::customClass('LumiaPortalListLayoutMetaDataParser');
                return new $parserClass($view, $moduleName, $packageName, $client);
            case MB_BASICSEARCH :
            case MB_ADVANCEDSEARCH :
            case MB_WIRELESSBASICSEARCH :
            case MB_WIRELESSADVANCEDSEARCH :
                // Make sure we have the right client
                if ($lView == MB_WIRELESSBASICSEARCH || $lView == MB_WIRELESSADVANCEDSEARCH) {
                    $client = MB_WIRELESS;
                }
                // When it comes to search, mobile is like BWC
                if (isModuleBWC($moduleName) || $client == MB_WIRELESS) {
                    DotbAutoLoader::requireWithCustom(
                        'modules/ModuleBuilder/parsers/views/SearchViewMetaDataParser.php'
                    );
                    $parserClass = DotbAutoLoader::customClass('SearchViewMetaDataParser');
                    return new $parserClass($view, $moduleName, $packageName, $client) ;
                }

                DotbAutoLoader::requireWithCustom(
                    'modules/ModuleBuilder/parsers/views/LumiaFilterLayoutMetaDataParser.php'
                );
                $parserClass = DotbAutoLoader::customClass('LumiaFilterLayoutMetaDataParser');
                $client = empty($client) ? 'base' : $client;
                return new $parserClass($moduleName, $packageName, $client);

            case MB_LISTVIEW:
            case MB_LUMIAQUOTEDATAGROUPLIST:
            case MB_QUOTEDATAGRANDTOTALHEADER:
            case MB_QUOTEDATAGRANDTOTALFOOTER:
                if ($subpanelName == null) {
                    if (isModuleBWC($moduleName)) {
                        DotbAutoLoader::requireWithCustom(
                            'modules/ModuleBuilder/parsers/views/ListLayoutMetaDataParser.php'
                        );
                        $parserClass = DotbAutoLoader::customClass('ListLayoutMetaDataParser');
                        return new $parserClass(MB_LISTVIEW, $moduleName, $packageName);
                    } else {
                        DotbAutoLoader::requireWithCustom(
                            'modules/ModuleBuilder/parsers/views/LumiaListLayoutMetaDataParser.php'
                        );
                        $parserClass = DotbAutoLoader::customClass('LumiaListLayoutMetaDataParser');
                        $listViewName = MB_LUMIALISTVIEW;
                        if ($lView === MB_LUMIAQUOTEDATAGROUPLIST ||
                            $lView === MB_QUOTEDATAGRANDTOTALHEADER ||
                            $lView === MB_QUOTEDATAGRANDTOTALFOOTER) {
                            $listViewName = $lView;
                        }

                        return new $parserClass($listViewName, $moduleName, $packageName, 'base');
                    }
                } else {
                    if (isModuleBWC($moduleName)) {
                        DotbAutoLoader::requireWithCustom(
                            'modules/ModuleBuilder/parsers/views/SubpanelMetaDataParser.php'
                        );
                        $parserClass = DotbAutoLoader::customClass('SubpanelMetaDataParser');
                        return new $parserClass($subpanelName, $moduleName, $packageName);
                    } else {
                        // $client can be empty for all other Parsers, however LumiaSubpanelLayout needs it set, therefore if its blank its base
                        $client = empty($client) ? 'base' : $client;
                        DotbAutoLoader::requireWithCustom(
                            'modules/ModuleBuilder/parsers/views/LumiaSubpanelLayoutMetaDataParser.php'
                        );
                        $parserClass = DotbAutoLoader::customClass('LumiaSubpanelLayoutMetaDataParser');
                        return new $parserClass($subpanelName, $moduleName, $packageName, $client);
                    }
                }
                // no break
            case MB_DASHLET :
            case MB_DASHLETSEARCH :
                DotbAutoLoader::requireWithCustom('modules/ModuleBuilder/parsers/views/DashletMetaDataParser.php');
                $parserClass = DotbAutoLoader::customClass('DashletMetaDataParser');
                return new $parserClass($view, $moduleName, $packageName);
            case MB_LUMIAPOPUPVIEW:
            case MB_LUMIADUPECHECKVIEW:
                DotbAutoLoader::requireWithCustom(
                    'modules/ModuleBuilder/parsers/views/LumiaListLayoutMetaDataParser.php'
                );
                $parserClass = DotbAutoLoader::customClass('LumiaListLayoutMetaDataParser');
                return new $parserClass($view, $moduleName, $packageName, 'base');
            case MB_POPUPLIST :
            case MB_POPUPSEARCH :
                DotbAutoLoader::requireWithCustom('modules/ModuleBuilder/parsers/views/PopupMetaDataParser.php');
                $parserClass = DotbAutoLoader::customClass('PopupMetaDataParser');
                $parser = new $parserClass($view, $moduleName, $packageName);
                // The popup parser needs the client and needs it to be set to
                // something in order to validate fields
                $parser->client = empty($client) ? 'base' : $client;
                return $parser;
            case MB_DROPDOWN:
                DotbAutoLoader::requireWithCustom('modules/ModuleBuilder/parsers/parser.dropdown.php');
                $parserClass = DotbAutoLoader::customClass('ParserDropDown');
                return new $parserClass();
            case MB_LABEL :
                DotbAutoLoader::requireWithCustom('modules/ModuleBuilder/parsers/parser.label.php');
                $parserClass = DotbAutoLoader::customClass('ParserLabel');
                return new $parserClass($moduleName, $packageName);
            case MB_VISIBILITY :
                DotbAutoLoader::requireWithCustom('modules/ModuleBuilder/parsers/parser.visibility.php');
                $parserClass = DotbAutoLoader::customClass('ParserVisibility');
                return new $parserClass($moduleName, $packageName);
            default :
                $parser = self::checkForParserClass($view, $moduleName, $packageName);
                if ($parser)
                    return $parser;

        }

        $GLOBALS [ 'log' ]->fatal ("ParserFactory: cannot create ModuleBuilder Parser $view" ) ;

    }

    protected static function checkForParserClass($view, $moduleName, $packageName, $nameOverride = false)
    {
        $prefix = '';
        if (!is_null ( $packageName )) {
            $prefix = empty($packageName) ? 'build' :'modify';
        }
        $fileNames = array(
            "custom/modules/$moduleName/parsers/parser." . strtolower ( $prefix . $view ) . ".php",
            "modules/$moduleName/parsers/parser." . strtolower ( $prefix . $view ) . ".php",
            "custom/modules/ModuleBuilder/parsers/parser." . strtolower ( $prefix . $view ) . ".php",
            "modules/ModuleBuilder/parsers/parser." . strtolower ( $prefix . $view ) . ".php",
        );
        foreach ($fileNames as $fileName) {
            if (file_exists ( $fileName )) {
                require_once $fileName ;
                $class = 'Parser' . $prefix . ucfirst ( $view ) ;
                if (class_exists ( $class )) {
                    $GLOBALS [ 'log' ]->debug ( 'Using ModuleBuilder Parser ' . $fileName ) ;
                    $parser = new $class ( ) ;

                    return $parser ;
                }
            }
        }

        return false;
    }

    protected static function checkForStudioParserOverride($view, $moduleName, $packageName)
    {
        $sm = StudioModuleFactory::getStudioModule($moduleName);
        foreach ($sm->sources as $file => $def) {
            if (!empty($def['view']) && $def['view'] == strtolower($view) && !empty($def['parser'])) {
                $pName = $def['parser'];
                $path = "modules/ModuleBuilder/parsers/views/{$pName}.php";
                if (file_exists("custom/$path")) {
                    require_once FileLoader::validateFilePath("custom/$path");
                } elseif (file_exists($path)) {
                    require_once FileLoader::validateFilePath($path);
                }
                if (class_exists ( $pName ))
                    return new $pName($view, $moduleName, $packageName);
                //If it wasn't defined directly, check for a generic parser name for the view
                $parser = self::checkForParserClass($view, $moduleName, $packageName);
                if ($parser)
                    return $parser;
            }
        }

        return false;
    }

}
?>
