{*

*}
{* This is here so currency fields, who don't really have dropdown
lists can work. *}
{if is_string({{dotbvar key='options' string=true}})}
<input type="hidden" class="dotb_field" id="{{dotbvar key='name'}}" value="{ {{dotbvar key='options' string=true}} }">
{ {{dotbvar key='options' string=true}} }
{else}
<input type="hidden" class="dotb_field" id="{{dotbvar key='name'}}" value="{ {{dotbvar key='value' string=true}} }">
{ {{dotbvar key='options' string=true}}[{{dotbvar key='value' string=true}}]}
{/if}
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}}
{{/if}}