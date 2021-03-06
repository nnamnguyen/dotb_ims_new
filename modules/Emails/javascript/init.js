

/******************************************************************************
 * Initialize Email 2.0 Application
 */

//Override Dotb Languge so quick creates work properly


function email2init() {
    if (!DOTB.util.isTouchScreen()) {
 	 tinyMCE.init({
 		 convert_urls : false,
         theme_advanced_toolbar_align : tinyConfig.theme_advanced_toolbar_align,
         valid_children : tinyConfig.valid_children,
         width: tinyConfig.width,
         theme: tinyConfig.theme,
         theme_advanced_toolbar_location : tinyConfig.theme_advanced_toolbar_location,
         theme_advanced_buttons1 : tinyConfig.theme_advanced_buttons1,
         theme_advanced_buttons2 : tinyConfig.theme_advanced_buttons2,
         theme_advanced_buttons3 : tinyConfig.theme_advanced_buttons3,
         plugins : tinyConfig.plugins,
         elements : tinyConfig.elements,
         language : tinyConfig.language,
         extended_valid_elements : tinyConfig.extended_valid_elements,
         mode: tinyConfig.mode,
         strict_loading_mode : true,
		 force_br_newlines : true,
         forced_root_block : '',
         directionality : (typeof(rtl) == "undefined") ? "ltr" : "rtl"
     });
    }

    // initialze message overlay
    DOTB.email2.e2overlay = new YAHOO.widget.Dialog("DOTB.email2.e2overlay", {
            //iframe        : true,
            modal       : false,
            autoTabs    : true,
            width       : 300,
            height      : 120,
            shadow      : true
        }
    );
	// Hide Dotb menu
	if (DOTB.themes.tempHideLeftCol)
    	DOTB.themes.tempHideLeftCol();

	// set defaults for YAHOO.util.DragDropManager
	YAHOO.util.DDM.mode = 0; // point mode, default is point (0)

	DOTB.email2.nextYear = new Date();
	DOTB.email2.nextYear.setDate(DOTB.email2.nextYear.getDate() + 360);

	
    // initialize and display UI framework (complexLayout.js)
    complexLayoutInit();
    
    // initialize and display grid (grid.js)
    gridInit();
    
	DOTB.email2.folders.rebuildFolders(true);
	var SEC = DOTB.email2.contextMenus; 
	
	//Grid menu
	var emailMenu = SEC.emailListContextMenu = new YAHOO.widget.ContextMenu("emailContextMenu", {
		trigger: DOTB.email2.grid.get("element"),
		lazyload: true
	});
	emailMenu.subscribe("beforeShow", function() {
		var oTarget = this.contextEventTarget;
		if (typeof(oTarget) == "undefined")
		  return;
		var grid = DOTB.email2.grid;
		var selectedRows = grid.getSelectedRows();
		var multipleSelected = (selectedRows.length > 1) ? true: false;
		if (!multipleSelected)
		{
			grid.unselectAllRows();
			grid.selectRow(oTarget);
			DOTB.email2.contextMenus.showEmailsListMenu(grid, grid.getRecord(oTarget));	
		}
		else if(multipleSelected)
		{
		    DOTB.email2.contextMenus.showEmailsListMenu(grid, grid.getRecord(oTarget));
		}
	});
	
	//When we need to access menu items later we can only do so by indexes so we create a mapping to allow
	//us to access individual elements easier by name rather than by index
	emailMenu.itemsMapping = {'viewRelationships':0, 'openMultiple': 1, 'archive' : 2,  'reply' : 3,'replyAll' : 4,'forward' : 5,
	                           'delete' : 6,'print' : 7,'mark' : 8,'assignTo' : 9, 'relateTo' : 10};
	emailMenu.addItems([
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_relate.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_VIEW_RELATIONSHIPS,
            id: 'showDetailView',
            onclick: { fn: SEC.showDetailView }
        },
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=open_multiple.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_OPEN_ALL,
            onclick: { fn: SEC.openMultiple }
        },
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_archive.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_ARCHIVE_TO_DOTB,
            onclick: { fn: SEC.archiveToDotb }
        },
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_reply.gif&v="+DOTB.VERSION_MARK+"'/>"+ app_strings.LBL_EMAIL_REPLY,
            id: 'reply',
            onclick: { fn: SEC.replyForwardEmailContext }
        },
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_replyall.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_REPLY_ALL,
            id: 'replyAll',
            onclick: { fn: SEC.replyForwardEmailContext }
        },
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_forward.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_FORWARD,
            id: 'forward',
            onclick: { fn: SEC.replyForwardEmailContext }
        },
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_delete.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_DELETE,
            id: 'delete',
            onclick: { fn: SEC.markDeleted }
        },
        {
            text: "<img src='themes/default/images/Print_Email.gif?v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_PRINT,
            id: 'print',
            onclick: { fn: SEC.viewPrintable }
        },                
        // Mark... submenu
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_mark.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_MARK,
            submenu: {
        		id: "markEmailMenu",
                itemdata : [
                    {
                        text: app_strings.LBL_EMAIL_MARK + " " + app_strings.LBL_EMAIL_MARK_UNREAD,
                        onclick: { fn: SEC.markUnread }
                    },
                    {
                        text: app_strings.LBL_EMAIL_MARK + " " + app_strings.LBL_EMAIL_MARK_READ,
                        onclick: { fn: SEC.markRead }
                    },
                    {
                        text: app_strings.LBL_EMAIL_MARK + " " + app_strings.LBL_EMAIL_MARK_FLAGGED,
                        onclick: { fn: SEC.markFlagged }
                    },
                    {
                        text: app_strings.LBL_EMAIL_MARK + " " + app_strings.LBL_EMAIL_MARK_UNFLAGGED,
                        onclick: {  fn: SEC.markUnflagged }
                    }
                ]
            }
         },
        {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_assign.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_ASSIGN_TO,
        	id: 'assignTo',
        	onclick: { fn: SEC.assignEmailsTo }
         },
         {
            text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_relate.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_RELATE_TO,
            id: 'relateTo',
            onclick: { fn: SEC.relateTo }
         }
    ]);
	SEC.emailListContextMenu.render();
	
	//Handle the Tree folder menu trigger ourselves
	YAHOO.util.Event.addListener(YAHOO.util.Dom.get("emailtree"), "contextmenu", DOTB.email2.folders.handleRightClick)

	
    	//Folder Menu
    SEC.frameFoldersContextMenu = new YAHOO.widget.ContextMenu("folderContextMenu", {
		trigger: "",
		lazyload: true 
	});
    SEC.frameFoldersContextMenu.addItems([
		{   text: "<img src='index.php?entryPoint=getImage&themeName="+DOTB.themes.theme_name+"&imageName=icon_email_check.gif&v="+DOTB.VERSION_MARK+"'/>" + app_strings.LBL_EMAIL_CHECK,
			onclick: {  fn: function() {
		        var node = DOTB.email2.clickedFolderNode;
		        if (node.data.ieId) {
		            DOTB.email2.folders.startEmailCheckOneAccount(node.data.ieId, false)};
		    }}
		},
		{   text: app_strings.LBL_EMAIL_MENU_SYNCHRONIZE,
			onclick: {  fn: function() {
		        var node = DOTB.email2.clickedFolderNode;
		        if (node.data.ieId) {
		            DOTB.email2.folders.startEmailCheckOneAccount(node.data.ieId, true)};
		    }}
		},
		{
		    text: app_strings.LBL_EMAIL_MENU_ADD_FOLDER,
		    onclick: {  fn: DOTB.email2.folders.folderAdd }
		},
		{
		    text: app_strings.LBL_EMAIL_MENU_DELETE_FOLDER,
		    onclick: {  fn: DOTB.email2.folders.folderDelete }
		},
		{
		    text: app_strings.LBL_EMAIL_MENU_RENAME_FOLDER,
		    onclick: {  fn: DOTB.email2.folders.folderRename }
		 },
		 {
		    text: app_strings.LBL_EMAIL_MENU_EMPTY_TRASH,
		    onclick: {  fn: DOTB.email2.folders.emptyTrash }
		  },
		 {
		    text: app_strings.LBL_EMAIL_MENU_CLEAR_CACHE,
		    onclick: {  fn: function() {
		        var node = DOTB.email2.clickedFolderNode;
		        if (node.data.ieId) {
		            DOTB.email2.folders.clearCacheFiles(node.data.ieId)};
		    }}
		  } 
	]);
    SEC.frameFoldersContextMenu.render();
    
    SEC.initContactsMenu = function() {
	// contacts
	SEC.contactsContextMenu = new YAHOO.widget.ContextMenu("contactsMenu", {
		trigger: "contacts",
		lazyload: true
	});
	SEC.contactsContextMenu.addItems([
		{
			text: app_strings.LBL_EMAIL_MENU_REMOVE,
			onclick:{ fn: DOTB.email2.addressBook.removeContact }
		},
		{
			text: app_strings.LBL_EMAIL_MENU_COMPOSE,
			onclick:{ fn: function() {DOTB.email2.addressBook.composeTo('contacts')}}
		}
	]);
	SEC.contactsContextMenu.subscribe("beforeShow", function() {
		var oTarget = this.contextEventTarget, grid = DOTB.email2.contactView;
		if (oTarget && !grid.isSelected(oTarget)) {
			grid.unselectAllRows();
			grid.selectRow(oTarget);
		}
	});
	SEC.contactsContextMenu.render();
	}
	
	SEC.initListsMenu = function() {
	// contact mailing lists
	SEC.mailingListContextMenu = new YAHOO.widget.ContextMenu("listsMenu", {
		trigger: "lists",
		lazyload: true
	});
	
	SEC.mailingListContextMenu.addItems([
		{
			text: app_strings.LBL_EMAIL_MENU_REMOVE,
			onclick:{ fn: DOTB.email2.addressBook.removeMailingList }
		},
		{
			text: app_strings.LBL_EMAIL_MENU_COMPOSE,
			onclick:{ fn:function() {DOTB.email2.addressBook.composeTo('lists')} }
		},
        {
            text: app_strings.LBL_EMAIL_MENU_RENAME,
            onclick:{ fn: function() { DOTB.showMessageBox(app_strings.LBL_EMAIL_LIST_RENAME_TITLE, app_strings.LBL_EMAIL_LIST_RENAME_DESC,
             'prompt', {fn: DOTB.email2.addressBook.renameMailingList}); } }
        }
	]);
	
	SEC.mailingListContextMenu.subscribe("beforeShow", function() {
		var oTarget = this.contextEventTarget, grid = DOTB.email2.emailListsView;
		if (oTarget && !grid.isSelected(oTarget)) {
			grid.unselectAllRows();
			grid.selectRow(oTarget);
		}
	});
	
	SEC.mailingListContextMenu.render();
	}
	
	// set auto-check timer
	DOTB.email2.folders.startCheckTimer();
	// check if we're coming from an email-link click
	setTimeout("DOTB.email2.composeLayout.composePackage()", 2000);
	
	YAHOO.util.Event.on(window, 'resize', DOTB.email2.autoSetLayout);
	
	//Init fix for YUI 2.7.0 datatable sort.
	DOTB.email2.addressBook.initFixForDatatableSort();
}

