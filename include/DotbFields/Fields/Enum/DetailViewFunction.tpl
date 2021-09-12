{*

*}
<span class="dotb_field" id="{{if empty($displayParams.idName)}}{{dotbvar key='name'}}{{else}}{{$displayParams.idName}}{{/if}}">{{dotbvar key='value'}}</span>
{{if !empty($displayParams.enableConnectors)}}
{{dotbvar_connector view='DetailView'}} 
{{/if}}