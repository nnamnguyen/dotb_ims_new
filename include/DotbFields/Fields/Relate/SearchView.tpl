{*

*}
<input type="text" name="{{dotbvar key='name'}}"  class={{if empty($displayParams.class) }}"sqsEnabled"{{else}} "{{$displayParams.class}}" {{/if}} {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}  id="{{dotbvar key='name'}}" size="{{$displayParams.size}}" value="{{dotbvar key='value'}}" title='{{$vardef.help}}' autocomplete="off" {{$displayParams.readOnly}} {{$displayParams.field}}>
<input type="hidden" {{if $displayParams.useIdSearch}}name="{{dotbvar memberName='vardef.id_name' key='name'}}"{{/if}} id="{{dotbvar memberName='vardef.id_name' key='name'}}" value="{{dotbvar memberName='vardef.id_name' key='value'}}">
{{if empty($displayParams.hideButtons) }}
<span class="id-ff multiple">
{{if empty($displayParams.clearOnly) }}
<button type="button" name="btn_{{dotbvar key='name'}}" {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}  title="{$APP.LBL_SELECT_BUTTON_TITLE}" class="button{{if empty($displayParams.selectOnly) }} firstChild{{/if}}" value="{$APP.LBL_SELECT_BUTTON_LABEL}" onclick='open_popup("{{dotbvar key='module'}}", 600, 400, "{{$displayParams.initial_filter}}", true, false, {{$displayParams.popupData}}, "single", true);'>{dotb_getimage alt=$app_strings.LBL_ID_FF_SELECT name="id-ff-select" ext=".png" other_attributes=''}</button>{{/if}}
{{if empty($displayParams.selectOnly) }}<button type="button" name="btn_clr_{{dotbvar key='name'}}" {{if !empty($tabindex)}} tabindex="{{$tabindex}}" {{/if}}  title="{$APP.LBL_CLEAR_BUTTON_TITLE}" class="button{{if empty($displayParams.clearOnly) }} lastChild{{/if}}" onclick="this.form.{{dotbvar key='name'}}.value = ''; this.form.{{dotbvar memberName='vardef.id_name' key='name'}}.value = '';" value="{$APP.LBL_CLEAR_BUTTON_LABEL}">{dotb_getimage name="id-ff-clear" alt=$app_strings.LBL_ID_FF_CLEAR ext=".png" other_attributes=''}</button>
{{/if}}
</span>
{{/if}}
{{if !empty($displayParams.allowNewValue) }}
<input type="hidden" name="{{dotbvar key='name'}}_allow_new_value" id="{{dotbvar key='name'}}_allow_new_value" value="true">
{{/if}}
