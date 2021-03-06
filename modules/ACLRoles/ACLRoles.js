
var aclviewer = function(){
	var lastDisplay = '';
	return {
		view: function(role_id, role_module){
					YAHOO.util.Connect.asyncRequest('POST', 'index.php',{'success':aclviewer.display, 'failure':aclviewer.failed}, 'module=ACLRoles&action=EditRole&record=' + role_id + '&category_name=' + role_module); 
					ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_REQUEST_PROCESSED'));
				},
		save: function(form_name){
					var formObject = document.getElementById(form_name); 
					YAHOO.util.Connect.setForm(formObject); 
					YAHOO.util.Connect.asyncRequest('POST', 'index.php',{'success':aclviewer.postSave, 'failure':aclviewer.failed} ); 
					ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_SAVING'));
		},
		postSave: function(o){
			var result = JSON.parse(o.responseText);
			aclviewer.view(result['role_id'], result['module']);
            if (!_.isUndefined(window.parent.DOTB) && !_.isUndefined(window.parent.DOTB.App.view)) {
                 window.parent.DOTB.App.controller.layout.getComponent('bwc').revertBwcModel();
            }
		},
		display:function(o){
					aclviewer.lastDisplay = '';
					ajaxStatus.flashStatus(DOTB.language.get('ACLRoles', 'LBL_DONE'));
					document.getElementById('category_data').innerHTML = o.responseText;
					
				},
		failed:function(){
				ajax.flashStatus(DOTB.language.get('ACLRoles', 'LBL_COULD_NOT_CONNECT'));
		},
		
		toggleDisplay:function(id){
			if(aclviewer.lastDisplay != '' && typeof(aclviewer.lastDisplay) != 'undefined'){
				aclviewer.hideDisplay(aclviewer.lastDisplay);
			}
			if(aclviewer.lastDisplay != id){
				aclviewer.showDisplay(id);
				aclviewer.lastDisplay = id;
			} else{
				aclviewer.lastDisplay = '';
			}

		},
		
		hideDisplay:function(id){
			document.getElementById(id).style.display = 'none';
			document.getElementById(id + 'link').style.display = '';
			
		},
		
		showDisplay:function(id){
			document.getElementById(id).style.display = '';
			document.getElementById(id + 'link').style.display = 'none';
		}
		
	
			
	};
}();
