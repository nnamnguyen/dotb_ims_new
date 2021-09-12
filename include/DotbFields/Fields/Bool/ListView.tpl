{*

*}

    {if strval($parentFieldArray.$col) == "1" || strval($parentFieldArray.$col) == "yes" || strval($parentFieldArray.$col) == "on"}
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" disabled="true" {$checked}>
