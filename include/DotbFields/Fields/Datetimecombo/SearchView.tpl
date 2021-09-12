{*

*}
<table border="0" cellpadding="0" cellspacing="0">
<tr valign="middle">
<td nowrap>
<input autocomplete="off" type="text" id="{{dotbvar key='name'}}_date" value="{$fields[{{dotbvar key='name' stringFormat=true}}].value}" size="11" maxlength="10" title='{{$vardef.help}}' {{if !empty($tabindex)}} tabindex='{{$tabindex}}' {{/if}}  onblur="combo_{{dotbvar key='name'}}.update(); {{if isset($displayParams.updateCallback)}}{{$displayParams.updateCallback}}{{/if}}">
{capture assign="other_attributes"}alt="{$APP.LBL_ENTER_DATE}" style="position:relative; top:6px" border="0" id="{{dotbvar key='name'}}_trigger"{/capture}
{dotb_getimage name="jscalendar" ext=".gif" other_attributes="$other_attributes"}&nbsp;
{{if empty($displayParams.splitDateTime)}}
</td>
<td nowrap>
{{else}}
<br>
{{/if}}
<div id="{{dotbvar key='name'}}_time_section"></div>
{{if $displayParams.showNoneCheckbox}}
<script type="text/javascript">
function set_{{dotbvar key='name'}}_values(form) {ldelim}
 if(form.{{dotbvar key='name'}}_flag.checked)  {ldelim}
	form.{{dotbvar key='name'}}_flag.value=1;
	form.{{dotbvar key='name'}}.value="";
	form.{{dotbvar key='name'}}.readOnly=true;
 {rdelim} else  {ldelim}
	form.{{dotbvar key='name'}}_flag.value=0;
	form.{{dotbvar key='name'}}.readOnly=false;
 {rdelim}
{rdelim}
</script>
{{/if}}
</td>
</tr>
{{if $displayParams.showFormats}}
<tr valign="middle">
<td nowrap>
<span class="dateFormat">{$USER_DATEFORMAT}</span>
</td>
<td nowrap>
<span class="dateFormat">{$TIME_FORMAT}</span>
</td>
</tr>
{{/if}}
</table>
<input type="hidden" id="{{dotbvar key='name'}}" name="{{dotbvar key='name'}}" value="{$fields[{{dotbvar key='name' stringFormat=true}}].value}">
<script type="text/javascript" src="{dotb_getjspath file='include/DotbFields/Fields/Datetimecombo/Datetimecombo.js'}"></script>
<script type="text/javascript">
var combo_{{dotbvar key='name'}} = new Datetimecombo("{$fields[{{dotbvar key='name' stringFormat=true}}].value}", "{{dotbvar key='name'}}", "{$TIME_FORMAT}", "{{$tabindex}}", '{{$displayParams.showNoneCheckbox}}', '{$fields[{{dotbvar key='name' stringFormat=true}}_flag].value}', true);
//Render the remaining widget fields
text = combo_{{dotbvar key='name'}}.html('{{$displayParams.updateCallback}}');
document.getElementById('{{dotbvar key='name'}}_time_section').innerHTML = text;

//Call eval on the update function to handle updates to calendar picker object
eval(combo_{{dotbvar key='name'}}.jsscript('{{$displayParams.updateCallback}}'));
</script>

<script type="text/javascript">
function update_{{dotbvar key='name'}}_available() {ldelim}
      YAHOO.util.Event.onAvailable("{{dotbvar key='name'}}_date", this.handleOnAvailable, this);
{rdelim}

update_{{dotbvar key='name'}}_available.prototype.handleOnAvailable = function(me) {ldelim}
	Calendar.setup ({ldelim}
	onClose : update_{{dotbvar key='name'}},
	inputField : "{{dotbvar key='name'}}_date",
	ifFormat : "{$CALENDAR_FORMAT}",
	daFormat : "{$CALENDAR_FORMAT}",
	button : "{{dotbvar key='name'}}_trigger",
	singleClick : true,
	step : 1,
        startWeekday: {$CALENDAR_FDOW|default:'0'},
	weekNumbers:false
	{rdelim});

	//Call update for first time to round hours and minute values
	combo_{{dotbvar key='name'}}.update(false);
{rdelim}

var obj_{{dotbvar key='name'}} = new update_{{dotbvar key='name'}}_available();
</script>