function createTreePanel(treeData, params) {
	var tree = new YAHOO.widget.TreeView(params.id);
	var root = tree.getRoot();
	
	return tree;
}

function addChildNodes(parentNode, parentData) {
	var Ck = YAHOO.util.Cookie;
	var nextyear = DOTB.email2.nextYear;
	var nodes = parentData.nodes || parentData.children;
	for (i in nodes) {
		if (typeof(nodes[i]) == 'object') {
			if (nodes[i].data) {
				var node = new YAHOO.widget.TextNode(nodes[i].data, parentNode);
				node.action = nodes[i].data.action;
			} else {
				if (nodes[i].id == DOTB.language.get('app_strings','LBL_EMAIL_HOME_FOLDER')) {
					addChildNodes(parentNode, nodes[i]);
					return;
				}
				nodes[i].expanded = Ck.getSub("EmailTreeLayout", nodes[i].id + "") == "true";
				Ck.setSub("EmailTreeLayout", nodes[i].id + "", nodes[i].expanded ? true : false, {expires: DOTB.email2.nextYear});
				if (nodes[i].cls) {
					nodes[i].className = nodes[i].cls;
				}
				
				// URL Decode the text, so it shows properly
				nodes[i].text = unescape(nodes[i].text);
				
				if (nodes[i].text) nodes[i].label = nodes[i].text;
				//Override YUI child node creation
				if (nodes[i].children) {
					nodes[i].nodes = nodes[i].children;
					nodes[i].children = [ ];
				}
				var node = new YAHOO.widget.TextNode(nodes[i], parentNode);
			}
			
			if (typeof(nodes[i].nodes) == 'object') {
				addChildNodes(node, nodes[i]);
			}
		}
	}
}

