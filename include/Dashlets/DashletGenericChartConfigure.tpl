{*

*}


<div>
<form name='configure_{$id}' action="index.php" method="post" onSubmit='return DOTB.dashlets.postForm("configure_{$id}", DOTB.myDotb.uncoverPage);'>
{dotb_csrf_form_token}
<input type='hidden' name='id' value='{$id}'>
<input type='hidden' name='module' value='{$module}'>
<input type='hidden' name='action' value='DynamicAction'>
<input type='hidden' name='DynamicAction' value='configureDashlet'>
<input type='hidden' name='to_pdf' value='true'>
<input type='hidden' name='configure' value='true'>
<input type='hidden' id='dashletType' name='dashletType' value='{$dashletType}' />

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="edit view">
	<tr>
	    <td scope='row'>
		    {$title}
        </td>
        <td colspan='3'>
            <input type='text' name='dashletTitle' value='{$dashletTitle}'>
        </td>
	</tr>
	{if $isRefreshable}
    <tr>
	    <td scope='row'>
		    {$autoRefresh}
        </td>
        <td colspan='3'>
            <select name='autoRefresh'>
				{html_options options=$autoRefreshOptions selected=$autoRefreshSelect}
           	</select>
        </td>
	</tr>
    {/if}
    <tr>
    {foreach name=searchIteration from=$searchFields key=name item=params}
        <td scope='row' valign='top'>
            {$params.label}
        </td>
        <td valign='top' style='padding-bottom: 5px'>
            {$params.input}
        </td>
        {if ($smarty.foreach.searchIteration.iteration is even) and $smarty.foreach.searchIteration.iteration != $smarty.foreach.searchIteration.last}
        </tr><tr>
        {/if}
    {/foreach}
    </tr>
    <tr>
	    <td colspan='4' align='right'>
	        <input type='submit' class='button' value='{$save}'>
	        {if $showClearButton}
	        <input type='submit' class='button' value='{$clear}' onclick='DOTB.searchForm.clear_form(this.form,["dashletTitle","autoRefresh"]);return false;'>
	        {/if}
        </td>    
	</tr>
</table>
</form>
</div>