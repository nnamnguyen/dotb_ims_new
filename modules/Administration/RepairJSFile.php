<?php


require_once 'include/DotbSmarty/plugins/function.dotb_csrf_form_token.php';
if (in_array($_REQUEST['type'], array('mini', 'replace', 'repair'), true)) {
    // don't run it without forcing admins to realize this is deprecated
    if (empty($_REQUEST['run_deprecated_feature'])) {
        switch($_REQUEST['type']) {
            case 'mini':
                $runAction = 'Rebuild Minified JS Files';
                break;
            case 'replace':
                $runAction = 'Rebuild JS Compressed Files';
                break;
            case 'repair':
                $runAction = 'Repair JS Files';
                break;
        }
        echo "<br><b>Note:</b> This feature is deprecated.<br>";
        echo "To $runAction, <b>run_deprecated_feature=1</b> must be set as a request parameter.";
        return;
    }
}

if(is_admin($current_user)){
    global $mod_strings; 

    
    //echo out warning message and msgDiv
    echo '<br>'.$mod_strings['LBL_REPAIR_JS_FILES_PROCESSING'];
    echo'<div id="msgDiv"></div>';        

    //echo out script that will make an ajax call to process the files via callJSRepair.php
     echo "<script>
        var ajxProgress;
        var showMSG = 'true';
        //when called, this function will make ajax call to rebuild/repair js files
        function callJSRepair() {
        
            //begin main function that will be called
            ajaxCall = function(){
                //create success function for callback
                success = function() {              
                    //turn off loading message
                    ajaxStatus.hideStatus();
                    var targetdiv=document.getElementById('msgDiv');
                    targetdiv.innerHTML=DOTB.language.get('Administration', 'LBL_REPAIR_JS_FILES_DONE_PROCESSING');
                }//end success
        
                        
                        
                //set loading message and create url
                ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_PROCESSING_REQUEST'));
                postData = \"module=Administration&action=callJSRepair&js_admin_repair=" . htmlspecialchars($_REQUEST['type'], ENT_QUOTES, 'UTF-8') . "&root_directory=".urlencode(getcwd()).
                "&csrf_token=".smarty_function_dotb_csrf_form_token(array('raw'=>true), $smarty)."\";
                 
    
                        
                //if this is a call already in progress, then just return               
                    if(typeof ajxProgress != 'undefined'){ 
                        return;                            
                    }
                        
                //make asynchronous call to process js files
                var ajxProgress = YAHOO.util.Connect.asyncRequest('POST','index.php', {success: success, failure: success}, postData);
                        
    
            };//end ajaxCall method
    
                    
            //show loading status and make ajax call
//            ajaxStatus.hideStatus();
//            ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_PROCESSING_REQUEST'));
            window.setTimeout('ajaxCall()', 2000);
            return;
    
        }
        //call function, so it runs automatically    
        callJSRepair();
        </script>";
        
}




