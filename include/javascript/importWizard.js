

DOTB.importWizard= {};

DOTB.importWizard = function() {
	return {
	
		renderDialog: function(importModuleVAR,actionVar,sourceVar){
			// create dialog container div
			var oBody = document.getElementsByTagName('BODY').item(0);
			if ( !document.getElementById( "importWizardDialog" )) {
					var importWizardDialogDiv = document.createElement("div");
					importWizardDialogDiv.id = "importWizardDialog";
					importWizardDialogDiv.style.display = "none";
					importWizardDialogDiv.className = "dashletPanelMenu wizard import";
					importWizardDialogDiv.innerHTML = '<div class="hd"><a href="javascript:void(0)" onClick="javascript:DOTB.importWizard.closeDialog();"><div class="container-close">&nbsp;</div></a><div class="title" id="importWizardDialogTitle"></div></div><div class="bd"><div class="screen" id="importWizardDialogDiv"></div><div id="submitDiv"></div></div>';
					oBody.appendChild(importWizardDialogDiv);
			}
			
			
			
			YAHOO.util.Event.onContentReady("importWizardDialog", function() 
			{
				DOTB.importWizard.dialog = new YAHOO.widget.Dialog("importWizardDialog", 
				{ width : "950px",
				  height: "565px",
				  fixedcenter : true,
				  draggable:false,
				  visible : false, 
				  modal : true,
				  close:false
				 } );
	
				var oHead = document.getElementsByTagName('HEAD').item(0);
				// insert requred js files
				if ( !document.getElementById( "dotb_grp_yui_widgets" )) {
						var oScript= document.createElement("script");
						oScript.type = "text/javascript";
						oScript.id = "dotb_grp_yui_widgets";
						oScript.src="cache/javascript/dotbcrm12.min.js";
						oHead.appendChild( oScript);
				}
				
				var success = function(data) {		
					var response = YAHOO.lang.JSON.parse(data.responseText);
					importWizardDialogDiv = document.getElementById('importWizardDialogDiv');
					var submitDiv = document.getElementById('submitDiv');
					var importWizardDialogTitle = document.getElementById('importWizardDialogTitle');
					importWizardDialogDiv.innerHTML = response['html'];
					importWizardDialogTitle.innerHTML = response['title'];
					submitDiv.innerHTML = response['submitContent'];
					document.getElementById('importWizardDialog').style.display = '';												 
					DOTB.importWizard.dialog.render();
					DOTB.importWizard.dialog.show();
				}

				var cObj = YAHOO.util.Connect.asyncRequest('GET', 'index.php?module=Import&action='+actionVar+'&import_module='+importModuleVAR+'&source='+sourceVar, {success: success, failure: success});			
				return false;
			});
		},
		closeDialog: function() {
			
				DOTB.importWizard.dialog.hide();
				var importWizardDialogDiv = document.getElementById('importWizardDialogDiv');
				var submitDiv = document.getElementById('submitDiv');
				importWizardDialogDiv.innerHTML = "";
				submitDiv.innerHTML = "";
				DOTB.importWizard.dialog.destroy();
		},
		
		renderLoadingDialog: function() {
			DOTB.importWizard.loading = new YAHOO.widget.Panel("loading",
			{ width:"240px",
			  fixedcenter:true,
			  close:false,
			  draggable:false,
              constraintoviewport:false, 															  
			  modal:true,
			  visible:false,
			  effect:[{effect:YAHOO.widget.ContainerEffect.SLIDE, duration:0.5},
			  		  {effect:YAHOO.widget.ContainerEffect.FADE, duration:.5}]
			});
			DOTB.importWizard.loading.setBody('<div id="loadingPage" align="center" style="vertical-align:middle;"><img src="' + DOTB.themes.image_server + 'index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName=img_loading.gif&v='+DOTB.VERSION_MARK+'" align="absmiddle" /> <b>' + DOTB.language.get('app_strings', 'LBL_LOADING_PAGE') +'</b></div>');
			DOTB.importWizard.loading.render(document.body);		
			if (document.getElementById('loading_c'))
                document.getElementById('loading_c').style.display = 'none';
		}
    };
}();
