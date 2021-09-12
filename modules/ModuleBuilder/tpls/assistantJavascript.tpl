{*

*}
<script>
{literal}
if(typeof(Assistant)!="undefined" && Assistant.mbAssistant){
	//Assistant.mbAssistant.render(document.body);
{/literal}
{if $userPref }
	Assistant.processUserPref("{$userPref}");
{/if}
{if $assistant.key && $assistant.group}
	Assistant.mbAssistant.setBody(DOTB.language.get('ModuleBuilder','assistantHelp').{$assistant.group}.{$assistant.key});
{/if}
{literal}
	if(Assistant.mbAssistant.visible){
		Assistant.mbAssistant.show();
		}
}
{/literal}
</script>
