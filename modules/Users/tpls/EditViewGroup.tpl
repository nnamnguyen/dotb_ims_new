{{*

*}}
Hello Group!
{{include file="include/EditView/EditView.tpl"}}
Goodbye Group!
{{*
{{include file=$headerTpl}}
{dotb_include include=$includes}
<div id="{{$form_name}}_tabs"
{{if $useTabs}}
class="yui-navset"
{{/if}}
>

<div id="Default_{$module}_Subpanel">

Hello Group!

</div></div>
{{include file=$footerTpl}}
{{if $useTabs}}
{dotb_getscript file="cache/javascript/dotbcrm12.min.js"}
<script type="text/javascript">
var {{$form_name}}_tabs = new YAHOO.widget.TabView("{{$form_name}}_tabs");
{{$form_name}}_tabs.selectTab(0);
</script>
{{/if}}
<script type="text/javascript">
YAHOO.util.Event.onContentReady("{{$form_name}}",
    function () {ldelim} initEditView(document.forms.{{$form_name}}) {rdelim});
//window.setTimeout(, 100);
window.onbeforeunload = function () {ldelim} return onUnloadEditView(); {rdelim};
</script>
*}}
