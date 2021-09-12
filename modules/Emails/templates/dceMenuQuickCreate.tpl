{*

*}
<div id="dccontent" style="width:880px; height:400px; z-index:2;"></div>
<script type='text/javascript'>
{literal}
function closeEmailOverlay() {
	lastLoadedMenu=undefined; 

	if(typeof DOTB.quickCompose.parentPanel != 'undefined' && DOTB.quickCompose.parentPanel != null) {
       if(tinyMCE) {
    	  tinyMCE.execCommand('mceRemoveControl', false, 'htmleditor0'); 
       }
       DOTB.quickCompose.parentPanel.hide();
       DOTB.quickCompose.parentPanel = null;
	}
	
	DCMenu.closeOverlay();
}
{/literal}   
 
DOTB.quickCompose.init({$json_output});

{literal}

YAHOO.util.Event.onAvailable('dcmenu_close_link', function() {
	document.getElementById('dcmenu_close_link').href = 'javascript:closeEmailOverlay();'; 
}, this);

//override the action here so we know to close the menu when email is sent
action_dotb_grp1 = 'quickcreate';

{/literal}
</script>
