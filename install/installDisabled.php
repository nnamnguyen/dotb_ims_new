<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');



if( !isset( $install_script ) || !$install_script ){
    die($mod_strings['ERR_NO_DIRECT_SCRIPT']);
}


$langHeader = get_language_header();
$out =<<<EOQ
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html {$langHeader}>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <meta http-equiv="Content-Style-Type" content="text/css">
   <title>{$disabled_title}</title>
   <link rel="stylesheet" href="install/install.css" type="text/css">
</head>

<body>
  <table cellspacing="0" cellpadding="0" border="0" align="center" class=
  "shell">
    <tr>
      <th width="400">{$disabled_title_2}</th>

      <th width="200" height="30" style="text-align: right;"><a href="http://www.dotbcrm.com" target="_blank"><IMG src="include/images/dotbcrm_login.png" alt="DotbCRM" border="0"></a></th>
    </tr>

    <tr>
      <td colspan="2">
      <p>
		<img src="{$dotb_md}" alt="DotbCRM" border="0">
      </p>
	  {$disabled_text}
      </td>
    </tr>

    <tr>
      <td align="right" colspan="2" height="20">
        <hr>
        <form action="install.php" method="post" name="form" id="form">
        <table cellspacing="0" cellpadding="0" border="0" class="stdTable">
          <tr>
            <td><input class="button" type="submit" value="{$mod_strings['LBL_START']}" /></td>
          </tr>
        </table>
        </form>
      </td>
    </tr>
  </table>
</body>
</html>
EOQ;
echo $out;
?>