<?php


    class ViewMain extends DotbView
    {
        public function __construct()
        {
            $this->options['show_footer'] = false;
            parent::__construct();
        }

        /**
         * @see DotbView::_getModuleTitleParams()
         */
        protected function _getModuleTitleParams($browserTitle = false)
        {
            global $mod_strings;

            return array(
                translate('LBL_MODULE_NAME','Administration'),
                ModuleBuilderController::getModuleTitle(),
            );
        }

        function display()
        {
            global $app_strings, $current_user, $mod_strings, $theme;

            $smarty = new Dotb_Smarty();
            $type = $this->request->getValidInputRequest('type', null , 'main');
            $mbt = false;
            $admin = false;
            $mb = strtolower($type);
            $smarty->assign('TYPE', JSON::encode($type));
            $smarty->assign('app_strings', $app_strings);
            $smarty->assign('mod', $mod_strings);
            //Replaced by javascript function "setMode"
            switch($type){
                case 'studio':
                    if ($current_user->id != '1') die('Repair is not defined for you!');
                    //$smarty->assign('ONLOAD','ModuleBuilder.getContent("module=ModuleBuilder&action=wizard")');
                    $mbt = new StudioTree();
                    break;
                case 'mb':
                if ($current_user->id != '1') die('Repair is not defined for you!');
                    //$smarty->assign('ONLOAD','ModuleBuilder.getContent("module=ModuleBuilder&action=package&package=")');
                    $mbt = new MBPackageTree();
                    break;

                case 'dotbportal':
                if ($current_user->id != '1') die('Repair is not defined for you!');
                    $mbt = new DotbPortalTree();
                    break;
                case 'dropdowns':
                    // $admin = is_admin($current_user);
                    $mbt = new DropDownTree();
                    break;
                default:
                    //$smarty->assign('ONLOAD','ModuleBuilder.getContent("module=ModuleBuilder&action=home")');
                    $mbt = new MainTree();
            }
            $smarty->assign('TEST_STUDIO', displayStudioForCurrentUser());
            $smarty->assign('ADMIN', is_admin($current_user));
            $smarty->display('modules/ModuleBuilder/tpls/includes.tpl');
            if($mbt)
            {
                $smarty->assign('TREE',$mbt->fetch());
                $smarty->assign('TREElabel', $mbt->getName());
            }
            $userPref = $current_user->getPreference('mb_assist', 'Assistant');
            if(!$userPref) $userPref="na";
            $smarty->assign('userPref',$userPref);

            ///////////////////////////////////
            $tiny = new DotbTinyMCE();
            $tiny->defaultConfig['width']=300;
            $tiny->defaultConfig['height']=300;
            $tiny->buttonConfig = "code,separator,bold,italic,underline,strikethrough,separator,justifyleft,justifycenter,justifyright,
            justifyfull,separator,forecolor,backcolor,
            ";
            $tiny->buttonConfig2 = "pastetext,pasteword,fontselect,fontsizeselect,";
            $tiny->buttonConfig3 = "";
            $ed = $tiny->getInstance();
            $smarty->assign("tiny", $ed);

            $smarty->display('modules/ModuleBuilder/tpls/index.tpl');

        }
    }

