{*

*}
{capture name=getLink assign=link}{{dotbvar key='value'}}{/capture}
{{if $vardef.gen}}
{dotb_replace_vars subject='{{$vardef.default|replace:'{':'['|replace:'}':']'}}' assign='link'}
{{/if}}
{if !empty($link) && $link != "http://" && $link != "https://"}
{capture name=getStart assign=linkStart}{$link|substr:0:7}{/capture}
<input type="hidden" class="dotb_field" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}" value="{if ( $linkStart != 'http://' || $linkStart != 'https:/' ) && $link}http://{/if}{$link}">
<iframe src="{if $linkStart != 'http://' && $linkStart != 'https:/' && $link}http://{/if}{$link}" title="{if $linkStart != 'http://' && $linkStart != 'https:/' && $link}http://{/if}{$link}" height="{{dotbvar key='height'}}" width="100%"/></iframe>
{/if}
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}} 
{{/if}}