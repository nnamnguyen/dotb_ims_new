<?php

/*

Modification information for LGPL compliance

r56990 - 2010-06-16 13:05:36 -0700 (Wed, 16 Jun 2010) - kjing - snapshot "Mango" svn branch to a new one for GitHub sync

r56989 - 2010-06-16 13:01:33 -0700 (Wed, 16 Jun 2010) - kjing - defunt "Mango" svn dev branch before github cutover

r55980 - 2010-04-19 13:31:28 -0700 (Mon, 19 Apr 2010) - kjing - create Mango (6.1) based on windex

r51719 - 2009-10-22 10:18:00 -0700 (Thu, 22 Oct 2009) - mitani - Converted to Build 3  tags and updated the build system 

r51634 - 2009-10-19 13:32:22 -0700 (Mon, 19 Oct 2009) - mitani - Windex is the branch for Dotb Sales 1.0 development

r50375 - 2009-08-24 18:07:43 -0700 (Mon, 24 Aug 2009) - dwong - branch kobe2 from tokyo r50372

r42807 - 2008-12-29 11:16:59 -0800 (Mon, 29 Dec 2008) - dwong - Branch from trunk/dotbcrm r42806 to branches/tokyo/dotbcrm

r10971 - 2006-01-12 14:58:30 -0800 (Thu, 12 Jan 2006) - chris - Bug 4128: updating Smarty templates to 2.6.11, a version supposedly that plays better with PHP 5.1

r8230 - 2005-10-03 17:47:19 -0700 (Mon, 03 Oct 2005) - majed - Added Dotb_Smarty to the code tree.


*/


/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {popup} function plugin
 *
 * Type:     function<br>
 * Name:     popup<br>
 * Purpose:  make text pop up in windows via overlib
 * @link http://smarty.php.net/manual/en/language.function.popup.php {popup}
 *          (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_popup($params, &$smarty)
{
    $append = '';
    foreach ($params as $_key=>$_value) {
        switch ($_key) {
            case 'text':
            case 'trigger':
            case 'function':
            case 'inarray':
                $$_key = (string)$_value;
                if ($_key == 'function' || $_key == 'inarray')
                    $append .= ',' . strtoupper($_key) . ",'$_value'";
                break;

            case 'caption':
            case 'closetext':
            case 'status':
                $append .= ',' . strtoupper($_key) . ",'" . str_replace("'","\'",$_value) . "'";
                break;

            case 'fgcolor':
            case 'bgcolor':
            case 'textcolor':
            case 'capcolor':
            case 'closecolor':
            case 'textfont':
            case 'captionfont':
            case 'closefont':
            case 'fgbackground':
            case 'bgbackground':
            case 'caparray':
            case 'capicon':
            case 'background':
            case 'frame':
                $append .= ',' . strtoupper($_key) . ",'$_value'";
                break;

            case 'textsize':
            case 'captionsize':
            case 'closesize':
            case 'width':
            case 'height':
            case 'border':
            case 'offsetx':
            case 'offsety':
            case 'snapx':
            case 'snapy':
            case 'fixx':
            case 'fixy':
            case 'padx':
            case 'pady':
            case 'timeout':
            case 'delay':
                $append .= ',' . strtoupper($_key) . ",$_value";
                break;

            case 'sticky':
            case 'left':
            case 'right':
            case 'center':
            case 'above':
            case 'below':
            case 'noclose':
            case 'autostatus':
            case 'autostatuscap':
            case 'fullhtml':
            case 'hauto':
            case 'vauto':
            case 'mouseoff':
            case 'followmouse':
            case 'closeclick':
                if ($_value) $append .= ',' . strtoupper($_key);
                break;

            default:
                $smarty->trigger_error("[popup] unknown parameter $_key", E_USER_WARNING);
        }
    }

    if (empty($text) && !isset($inarray) && empty($function)) {
        $smarty->trigger_error("overlib: attribute 'text' or 'inarray' or 'function' required");
        return false;
    }

    if (empty($trigger)) { $trigger = "onmouseover"; }

    $retval = $trigger . '="return overlib(\''.preg_replace(array("!'!","![\r\n]!"),array("\'",'\r'),$text).'\'';
    $retval .= $append . ');"';
    if ($trigger == 'onmouseover')
       $retval .= ' onmouseout="nd();"';


    return $retval;
}

/* vim: set expandtab: */

?>
