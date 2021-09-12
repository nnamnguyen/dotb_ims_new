<?php

die('Backup is not defined!');
use Dotbcrm\Dotbcrm\Security\Csrf\CsrfAuthenticator;
use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

class ViewBackups extends DotbView
{
    /**
	 * @see DotbView::_getModuleTitleParams()
	 */
	protected function _getModuleTitleParams($browserTitle = false)
	{
	    global $mod_strings;
	    
    	return array(
    	   "<a href='index.php?module=Administration&action=index'>".$mod_strings['LBL_MODULE_NAME']."</a>",
    	   $mod_strings['LBL_BACKUPS_TITLE']
    	   );
    }
    
    /**
	 * @see DotbView::preDisplay()
	 */
	public function preDisplay()
	{
	    global $current_user;
        
	    if (!is_admin($current_user)) {
	        dotb_die("Unauthorized access to administration.");
        }
        if (isset($GLOBALS['dotb_config']['hide_admin_backup']) && $GLOBALS['dotb_config']['hide_admin_backup'])
        {
            dotb_die("Unauthorized access to backups.");
        }
	}
    
    /**
	 * @see DotbView::display()
	 */
	public function display()
	{
        require_once('include/utils/zip_utils.php');

        $form_action = "index.php?module=Administration&action=Backups";
        
        $backup_dir = "";
        $backup_zip = "";
        $run        = "confirm";
        $input_disabled = "";
        global $mod_strings;
        $errors = array();
        $request = InputValidation::getService();
        $runReq = $request->getValidInputPost('run');
        // process "run" commands
        if ($runReq) {
            $run = $runReq;
            $backup_dir = $request->getValidInputPost('backup_dir');
            $backup_zip = $request->getValidInputPost('backup_zip');

            if( $run == "confirm" ){
                if( $backup_dir == "" ){
                    $errors[] = $mod_strings['LBL_BACKUP_DIRECTORY_ERROR'];
                }
                if( $backup_zip == "" ){
                    $errors[] = $mod_strings['LBL_BACKUP_FILENAME_ERROR'];
                }
        
                if( sizeof($errors) > 0 ){
                    return( $errors );
                }
        
                if (!is_dir($backup_dir) && !mkdir_recursive($backup_dir)) {
                    $errors[] = $mod_strings['LBL_BACKUP_DIRECTORY_EXISTS'];
                } elseif (!is_writable($backup_dir)) {
                    $errors[] = $mod_strings['LBL_BACKUP_DIRECTORY_NOT_WRITABLE'];
                }

                if( is_file( "$backup_dir/$backup_zip" ) ){
                    $errors[] = $mod_strings['LBL_BACKUP_FILE_EXISTS'];
                }
                if( is_dir( "$backup_dir/$backup_zip" ) ){
                    $errors[] = $mod_strings['LBL_BACKUP_FILE_AS_SUB'];
                }
                if( sizeof( $errors ) == 0 ){
                    $run = "confirmed";
                    $input_disabled = "readonly";
                }
            }
            else if( $run == "confirmed" ){
                ini_set( "memory_limit", "-1" );
                ini_set( "max_execution_time", "0" );
                zip_dir( ".", "$backup_dir/$backup_zip" );
                $run = "done";
            }
        }
        if( sizeof($errors) > 0 ){
            foreach( $errors as $error ){
                print( "<font color=\"red\">$error</font><br>" );
            }
        }
        if( $run == "done" ){
            $size = filesize( "$backup_dir/$backup_zip" );
            print( $mod_strings['LBL_BACKUP_FILE_STORED'] . " $backup_dir/$backup_zip ($size bytes).<br>\n" );
            print( "<a href=\"index.php?module=Administration&action=index\">" . $mod_strings['LBL_BACKUP_BACK_HOME']. "</a>\n" );
        }
        else{
        ?>
        
            <?php 
            $csrf = CsrfAuthenticator::getInstance();
            echo getClassicModuleTitle(
                "Administration", 
                array(
                    "<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME','Administration')."</a>",
                   $mod_strings['LBL_BACKUPS_TITLE'],
                   ), 
                false
                );
            echo $mod_strings['LBL_BACKUP_INSTRUCTIONS_1']; ?>
            <br>
            <?php echo $mod_strings['LBL_BACKUP_INSTRUCTIONS_2']; ?><br>
            <form name="Backups" action="<?php print( $form_action );?>" method="post" onSubmit="return (check_for_errors());">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf->getFormToken();?>" />
            <table>
            <tr>
                <td><?php echo $mod_strings['LBL_BACKUP_DIRECTORY']; ?><br><i><?php echo $mod_strings['LBL_BACKUP_DIRECTORY_WRITABLE']; ?></i></td>
                <td><input size="100" type="input" name="backup_dir" <?php print( $input_disabled );?> value="<?php print( $backup_dir );?>"/></td>
            </tr>
            <tr>
                <td><?php echo $mod_strings['LBL_BACKUP_FILENAME']; ?></td>
                <td><input type="input" name="backup_zip" <?php print( $input_disabled );?> value="<?php print( $backup_zip );?>"/></td>
            </tr>
            </table>
            <input type=hidden name="run" value="<?php print( $run );?>" />
        
        <?php
            switch( $run ){
                case "confirm":
        ?>
                    <input type="submit" value="<?php echo $mod_strings['LBL_BACKUP_CONFIRM']; ?>" />
        <?php
                    break;
                case "confirmed":
        ?>
                    <?php echo $mod_strings['LBL_BACKUP_CONFIRMED']; ?><br>
                    <input type="submit" value="<?php echo $mod_strings['LBL_BACKUP_RUN_BACKUP']; ?>" />
        <?php
                    break;
            }
        ?>
        
            </form>
            <script type="text/javascript">
                function check_for_errors(){
                    addForm('Backups');
                    addToValidate('Backups', 'backup_dir', 'varchar', 'true', '<?= $mod_strings['LBL_BACKUP_DIRECTORY'];?>');
                    addToValidate('Backups', 'backup_zip', 'varchar', 'true', '<?= $mod_strings['LBL_BACKUP_FILENAME'];?>');
                    return check_form('Backups');
                }
            </script>
        
        <?php
        }   // end if/else of $run options
        $GLOBALS['log']->info( "Backups" );
    }
}
