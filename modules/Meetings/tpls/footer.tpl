{*

*}
</form>

{{if $externalJSFile}}
	require_once("'".$externalJSFile."'");
{{/if}}

{$set_focus_block}

{{if isset($scriptBlocks)}}
	<!-- Begin Meta-Data Javascript -->
	{{$scriptBlocks}}
	<!-- End Meta-Data Javascript -->
{{/if}}

<div class="h3Row" id="scheduler"></div>

<div>
<h3>{$MOD.LBL_RECURRENCE}</h3>
{include file='modules/Calendar/tpls/repeat.tpl'}
{dotb_getscript file='modules/Meetings/recurrence.js'}
<script type="text/javascript">
{literal}
DOTB.util.doWhen(function() {
    return typeof CAL != "undefined";
}, function () {
    CAL.fillRepeatForm({/literal}{$repeatData}{literal});
});
{/literal}
</script>
</div>
  
<script type="text/javascript">
{literal}
DOTB.meetings = {};
var meetingsLoader = new YAHOO.util.YUILoader({
    // Bug #48940 Skin always must be blank
    skin: {
        base: 'blank',
        defaultSkin: ''
    },
    onSuccess: function(){
		DOTB.meetings.fill_invitees = function() {
			if (typeof(GLOBAL_REGISTRY) != 'undefined')  {
				DotbWidgetScheduler.fill_invitees(document.EditView);
			}
		}
		var root_div = document.getElementById('scheduler');
		var dotbContainer_instance = new DotbContainer(document.getElementById('scheduler'));
		dotbContainer_instance.start(DotbWidgetScheduler);
		if ( document.getElementById('save_and_continue') ) {
			var oldclick = document.getElementById('save_and_continue').attributes['onclick'].nodeValue;
			document.getElementById('save_and_continue').onclick = function(){
				DOTB.meetings.fill_invitees();
				eval(oldclick);
			}
		}
	}
});
meetingsLoader.insert();
YAHOO.util.Event.onContentReady("{/literal}{{$form_name}}{literal}",function() {
    var durationHours = document.getElementById('duration_hours');
    if (durationHours) {
        document.getElementById('duration_minutes').tabIndex = durationHours.tabIndex;
    }

    var reminderChecked = document.getElementsByName('reminder_checked');
    for(i=0;i<reminderChecked.length;i++) {
        if (reminderChecked[i].type == 'checkbox' && document.getElementById('reminder_list')) {
            YAHOO.util.Dom.getFirstChild('reminder_list').tabIndex = reminderChecked[i].tabIndex;
        }
    }
});
{/literal}
</script>
</form>
<div class="buttons">
{{if !empty($form) && !empty($form.buttons_footer)}}
   {{foreach from=$form.buttons_footer key=val item=button}}
      {{dotb_button module="$module" id="$button" location="FOOTER" view="$view"}}
   {{/foreach}}
{{else}}
	{{dotb_button module="$module" id="SAVE" view="$view"}}
	{{dotb_button module="$module" id="CANCEL" view="$view"}}
{{/if}}

{{dotb_button module="$module" id="Audit" view="$view"}}
</div> 
