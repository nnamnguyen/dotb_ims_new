{*

*}
{{capture name=display_size assign=size}}{{$displayParams.size|default:6}}{{/capture}}
{html_options id='{{$vardef.name}}' name='{{$vardef.name}}[]' options={{dotbvar key='options' string=true}} size="{{$size}}" style="width: 150px" {{if $size > 1}}multiple="1"{{/if}} selected={{dotbvar key='value' string=true}}}
