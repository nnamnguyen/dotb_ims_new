{*

*}

<form name='configure_{$id}' action="index.php" method="post" onSubmit='return DOTB.dashlets.postForm("configure_{$id}", DOTB.myDotb.uncoverPage);'>
{dotb_csrf_form_token}
<input type='hidden' name='id' value='{$id}'>
<input type='hidden' name='module' value='Home'>
<input type='hidden' name='action' value='ConfigureDashlet'>
<input type='hidden' name='to_pdf' value='true'>
<input type='hidden' name='configure' value='true'>
<table width="400" cellpadding="0" cellspacing="0" border="0" class="edit view" align="center">
<tr>
    <td scope='row'>{$titleLbl}</td>
    <td>
    	<input class="text" name="title" size='20' value='{$title}'>
    </td>
</tr>
{if $isRefreshable}
<tr>
    <td scope='row'>
        {$autoRefresh}
    </td>
    <td>
        <select name='autoRefresh'>
            {html_options options=$autoRefreshOptions selected=$autoRefreshSelect}
        </select>
    </td>
</tr>
{/if}
<tr>
    <td scope='row'>{$heightLbl}</td>
    <td>
    	<input class="text" name="height" size='3' value='{$height}'>
    </td>
</tr>
<tr>
    <td align="right" colspan="2">
        <input type='submit' class='button' value='{$saveLbl}'>
   	</td>
</tr>
</table>
</form>
