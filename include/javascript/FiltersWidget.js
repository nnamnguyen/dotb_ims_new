
 
DOTB.FiltersWidget = function() {
	var imgPath;

	var operators = [['AND','ANY'],['OR','ALL']];
	var default_operator = operators[0];
	var toolbar = '';
	
	var panels = new Array();
	var childHighestIndex = new Array();

	return {
		init: function(img_path) {
			imgPath = img_path;
		},
		getPanels: function() {
			return panels;
		},
		
		getAllChildrenPanels:function(panelId, childrenPanelsArray) {
			for (var i = 0; i < panels.length; i++) {
				if (panels[i].parentId == panelId) {
					childrenPanelsArray.push(panels[i].id);
					DOTB.FiltersWidget.getAllChildrenPanels(panels[i].id, childrenPanelsArray);
				}
			}			
		},
		
		removeGroupForEvent: function(obj) {
			DOTB.FiltersWidget.removeGroup(obj.id, obj.renderToId);
		},
		
		removeGroup: function(panelId, parentId){
			//Perform cleanup.
			var index = -1;
			var children;
			for (var i = 0; i < panels.length; i++) {
				if (panels[i].id == panelId) {
					index = i;
					break;
				}
			}
			if (index != -1) {
				panels.splice(index, 1);
			}
			//The top-level panel has been removed
			if (parentId == DOTB.language.get('Reports','LBL_FILTER'))
				childHighestIndex[parentId] = 0;
			
			//Remove the Panel from the UI
			var panelElem = new YAHOO.widget.Module(panelId);
			panelElem.destroy();
		},
		
		addPanel: function(id, parentId, panelId, comboValue) {
		    var panelElem = new Object();
		    panelElem.id = id;
		    panelElem.parentId = parentId;
		    if (typeof(comboValue) != "undefined") {
				if (comboValue == 'AND')
					panelElem.operator = 'AND'
				else
					panelElem.operator = 'OR'
			}
		    else
			    panelElem.operator = "AND";
		    
		    panelElem.children = new Array();
		    panels.push(panelElem);
		    
		    for (var i = 0; i < panels; i++) {
		    	if (panel[i].id = parentId) {
		    		panel[i].children.push(panelId);
		    	}
		    }

		    DOTB.FiltersWidget.display(panelId, id, comboValue);	    	
		},
		addGroupPanelForEvent : function(obj) {
			DOTB.FiltersWidget.addGroupToPanel(obj.id, obj.renderToId);
		},
		addGroupToPanel: function(panelId, parentId, comboValue){
		    var id = "";
		    if (!childHighestIndex[parentId]) {
				childHighestIndex[parentId] = 1;
				id = parentId + ".1";  
		    }
		    else {
				childHighestIndex[parentId]++;
				id = parentId + "." + childHighestIndex[parentId];  
		    }
		    if (parentId == DOTB.language.get('Reports','LBL_FILTER') + ".1"){
				var table = document.getElementById(parentId + "_table");
				
				if (document.getElementById('inlineFiltersHelpTable')) 
					document.getElementById(DOTB.language.get('Reports','LBL_FILTER') + ".1_body_div").innerHTML = "";
				
				if (table.rows.length > 0) {
					DOTB.FiltersWidget.addPanel(id, parentId, panelId, comboValue);
					var newTable = 	document.getElementById(id + "_table");							
					// Increment ID.				
				    if (!childHighestIndex[parentId]) {
					   //children[parentId] = new Array();
						childHighestIndex[parentId] = 1;
						id = parentId + ".1";  
				    }
				    else {
						childHighestIndex[parentId]++;
						id = parentId + "." + childHighestIndex[parentId];  
				    }				
				}
				
				while(table.rows.length > 0){
					var filterDef = DOTB.reports.saveFilter(table.rows[0]);
					DOTB.reports.copyFilter(table.rows[0].getAttribute('id'), table.rows[0], newTable.getAttribute('id'), filterDef);
					var deleteFuncStr = table.rows[0].lastChild.innerHTML.split('src')[0].split('=')[1].substring(1);
					var deleteFuncStrLen = deleteFuncStr.length;
					var deleteFuncStr = deleteFuncStr.substring(0,deleteFuncStrLen - 1);
					var deleteParamsArr = table.rows[0].lastChild.innerHTML.split('src')[0].split('=')[1].substring(1,78).split('(')[1].split(",")
					DOTB.reports.deleteFilter(deleteParamsArr[0],table.rows[0].getAttribute('id'),parentId + "_table");
				}			
		    }
			DOTB.FiltersWidget.addPanel(id, parentId, panelId, comboValue);				
		},
		
		changeSelectElemetValue : function(id) {
			var panelId = id.replace(/_combo/,"");
			for (var i = 0; i < panels.length; i++) {
				if (panels[i].id == panelId) {
					var operator = document.getElementById(id);
					panels[i].operator = operator.options[operator.selectedIndex].value;
					break;
				} // if
			} // for
		},
		
		display: function(renderToId, id, comboValue) {
		    // add a combobox to the toolbar
		    var selectedANDString = "";
		    var selectedORString = "";
		    
			if (typeof(comboValue) != "undefined") {
				if (comboValue == 'AND') {
					selectedANDString = "selected";
				} else {
				    selectedORString = "selected";
				} // else
			} else {
				selectedANDString = "selected";
			}			
		    var selectHTML = "<select onchange=\"DOTB.FiltersWidget.changeSelectElemetValue('" + id + "_combo" + "');\" id=\"" + id + "_combo" + "\"><option value='AND' " + selectedANDString + ">" + DOTB.language.get('Reports','LBL_FILTER_AND') + "</option><option value='OR' " + selectedORString + ">" + DOTB.language.get('Reports','LBL_FILTER_OR') + "</option></select>";
		    
		    var panelStartRow = "<div class='dotb-subpanel-header-row'><table cellspacing=\"0\" width=\"100%\"><tr>";
		    panelStartRow = panelStartRow + "<td nowrap>&nbsp;&nbsp;<label for='"+id + "_combo'>" + DOTB.language.get('Reports','LBL_FILTER_CONDITIONS') + "</label>&nbsp;&nbsp;</td>";
		    panelStartRow = panelStartRow + "<td>" + selectHTML + "</td>";
		    panelStartRow = panelStartRow + "<td style=\"width: 100%\"></td>";
		    panelStartRow = panelStartRow + "<td>&nbsp;" + "</td>";
		    if (panels.length > 1) {
		    	var removeButtonHTML = "<input class=\"button\" type=\"button\" id=\"" + 'remove_btn_'+ id + "\" name=\"" + DOTB.language.get('Reports','LBL_REMOVE_GROUP') + "\" value=\"" + DOTB.language.get('Reports','LBL_REMOVE_GROUP') + "\"" + " onclick=\"DOTB.FiltersWidget.removeGroupForEvent({'id' : '" + id + "', 'renderToId' : '" + renderToId + "'})\";" + " />";
		    	
		    	panelStartRow = panelStartRow + "<td nowrap>" + removeButtonHTML + "</td>";
		    	panelStartRow = panelStartRow + "<td>&nbsp;" + "</td>";
		    } // if
		    var addButtonHTML = "<input class=\"button\" type=\"button\" id=\"" + 'add_btn_'+id + "\" name=\"" + DOTB.language.get('Reports','LBL_ADD_GROUP') + "\"value=\"" + DOTB.language.get('Reports','LBL_ADD_GROUP') + "\"" + " onclick=\"DOTB.FiltersWidget.addGroupPanelForEvent({'id' : '" + id + "_body_div', 'renderToId' : '" + id + "'})\";" + " />";
		    
		    panelStartRow = panelStartRow + "<td nowrap>" + addButtonHTML  + "</td>";
		    panelStartRow = panelStartRow + "</tr></table></div>";
			var panelHTML = panelStartRow + "<table width='100%'><tr><td>&nbsp;&nbsp;&nbsp;</td><td>" +
					"<table width='100%' id='" + id + "_table'></table>" +
					"</td></tr><tr><td>&nbsp;&nbsp;&nbsp;</td><td><div id='"+ id + "_body_div'></div></td></tr></table>";

			if (id == DOTB.language.get('Reports','LBL_FILTER') + ".1") {
				panelHTML = panelStartRow + "<table width='100%'><tr><td>&nbsp;&nbsp;&nbsp;</td><td>" +
						"<table width='100%' id='" + id + "_table'></table>" +
						"</td></tr><tr><td>&nbsp;&nbsp;&nbsp;</td><td><div id='"+ id + "_body_div'><table width='70%' valign='center' id='inlineFiltersHelpTable'><tr><td>"+DOTB.language.get('Reports','LBL_FILTERS_HELP_DESC')+"</td></tr></table></div></td></tr></table>";
				
			} // if
			var title = "";
			if (id == DOTB.language.get('Reports','LBL_FILTER') + ".1") {
				var HELP_DESC = DOTB.language.get('Reports','LBL_FILTERS_HELP_DESC').replace(/(\r\n|\n|\r)/gm,"");
				title =  "<h3 class='spantitle'>" + DOTB.language.get('Reports','LBL_DEFINE_FILTERS') + "<span id='"+id+"_help'><i class='far fa-info-circle' style='vertical-align: middle;cursor:pointer;font-size:20px;margin:0px 5px' onclick='DOTB.util.showHelpTips(this,\"" + HELP_DESC +"\");'></i></span></h3>";
			} else {
				title =  "<h3 class='spantitle'>" + id + "</h3>";
			} // else
			
			var designerModule = new YAHOO.widget.Module(id, { visible: false });
			designerModule.setHeader(title);
			designerModule.setBody(panelHTML);
			designerModule.render(renderToId);
			designerModule.show();
			

			
		}
	};
}();