/**
 * Custom TreeView initialization sequence to setup DragDrop targets for every tree node
 */
function email2treeinit(tree, treedata, treediv, params) {
	//ensure the tree data is not corrupt
	if (!treedata) {
	   return;
	}
	if (DOTB.email2.tree) {
		DOTB.email2.tree.destroy();
		DOTB.email2.tree = null;
	}
	
	var tree = DOTB.email2.tree = createTreePanel({nodes : {}}, {
		id: 'emailtree'
	});
	
	tree.subscribe("clickEvent", DOTB.email2.folders.handleClick);
	tree.subscribe("collapseComplete", function(node){YAHOO.util.Cookie.setSub("EmailTreeLayout", node.data.id + "", false, {expires: DOTB.email2.nextYear});});
	tree.subscribe("expandComplete", function(node){
		YAHOO.util.Cookie.setSub("EmailTreeLayout", node.data.id + "", true, {expires: DOTB.email2.nextYear});
		for (var i in node.children) {
			SE.accounts.setupDDTarget(node.children[i]);
		}
	});
	tree.setCollapseAnim("TVSlideOut");
	tree.setExpandAnim("TVSlideIn");
	var root = tree.root;
	while (root.hasChildren()) {
		var node = root.children[0];
		node.destroy();
		tree.removeNode(root.children[0], false);
	}
	addChildNodes(root, treedata);
	tree.render();
	DOTB.email2.accounts.renderTree();
}

