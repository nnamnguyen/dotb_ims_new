{*

*}
<script language="javascript">
    var _form_id = '{$form_id}';
    {literal}
    DOTB.util.doWhen(function(){
        _form_id = (_form_id == '') ? 'EditView' : _form_id;
        return document.getElementById(_form_id) != null;
    }, DOTB.themes.actionMenu);
    {/literal}
</script>
{assign var='place' value="_FOOTER"} <!-- to be used for id for buttons with custom code in def files-->
{{if empty($form.button_location) || $form.button_location == 'bottom'}}
<div class="buttons">
{{if !empty($form) && !empty($form.buttons)}}
   {{foreach from=$form.buttons key=val item=button}}
      {{dotb_button module="$module" id="$button" form_id="$form_id" view="$view" appendTo="footer_buttons" location="FOOTER"}}
   {{/foreach}}
{{else}}
{{dotb_button module="$module" id="SAVE" view="$view" form_id="$form_id" location="FOOTER" appendTo="footer_buttons"}}
{{dotb_button module="$module" id="CANCEL" view="$view" form_id="$form_id" location="FOOTER" appendTo="footer_buttons"}}
{{/if}}
{{if empty($form.hideAudit) || !$form.hideAudit}}
{{dotb_button module="$module" id="Audit" view="$view" form_id="$form_id" appendTo="footer_buttons"}}
{{/if}}
{{dotb_action_menu buttons=$footer_buttons class="fancymenu" flat=true}}
</div>
{{/if}}
</form>
{{if $externalJSFile}}
{dotb_include include=$externalJSFile}
{{/if}}

{$set_focus_block}

{{if isset($scriptBlocks)}}
<!-- Begin Meta-Data Javascript -->
{{$scriptBlocks}}
<!-- End Meta-Data Javascript -->
{{/if}}
<script>DOTB.util.doWhen("document.getElementById('EditView') != null",
        function(){ldelim}DOTB.util.buildAccessKeyLabels();{rdelim});
</script>
