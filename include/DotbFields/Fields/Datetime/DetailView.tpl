{*

*}
{*
    check to see if 'date_formatted_value' has been added to the vardefs, and use it if it has, otherwise use the normal dotbvar function
*}

{if strlen({{dotbvar key='value' string=true}}) <= 0}
    {assign var="value" value={{dotbvar key='default_value' string=true}} }
{else}
    {assign var="value" value={{dotbvar key='value' string=true}} }
{/if}



<span class="dotb_field" id="{{dotbvar key='name'}}">{$value}</span>
{{if !empty($vardef.group) && $vardef.group == 'created_by_name' }}
    {$APP.LBL_BY} {$fields.created_by_name.value}
{{elseif !empty($vardef.group) && $vardef.group == 'modified_by_name' }}
    {$APP.LBL_BY} {$fields.modified_by_name.value}
{{/if}}

{{if !empty($displayParams.enableConnectors)}}
{if !empty($value)}
{{dotbvar_connector view='DetailView'}}
{/if}
{{/if}}