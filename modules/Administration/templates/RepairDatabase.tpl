{*

*}

<h3>{$MOD.LBL_REPAIR_DATABASE_DIFFERENCES}</h3>
<p>{$MOD.LBL_REPAIR_DATABASE_TEXT}</p>
<form name="RepairDatabaseForm" method="post">
{dotb_csrf_form_token}
<input type="hidden" name="module" value="Administration"/>
<input type="hidden" name="action" value="repairDatabase"/>
<input type="hidden" name="raction" value="execute"/>
<textarea name="sql" rows="24" cols="150" id="repairsql">{$qry_str}</textarea>
<br/>
<input type="button" class="button" value="{$MOD.LBL_REPAIR_DATABASE_EXECUTE}" onClick="document.RepairDatabaseForm.raction.value='execute'; document.RepairDatabaseForm.submit();"/>
<input type="button" class="button" value="{$MOD.LBL_REPAIR_DATABASE_EXPORT}" onClick="document.RepairDatabaseForm.raction.value='export'; document.RepairDatabaseForm.submit();"/>