{*

*}
{{capture name=idname assign=idname}}{{dotbvar key='name'}}{{/capture}}
{{if !empty($displayParams.idName)}}
    {{assign var=idname value=$displayParams.idName}}
{{/if}}
<span class="dateTime">
{assign var=date_value value={{dotbvar key='value' string=true}} }
<input class="date_input" autocomplete="off" type="text" name="{{$idname}}" id="{{$idname}}" value="{$date_value}" title='{{$vardef.help}}' {{$displayParams.field}} tabindex='{{$tabindex}}' {{if !empty($displayParams.accesskey)}} accesskey='{{$displayParams.accesskey}}' {{/if}}   size="11" maxlength="10" >
{{if !$displayParams.hiddeCalendar}}
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{{$idname}}_trigger"{/capture}
{dotb_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}
{{/if}}
{{if $displayParams.showFormats}}
&nbsp;(<span class="dateFormat">{$USER_DATEFORMAT}</span>)
{{/if}}
</span>
{{if !$displayParams.hiddeCalendar}}
<script type="text/javascript">
Calendar.setup ({ldelim}
inputField : "{{$idname}}",
ifFormat : "{$CALENDAR_FORMAT}",
daFormat : "{$CALENDAR_FORMAT}",
button : "{{$idname}}_trigger",
singleClick : true,
dateStr : "{$date_value}",
startWeekday: {$CALENDAR_FDOW|default:'0'},
step : 1,
weekNumbers:false
{rdelim}
);
</script>
{{/if}}
