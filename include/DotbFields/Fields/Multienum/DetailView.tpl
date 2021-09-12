{*

*}
{if !empty({{dotbvar key='value' string=true}}) && ({{dotbvar key='value' string=true}} != '^^')}
<input type="hidden" class="dotb_field" id="{{dotbvar key='name'}}" value="{{dotbvar key='value'}}">
{multienum_to_array string={{dotbvar key='value' string=true}} assign="vals"}
{foreach from=$vals item=item}
<li style="margin-left:10px;">{ {{dotbvar key='options' string=true}}.$item }</li>
{/foreach}
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}}
{{/if}}
{/if}