{*

*}
{if strval({{dotbvar key='value' stringFormat='false'}}) == "1" || strval({{dotbvar key='value' stringFormat='false'}}) == "yes" || strval({{dotbvar key='value' stringFormat='false'}}) == "on"} 
{assign var="checked" value="CHECKED"}
{else}
{assign var="checked" value=""}
{/if}
<input type="checkbox" class="checkbox" name="{{dotbvar key='name'}}" id="{{dotbvar key='name'}}" value="{{dotbvar key='value' stringFormat='false'}}" disabled="true" {$checked}>
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}} 
{{/if}}