{*

*}


<div style='width: 500px'>
<form name='configure_{$id}' action="index.php" method="post" onSubmit='return DOTB.dashlets.postForm("configure_{$id}", DOTB.myDotb.uncoverPage);'>
{dotb_csrf_form_token}
<input type='hidden' name='id' value='{$id}'>
<input type='hidden' name='module' value='Home'>
<input type='hidden' name='action' value='ConfigureDashlet'>
<input type='hidden' name='to_pdf' value='true'>
<input type='hidden' name='configure' value='true'>
<table width="400" cellpadding="0" cellspacing="0" border="0" class="edit view" align="center">
<tr>
    <td valign='top' nowrap class='dataLabel'>{$MOD.LBL_CONFIGURE_TITLE}</td>
    <td valign='top' class='dataField'>
    <input class="text" name="title" size='20' value='{$title}'>
    </td>
</tr>
<tr>
    <td valign='top' nowrap class='dataLabel'>{$MOD.LBL_CONFIGURE_VIEW}</td>
    <td valign='top' class='dataField'>
    <select name="view">
    		<option value="day" {if $view == "day"} selected {/if}>{$MOD.LBL_VIEW_DAY}</option>
    		<option value="week" {if $view == "week"} selected {/if}>{$MOD.LBL_VIEW_WEEK}</option>
    </select>
    </td>
</tr>
<tr>
    <td align="right" colspan="2">
        <input type='submit' class='button' value='{$MOD.LBL_SAVE_BUTTON_LABEL}'>
   	</td>
</tr>
</table>
</form>
</div>