DOTB.email2.folders.folderDD = function(id, sGroup, config) {
	DOTB.email2.folders.folderDD.superclass.constructor.call(this, id, sGroup, config);
};


YAHOO.extend(DOTB.email2.folders.folderDD, YAHOO.util.DDProxy, {    
    startDrag: function(x, y) {
		var Dom = YAHOO.util.Dom;	
		this.dragNode = DOTB.email2.tree.getNodeByElement(this.getEl());
		
		this.dragId = "";
		var dragEl = this.getDragEl();  
        var clickEl = this.getEl(); 
        Dom.setStyle(clickEl, "color", "#AAA");
        Dom.setStyle(clickEl, "opacity", "0.25"); 
        dragEl.innerHTML = clickEl.innerHTML; 
    	 
        Dom.addClass(dragEl, "ygtvcell");
        Dom.addClass(dragEl, "ygtvcontent");
        Dom.addClass(dragEl, "folderDragProxy");
        Dom.setStyle(dragEl, "height", (clickEl.clientHeight - 5) + "px");
        Dom.setStyle(dragEl, "width", (clickEl.clientWidth - 5) + "px");
        Dom.setStyle(dragEl, "backgroundColor", "#FFF"); 
        Dom.setStyle(dragEl, "opacity", "0.5"); 
  	    Dom.setStyle(dragEl, "border", "1px solid #AAA");
    },
    
    onDragOver: function(ev, id) {
    	var Dom = YAHOO.util.Dom;
    	if (id != this.dragId)
    	{
    		var node = DOTB.email2.tree.getNodeByElement(YAHOO.util.Dom.get(id));
    		if(node.data.cls != "dotbFolder") {
    			DOTB.email2.folders.unhighliteAll();
    			return;
    		}
    		this.dragId = id;
    		this.targetNode = node;
    		DOTB.email2.folders.unhighliteAll();
    		node.highlight();
    	}
    },
    
    onDragOut: function(e, id) {
    	if (this.targetNode) {
    		DOTB.email2.folders.unhighliteAll();
    		this.targetNode = false;
    		this.dragId = false;
    	}
    },
    
    endDrag: function() { 
    	YAHOO.util.Dom.setStyle(this.getEl(), "opacity", "1.0");
    	if (this.targetNode) {
    		DOTB.email2.folders.moveFolder(this.dragNode.data.id, this.targetNode.data.id);
    	}
    }
});
