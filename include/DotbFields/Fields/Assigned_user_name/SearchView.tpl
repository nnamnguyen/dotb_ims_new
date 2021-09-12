{*

*}
{{capture name=display_size assign=size}}{{$displayParams.size|default:6}}{{/capture}}
{php}$this->_tpl_vars['user_options'] = get_user_array(false);{/php}
{html_options name='{{$vardef.name}}[]' options=$user_options size="{{$size}}" style="width: 150px" {{if $size > 1}}multiple="1"{{/if}} selected={{dotbvar key='value' string=true}}}
