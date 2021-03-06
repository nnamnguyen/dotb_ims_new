

initMyDotb = function(){
DOTB.myDotb = function() {
	var originalLayout = null;
	var configureDashletId = null;
	var currentDashlet = null;
	var leftColumnInnerHTML = null;
	var leftColObj = null;
	var maxCount;
	var warningLang;

    var closeDashletsDialogTimer = null;
	
	var num_pages = numPages;
	var activeTab = activePage;
	var current_user = current_user_id;
	
	var module = moduleName;
	var cookiePageIndex;
	
	var charts = new Object();
	
	if (module == 'Dashboard'){
		cookiePageIndex = current_user + "_activeDashboardPage";
	}
	else{
		cookiePageIndex = current_user + "_activePage";
	}
	
	var homepage_dd;
	
	var populatedReportCharts = false;

	return {
		togglePages: function(activePage){
		    var pageId = 'pageNum_' + activePage;
		    activeDashboardPage = activePage;
		    activeTab = activePage;
		
		    Set_Cookie(cookiePageIndex,activePage,3000,false,false,false);
		    
		    //hide all pages first for display purposes
		    for(var i=0; i < num_pages; i++){
		        var pageDivId = 'pageNum_'+i+'_div';
		        var pageDivElem = document.getElementById(pageDivId);
		        pageDivElem.style.display = 'none';
		    }
		
		    for(var i=0; i < num_pages; i++){
		        var tabId = 'pageNum_'+i;
		        var anchorId = 'pageNum_'+i+'_anchor';
		        var pageDivId = 'pageNum_'+i+'_div';
		
		        var tabElem = document.getElementById(tabId);
		        var anchorElem = document.getElementById(anchorId);
		        var pageDivElem = document.getElementById(pageDivId);

		        if(tabId == pageId){
		            if(!DOTB.myDotb.pageIsLoaded(pageDivId))
		                DOTB.myDotb.retrievePage(i);
		
		            tabElem.className = 'active';
		            anchorElem.className = 'current';
		            pageDivElem.style.display = 'inline';
		        }
		        else{
		            tabElem.className = '';
		            anchorElem.className = '';
		        }
		    }
		},
		
        deletePage: function(){
            var pageNum = activeTab;
            var tabListElem = document.getElementById('tabList');
            var removeResult = '';

            if(confirm(DOTB.language.get('app_strings', 'LBL_DELETE_PAGE_CONFIRM')))
                window.location = "index.php?module="+module+"&action=DynamicAction&DynamicAction=deletePage&pageNumToDelete="+pageNum;
        },

		renamePage: function(pageNum){
		    DOTB.myDotb.toggleSpansForRename(pageNum);
		    document.getElementById('pageNum_'+pageNum+'_name_input').focus();
		},
		
		toggleSpansForRename: function(pageNum){
		    var tabInputSpan = document.getElementById('pageNum_'+pageNum+'_input_span');
		    var tabLinkSpan = document.getElementById('pageNum_'+pageNum+'_link_span');
		
		    if(tabLinkSpan.style.display == 'none'){
		        tabLinkSpan.style.display = 'inline';
		        tabInputSpan.style.display = 'none';
		    }
		    else{
		        tabLinkSpan.style.display = 'none';
		        tabInputSpan.style.display = 'inline';
		    }
		},
		
        savePageTitle: function(pageNum,newTitleValue)
        {
            var currentTitleValue = document.getElementById('pageNum_'+pageNum+'_name_hidden_input').value;

			if(newTitleValue == ''){
				newTitleValue = currentTitleValue;
				alert(DOTB.language.get('app_strings', 'ERR_BLANK_PAGE_NAME'));
			}
            else if(newTitleValue != currentTitleValue)
            {
                ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_SAVING_PAGE_TITLE'));

                url = 'index.php?DynamicAction=savePageTitle&action=DynamicAction&module='+module+'&to_pdf=1&newPageTitle='+YAHOO.lang.JSON.stringify(newTitleValue)+'&pageId='+pageNum;

                var setPageTitle = function(data)
                {
                    var pageTextSpan = document.getElementById('pageNum_'+pageNum+'_title_text');
                    
                    pageTextSpan.innerHTML = data.responseText;
                    document.getElementById('pageNum_'+pageNum+'_name_input').value = data.responseText;
                    document.getElementById('pageNum_'+pageNum+'_name_hidden_input').value = data.responseText;
                    loadedPages.splice(pageNum,1);
                    ajaxStatus.hideStatus();
                }
                var cObj = YAHOO.util.Connect.asyncRequest('GET', url, {success: setPageTitle, failure: setPageTitle}, null);
            }

			var pageTextSpan = document.getElementById('pageNum_'+pageNum+'_title_text');
            pageTextSpan.innerHTML = YAHOO.lang.escapeHTML(newTitleValue);

            DOTB.myDotb.toggleSpansForRename(pageNum);
        },

		pageIsLoaded: function(pageDivId){
		    for(var count=0; count < loadedPages.length; count++)
		    {
		        if(loadedPages[count] == pageDivId)
		            return true;
		    }
		    return false;
		},
		
		retrieveChartDashlet: function(name, xmlFile, width, height){
			var chartDiv = document.getElementById(name + '_div');
			
			chartDiv.style.width = width;
			chartDiv.style.height = height;
		},
		

        retrievePage: function(pageNum){
			if (document.getElementById('loading_c'))
                document.getElementById('loading_c').style.display = '';
			DOTB.myDotb.loading.show();

            var pageCount = num_pages;
            var addPageElem = document.getElementById('add_page');
            var tabListElem = document.getElementById('tabList');

            url = 'index.php?action=DynamicAction&DynamicAction=retrievePage&module='+module+'&to_pdf=1&pageId='+pageNum;

            var populatePage = function(data) {
                var response = {html:"", script:""};
                try {
                    response = YAHOO.lang.JSON.parse(data.responseText);
                }
                catch(e){
                    if (typeof(console) != "undefined" && typeof(console.log) == "function")
                        console.log(e);
                }
                var htmlRepsonse = response['html'];
                var scriptResponse = JSON.parse(response.script);
                
                var pageDivElem = document.getElementById('pageNum_'+pageNum+'_div');

                pageDivElem.innerHTML = htmlRepsonse;
                loadedPages[loadedPages.length] = 'pageNum_'+pageNum+'_div';
                
                //-------------------------------------------------------------------------
                //-------------------start new registration for drag drop--------------------
                var counter = DOTB.myDotb.homepage_dd.length;

                if(YAHOO.util.DDM.mode == 1 && typeof(scriptResponse) != 'undefined') {
                    for(i in scriptResponse['newDashletsToReg']) {
                        DOTB.myDotb.homepage_dd[counter] = new ygDDList('dashlet_' + scriptResponse['newDashletsToReg'][i]);
                        DOTB.myDotb.homepage_dd[counter].setHandleElId('dashlet_header_' + scriptResponse['newDashletsToReg'][i]);
                        DOTB.myDotb.homepage_dd[counter].onMouseDown = DOTB.myDotb.onDrag;
                        DOTB.myDotb.homepage_dd[counter].afterEndDrag = DOTB.myDotb.onDrop;
                        counter++;
                    } 
                }


                			
                //custom chart code
				DOTB.myDotb.dotbCharts.addToChartsArrayJson(scriptResponse['chartsArray'],pageNum);
				
				
                if(YAHOO.util.DDM.mode == 1) {
                    for(var wp = 0; wp < scriptResponse['numCols']; wp++) {
                        DOTB.myDotb.homepage_dd[counter++] = new ygDDListBoundary('page_'+pageNum+'_hidden' + wp);
                    }
                }
                //-------------------end new registration for drag drop--------------------
                //-------------------------------------------------------------------------

                ajaxStatus.hideStatus();
			   	if(scriptResponse['trackerScript']){
					DOTB.util.evalScript(scriptResponse['trackerScript']);
					if(typeof(trackerGridArray) != 'undefined' && trackerGridArray.length > 0) {
					   for(x in trackerGridArray) {
				          if(typeof(trackerGridArray[x]) != 'function') {
					          trackerDashlet = new TrackerDashlet();
					          trackerDashlet.init(trackerGridArray[x]);
				          }
					   }
					}
				}
				if(scriptResponse['dashletScript']){
					DOTB.util.evalScript(scriptResponse['dashletScript']);	
				}
				if(scriptResponse['toggleHeaderToolsetScript']){
					DOTB.util.evalScript(scriptResponse['toggleHeaderToolsetScript']);	
				}
				if(scriptResponse['dashletCtrl']){
					DOTB.util.evalScript(scriptResponse['dashletCtrl']);			
				}
				//custom chart code
                DOTB.myDotb.dotbCharts.loadDotbCharts(pageNum);
                
                DOTB.util.evalScript(htmlRepsonse);
                
                //refresh page when user resizes window


				DOTB.myDotb.loading.hide();                                                  
				if (document.getElementById('loading_c'))
                    document.getElementById('loading_c').style.display = 'none';
            }

            var cObj = YAHOO.util.Connect.asyncRequest('GET', url,
                                                  {success: populatePage, failure: populatePage}, null);                                                 


        },
        
        showAddPageDialog: function(){
            if ( document.getElementById('addPageDialog_c') == null ) { setTimeout(DOTB.myDotb.showAddPageDialog,100); return false; }
			document.getElementById('addPageDialog_c').style.display = '';
        	DOTB.myDotb.addPageDialog.show();        	
			DOTB.myDotb.addPageDialog.configFixedCenter(null, false) ;
        },
        
		addTab: function(newPageName,numCols){
			var pageCount = num_pages;
			var tabListElem = document.getElementById('tabList');
			var addPageElem = document.getElementById('add_page');
			var dashletCtrlsElem = document.getElementById('dashletCtrls');
			var contentElem = document.getElementById('content');
			var tabListContainerElem = document.getElementById('tabListContainer');
			var contentElemWidth = contentElem.offsetWidth - 3;
			var addPageElemWidth = addPageElem.offsetWidth + 2;
			var dashletCtrlsElemWidth = dashletCtrlsElem.offsetWidth;
			var tabListElemWidth = tabListElem.offsetWidth;
			var maxWidth = contentElemWidth-(dashletCtrlsElemWidth+addPageElemWidth+2);

			url = 'index.php?DynamicAction=addPage&action=DynamicAction&module='+module+'&to_pdf=1&numCols='+numCols+'&pageName='+YAHOO.lang.JSON.stringify(newPageName);

			var addBlankPage = function(data) {
				//check to see if a user preference error occurred
				
			    var pageContainerDivElem = document.getElementById('pageContainer');
			    var newPageId = 'pageNum_' + pageCount + '_div';
			    var newPageDivElem = document.createElement('div');
			
			    newPageDivElem.id = newPageId;
			    newPageDivElem.innerHTML = data.responseText;
			    newPageDivElem.style.display = 'none';
			
			    pageContainerDivElem.insertBefore(newPageDivElem,document.getElementById('addPageDialog_c'));
			    loadedPages[num_pages] = newPageDivElem.id;
			
			    ajaxStatus.hideStatus();		    
			    
                ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_NEW_PAGE_FEEDBACK'));
                window.setTimeout('ajaxStatus.hideStatus()', 7500);
				
				var new_tab = document.createElement("li");
				new_tab.id = 'pageNum_' + num_pages;
				
				var new_anchor = document.createElement("a");
				new_anchor.id = 'pageNum_' + num_pages + '_anchor';
				new_anchor.className = 'active';
				new_anchor.href = "javascript:DOTB.myDotb.togglePages('" + num_pages + "');"
				
				newPageName = newPageName.replace(/\\'/g,"'"); // Takes out the escaped quotes like \"

				new_anchor.appendChild(DOTB.myDotb.insertInputSpanElement(num_pages, newPageName));
				new_anchor.appendChild(DOTB.myDotb.insertTabNameDisplay(num_pages, newPageName));

				var new_delete_img = document.createElement("img");
				new_delete_img.id = 'pageNum_' + num_pages + '_delete_page_img';
				new_delete_img.className = 'deletePageImg';
				new_delete_img.style.display = 'none';
				new_delete_img.onclick = function() {return DOTB.myDotb.deletePage();};
				new_delete_img.src = 'index.php?entryPoint=getImage&imageName=info-del.png';
				new_delete_img.border = 0;
				new_delete_img.align = 'absmiddle';

				new_anchor.appendChild(new_delete_img);

				new_tab.appendChild(new_anchor);
				tabListElem.appendChild(new_tab);
				if(tabListElemWidth + new_tab.offsetWidth > maxWidth) {
						tabListContainerElem.style.width = maxWidth+"px";
						tabListElem.style.width = tabListElemWidth + new_tab.offsetWidth+"px";
						tabListContainerElem.setAttribute("className","active yui-module yui-scroll");
						tabListContainerElem.setAttribute("class","active yui-module yui-scroll");
					}

				num_pages = num_pages + 1;			
				
                DOTB.myDotb.togglePages(pageCount);
			}

            ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_CREATING_NEW_PAGE'));
			var cObj = YAHOO.util.Connect.asyncRequest('GET', url,
                                                   {success: addBlankPage, failure: addBlankPage} , null);
		
		},
		
		insertInputSpanElement: function(page_num, pageName){
			var inputSpanElement = document.createElement("span");
			inputSpanElement.id = 'pageNum_'+page_num+'_input_span';
			inputSpanElement.style.display = 'none';
			var subInputSpanElement1 = document.createElement("input");
			subInputSpanElement1.id = 'pageNum_'+page_num+'_name_hidden_input';
			subInputSpanElement1.type = 'hidden';
			subInputSpanElement1.value = pageName;
			
			inputSpanElement.appendChild(subInputSpanElement1);
			
			var subInputSpanElement2 = document.createElement("input");
			subInputSpanElement2.id = 'pageNum_'+page_num+'_name_input';
			subInputSpanElement2.type = 'text';
			subInputSpanElement2.size = '10';
			subInputSpanElement2.value = pageName;
			subInputSpanElement2.onblur = function(){
				return DOTB.myDotb.savePageTitle(page_num, this.value);
			}
			
			inputSpanElement.appendChild(subInputSpanElement2);
			
			return inputSpanElement;
		},
		
		insertTabNameDisplay: function(page_num, pageName){
			var spanElement = document.createElement("span");
			spanElement.id = 'pageNum_'+page_num+'_link_span';
			var subSpanElement = document.createElement("span");
			subSpanElement.id = 'pageNum_'+page_num+'_title_text';
			subSpanElement.ondblclick = function(){
				return DOTB.myDotb.renamePage(page_num);
			}
			
			var textNode = document.createTextNode(pageName);
			subSpanElement.appendChild(textNode);
			spanElement.appendChild(subSpanElement);
			
			return spanElement;
		},
				
		showChangeLayoutDialog: function(tabNum){
			document.getElementById('changeLayoutDialog_c').style.display = '';
			DOTB.myDotb.changeLayoutDialog.show();
			DOTB.myDotb.changeLayoutDialog.configFixedCenter(null, false) ;			
		},
		
		// get the current dashlet layout
		getLayout: function(asString) {
			columns = new Array();
			for(je = 0; je < 3; je++) {
			    dashlets = document.getElementById('col_'+activeTab+'_'+ je);
			    		    
				if (dashlets != null){
				    dashletIds = new Array();
				    for(wp = 0; wp < dashlets.childNodes.length; wp++) {
				      if(typeof dashlets.childNodes[wp].id != 'undefined' && dashlets.childNodes[wp].id.match(/dashlet_[\w-]*/)) {
						dashletIds.push(dashlets.childNodes[wp].id.replace(/dashlet_/,''));
				      }
				    }
					if(asString) 
						columns[je] = dashletIds.join(',');
					else 
						columns[je] = dashletIds;
				}
			}

			if(asString) return columns.join('|');
			else return columns;
		},

		// called when dashlet is picked up
		onDrag: function(e, id) {
			originalLayout = DOTB.myDotb.getLayout(true);   	
		},
		
		// called when dashlet is dropped
		onDrop: function(e, id) {	
			newLayout = DOTB.myDotb.getLayout(true);
		  	if(originalLayout != newLayout) { // only save if the layout has changed
				DOTB.myDotb.saveLayout(newLayout);
				DOTB.myDotb.dotbCharts.loadDotbCharts(); // called safely because there is a check to be sure the array exists
		  	}
		},
		
		// save the layout of the dashlet  
		saveLayout: function(order) {
			ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_SAVING_LAYOUT'));
			var success = function(data) {
				ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_SAVED_LAYOUT'));
				window.setTimeout('ajaxStatus.hideStatus()', 2000);
			}

            YAHOO.util.Connect.asyncRequest('POST', 'index.php?' + DOTB.util.paramsToUrl({
                    'module': module,
                    'action': 'DynamicAction',
                    'DynamicAction': 'saveLayout',
                    'selectedPage': activeTab,
                    'to_pdf': 1
                }), {
                success: success,
                failure: success
            }, DOTB.util.paramsToUrl({
                'layout': order
            }));
		},

		changeLayout: function(numCols) {
			ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_SAVING_LAYOUT'));

			var success = function(data) {
				ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_SAVED_LAYOUT'));
				window.setTimeout('ajaxStatus.hideStatus()', 2000);
				
				var pageNum = data.responseText;
				DOTB.myDotb.retrievePage(pageNum);
			}
			
			url = 'index.php?to_pdf=1&module='+module+'&action=DynamicAction&DynamicAction=changeLayout&selectedPage=' + activeTab + '&numColumns=' + numCols;
			var cObj = YAHOO.util.Connect.asyncRequest('GET', url, {success: success, failure: success});					  
		},

		uncoverPage: function(id) {
			if (!DOTB.isIE){	
				document.getElementById('dlg_c').style.display = 'none';	
			}		
			configureDlg.hide();
            if ( document.getElementById('dashletType') == null ) {
                dashletType = '';
            } else {
                dashletType = document.getElementById('dashletType').value;
            }
			DOTB.myDotb.retrieveDashlet(DOTB.myDotb.configureDashletId, dashletType);
		},
		
		// call to configure a Dashlet
		configureDashlet: function(id) {
			ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_LOADING'));
			configureDlg = new YAHOO.widget.SimpleDialog("dlg", 
				{ visible:false, 
				  width:"510", 
				  effect:[{effect:YAHOO.widget.ContainerEffect.FADE,duration:0.5}],
				  fixedcenter:true, 
				  modal:true, 
				  draggable:false }
			);
			
			fillInConfigureDiv = function(data){
				ajaxStatus.hideStatus();
				var result = JSON.parse(data.responseText);
				if (typeof result == 'undefined' || typeof result['header'] == 'undefined') {
					result = new Array();
					result['header'] = 'error';
					result['body'] = 'There was an error handling this request.';
				}
				configureDlg.setHeader(result['header']);
				configureDlg.setBody(result['body']);
				var listeners = new YAHOO.util.KeyListener(document, { keys : 27 }, {fn: function() {this.hide();}, scope: configureDlg, correctScope:true} );
				configureDlg.cfg.queueProperty("keylisteners", listeners);

				configureDlg.render(document.body);
				configureDlg.show();
				configureDlg.configFixedCenter(null, false) ;
				DOTB.util.evalScript(result['body']);
			}

			DOTB.myDotb.configureDashletId = id; // save the id of the dashlet being configured
			var cObj = YAHOO.util.Connect.asyncRequest('GET','index.php?to_pdf=1&module='+module+'&action=DynamicAction&DynamicAction=configureDashlet&id=' + id, 
													  {success: fillInConfigureDiv, failure: fillInConfigureDiv}, null);
		},
		
		configureChartDashlet: function(id, report_id){
			window.location = "index.php?module=Reports&id=" + report_id + "&action=index&page=report";
		},
				
		/** returns dashlets contents
		 * if url is defined, dashlet will be retrieve with it, otherwise use default url
		 *
		 * @param string id id of the dashlet to refresh
		 * @param string url url to be used
		 * @param function callback callback function after refresh
		 * @param bool dynamic does the script load dynamic javascript, set to true if you user needs to refresh the dashlet after load
		 */
		retrieveDashlet: function(id, url, callback, dynamic) {
			ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_LOADING'));
					
			if(!url) {
				url = 'index.php?action=DynamicAction&DynamicAction=displayDashlet&session_commit=1&module='+module+'&to_pdf=1&id=' + id;
				is_chart_dashlet = false;
			}
			else if (url == 'predefined_chart'){
				url = 'index.php?action=DynamicAction&DynamicAction=displayDashlet&session_commit=1&module='+module+'&to_pdf=1&id=' + id;
				scriptUrl = 'index.php?action=DynamicAction&DynamicAction=getPredefinedChartScript&session_commit=1&module='+module+'&to_pdf=1&id=' + id;
				is_chart_dashlet = true;
			}
			
			else if (url == 'chart'){
				url = 'index.php?action=DynamicAction&DynamicAction=displayChartDashlet&session_commit=1&module='+module+'&to_pdf=1&id=' + id;
				scriptUrl = 'index.php?action=DynamicAction&DynamicAction=getChartScript&session_commit=1&module='+module+'&to_pdf=1&id=' + id;
				is_chart_dashlet = true;
			}
			
			if(dynamic) {
				url += '&dynamic=true';
			}

		 	var fillInDashlet = function(data) {
                var bwc;
		 		ajaxStatus.hideStatus();
				if(data) {
                    
                    // before we refresh, lets make sure that the returned data is for the current dashlet in focus
                    // AND that it is not the initial 'please reload' verbage, start by grabbing the current dashlet id
                    current_dashlet_id = DOTB.myDotb.currentDashlet.getAttribute('id');

                    //lets extract the guid portion of the id, to use as a reference
                    dashlet_guid =  current_dashlet_id.substr('dashlet_entire'.length);

                    //now that we have the guid portion, let's search the returned text for it.  There should be many references to it.
                    if(data.responseText.indexOf(dashlet_guid)<0 &&  data.responseText != DOTB.language.get('app_strings', 'LBL_RELOAD_PAGE') ){
                        //guid id was not found in the returned html, that means we have stale dashlet info due to an auto refresh, do not update
                        return false;
                    }
					DOTB.myDotb.currentDashlet.innerHTML = data.responseText;			

                    try {
                        bwc = parent.DOTB.App.controller.layout.getComponent("bwc");
                    } catch (e) {}

                    if (bwc) {
                        $("a", DOTB.myDotb.currentDashlet).each(function() {
                            bwc.convertToLumiaLink(this);
                        });
                    }
				}

				DOTB.util.evalScript(data.responseText);
				if(callback) callback();
				
				var processChartScript = function(scriptData){
					DOTB.util.evalScript(scriptData.responseText);
					//custom chart code
					DOTB.myDotb.dotbCharts.loadDotbCharts(activePage);

				}
				if(typeof(is_chart_dashlet)=='undefined'){
					is_chart_dashlet = false;
				}
				if (is_chart_dashlet){				
					var chartScriptObj = YAHOO.util.Connect.asyncRequest('GET', scriptUrl,
													  {success: processChartScript, failure: processChartScript}, null);
				}
				DOTB.myDotb.attachToggleToolsetEvent(id);

                //we need to reinit the quickEdit Listeners whenever a dashlet is refreshed
                if(typeof(qe_init) =='function'){
                    //reinitialize the Quick Edit events
                    qe_init();
                }
			}
			
			DOTB.myDotb.currentDashlet = document.getElementById('dashlet_entire_' + id);
			var cObj = YAHOO.util.Connect.asyncRequest('GET', url,
			                    {success: fillInDashlet, failure: fillInDashlet}, null); 
			return false;
		},
		
		// for the display columns widget
		setChooser: function() {		
			var displayColumnsDef = new Array();
			var hideTabsDef = new Array();

		    var left_td = document.getElementById('display_tabs_td');	
		    var right_td = document.getElementById('hide_tabs_td');			
	
		    var displayTabs = left_td.getElementsByTagName('select')[0];
		    var hideTabs = right_td.getElementsByTagName('select')[0];
			
			for(i = 0; i < displayTabs.options.length; i++) {
				displayColumnsDef.push(displayTabs.options[i].value);
			}
			
			if(typeof hideTabs != 'undefined') {
				for(i = 0; i < hideTabs.options.length; i++) {
			         hideTabsDef.push(hideTabs.options[i].value);
				}
			}
			
			document.getElementById('displayColumnsDef').value = displayColumnsDef.join('|');
			document.getElementById('hideTabsDef').value = hideTabsDef.join('|');
		},
		
		deleteDashlet: function(id) {
			if(confirm(DOTB.language.get('app_strings', 'LBL_REMOVE_DASHLET_CONFIRM'))) {
				ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_REMOVING_DASHLET'));
				
				del = function() {
					var success = function(data) {
						dashlet = document.getElementById('dashlet_' + id);
						dashlet.parentNode.removeChild(dashlet);
						ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_REMOVED_DASHLET'));
						window.setTimeout('ajaxStatus.hideStatus()', 2000);
					}
				
					
					var cObj = YAHOO.util.Connect.asyncRequest('GET','index.php?to_pdf=1&module='+module+'&action=DynamicAction&DynamicAction=deleteDashlet&activePage=' + activeTab + '&id=' + id, 
															  {success: success, failure: success}, null);
				}
				
				var anim = new YAHOO.util.Anim('dashlet_entire_' + id, { height: {to: 1} }, .5 );					
				anim.onComplete.subscribe(del);					
				document.getElementById('dashlet_entire_' + id).style.overflow = 'hidden';
				anim.animate();
				
				return false;
			}
			return false;
		},
		
		
		addDashlet: function(id, type, type_module) {
			ajaxStatus.hideStatus();
			columns = DOTB.myDotb.getLayout();
						
			var num_dashlets = columns[0].length;
			if (typeof columns[1] == undefined){
				num_dashlets = num_dashlets + columns[1].length;
			}
			
			if((num_dashlets) >= DOTB.myDotb.maxCount) {
				alert(DOTB.language.get('app_strings', 'LBL_MAX_DASHLETS_REACHED'));
				return;
			}			
			ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_ADDING_DASHLET'));
			var success = function(data) {

				colZero = document.getElementById('col_'+activeTab+'_0');
				newDashlet = document.createElement('li'); // build the list item
				newDashlet.id = 'dashlet_' + data.responseText;
				newDashlet.className = 'noBullet active';
				// hide it first, but append to getRegion
                var div = document.createElement("div");
                div.style = "position: absolute; top: -1000px; overflow: hidden";
                div.id = "dashlet_entire_" + data.responseText;
                newDashlet.appendChild(div);

				colZero.insertBefore(newDashlet, colZero.firstChild); // insert it into the first column
				
				var finishRetrieve = function() {
					dashletEntire = document.getElementById('dashlet_entire_' + data.responseText);
					dd = new ygDDList('dashlet_' + data.responseText); // make it draggable
					dd.setHandleElId('dashlet_header_' + data.responseText);
                    // Bug #47097 : Dashlets not displayed after moving them
                    // add new property to save real id of dashlet, it needs to have ability reload dashlet by id
                    dd.dashletID = data.responseText;
					dd.onMouseDown = DOTB.myDotb.onDrag;  
					dd.onDragDrop = DOTB.myDotb.onDrop;

					ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_ADDED_DASHLET'));
					dashletRegion = YAHOO.util.Dom.getRegion(dashletEntire);
					dashletEntire.style.position = 'relative';
					dashletEntire.style.height = '1px';
					dashletEntire.style.top = '0px';
					dashletEntire.className = 'dashletPanel';
					
					DOTB.myDotb.attachToggleToolsetEvent(data.responseText);
					
					var anim = new YAHOO.util.Anim('dashlet_entire_' + data.responseText, { height: {to: dashletRegion.bottom - dashletRegion.top} }, .5 );
					anim.onComplete.subscribe(function() { document.getElementById('dashlet_entire_' + data.responseText).style.height = '100%'; });	
					anim.animate();
					
					newLayout =	DOTB.myDotb.getLayout(true);
					DOTB.myDotb.saveLayout(newLayout);	
				}
				
				if (type == 'module' || type == 'web'){
					url = null;
					type = 'module';
				}
				else if (type == 'predefined_chart'){
					url = 'predefined_chart';
					type = 'predefined_chart';
				}
				else if (type == 'chart'){
					url = 'chart';
					type = 'chart';
				}
				
				DOTB.myDotb.retrieveDashlet(data.responseText, url, finishRetrieve, true); // retrieve it from the server
			}

            YAHOO.util.Connect.asyncRequest('POST', 'index.php?' + DOTB.util.paramsToUrl({
                'module': module,
                'action': 'DynamicAction',
                'DynamicAction': 'addDashlet',
                'activeTab': activeTab,
                'id': id,
                'to_pdf': 1
            }), {
                success: success,
                failure: success
            }, DOTB.util.paramsToUrl({
                'type': type,
                'type_module': type_module
            }));

			return false;
		},
		
		showDashletsDialog: function() {                                             
			columns = DOTB.myDotb.getLayout();

            if (this.closeDashletsDialogTimer != null) {
                window.clearTimeout(this.closeDashletsDialogTimer);
            }

			var num_dashlets = 0;
            var i = 0;
            for ( i = 0 ; i < 3; i++ ) {
                if (typeof columns[i] != "undefined") {
                    num_dashlets = num_dashlets + columns[i].length;
                }
            }
			
			if((num_dashlets) >= DOTB.myDotb.maxCount) {
				alert(DOTB.language.get('app_strings', 'LBL_MAX_DASHLETS_REACHED'));
				return;
			}
			ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_LOADING'));
			
			var success = function(data) {		
				var response = JSON.parse(data.responseText);
				dashletsListDiv = document.getElementById('dashletsList');
				dashletsListDiv.innerHTML = response['html'];
				
				document.getElementById('dashletsDialog_c').style.display = '';
                DOTB.myDotb.dashletsDialog.show();

                if (YAHOO.env.ua.ie > 5 && YAHOO.env.ua.ie < 7) {
                    document.getElementById('dashletsList').style.width = '430px';
                    document.getElementById('dashletsList').style.overflow = 'hidden';
                }
                
                if (response['populateCharts'] == true) {
                    DOTB.myDotb.populateReportCharts();
                }

				ajaxStatus.hideStatus();
			}
			
			var cObj = YAHOO.util.Connect.asyncRequest('GET', 'index.php?to_pdf=true&module='+module+'&action=DynamicAction&DynamicAction=dashletsDialog', {success: success, failure: success});			
			return false;
		},
		
		closeDashletsDialog: function(){
			DOTB.myDotb.dashletsDialog.hide();
			if (this.closeDashletsDialogTimer != null) {
                window.clearTimeout(this.closeDashletsDialogTimer);
            }
            this.closeDashletsDialogTimer = window.setTimeout("document.getElementById('dashletsDialog_c').style.display = 'none';", 2000);
			populatedReportCharts = false;
		},

		toggleDashletCategories: function(category){
			document.getElementById('search_string').value = '';
			document.getElementById('searchResults').innerHTML = '';
			
			var moduleTab = document.getElementById('moduleCategory');
			var moduleTabAnchor = document.getElementById('moduleCategoryAnchor');
			var moduleListDiv = document.getElementById('moduleDashlets');

			var chartTab = document.getElementById('chartCategory');
			var chartTabAnchor = document.getElementById('chartCategoryAnchor');			
			var chartListDiv = document.getElementById('chartDashlets');			
			
			var toolsTab = document.getElementById('toolsCategory');
			var toolsTabAnchor = document.getElementById('toolsCategoryAnchor');			
			var toolsListDiv = document.getElementById('toolsDashlets');	
			
			var webTab = document.getElementById('webCategory');
			var webTabAnchor = document.getElementById('webCategoryAnchor');			
			var webListDiv = document.getElementById('webDashlets');	
			
			switch(category){
				case 'module':
					moduleTab.className = 'active';
					moduleTabAnchor.className = 'current';
					moduleListDiv.style.display = '';
					
					chartTab.className = '';
					chartTabAnchor.className = '';
					chartListDiv.style.display = 'none';

					toolsTab.className = '';
					toolsTabAnchor.className = '';
					toolsListDiv.style.display = 'none';

					webTab.className = '';
					webTabAnchor.className = '';
					webListDiv.style.display = 'none';
									
					break;
				case 'chart':
					moduleTab.className = '';
					moduleTabAnchor.className = '';
					moduleListDiv.style.display = 'none';
					
					chartTab.className = 'active';
					chartTabAnchor.className = 'current';
					chartListDiv.style.display = '';					

					toolsTab.className = '';
					toolsTabAnchor.className = '';
					toolsListDiv.style.display = 'none';

					webTab.className = '';
					webTabAnchor.className = '';
					webListDiv.style.display = 'none';
					
					if (!populatedReportCharts){
						DOTB.myDotb.populateReportCharts();
					}
					break;
				case 'tools':
					moduleTab.className = '';
					moduleTabAnchor.className = '';
					moduleListDiv.style.display = 'none';
					
					chartTab.className = '';
					chartTabAnchor.className = '';
					chartListDiv.style.display = 'none';					

					toolsTab.className = 'active';
					toolsTabAnchor.className = 'current';
					toolsListDiv.style.display = '';

					webTab.className = '';
					webTabAnchor.className = '';
					webListDiv.style.display = 'none';
					
					break;
                case 'web':
					moduleTab.className = '';
					moduleTabAnchor.className = '';
					moduleListDiv.style.display = 'none';
					
					chartTab.className = '';
					chartTabAnchor.className = '';
					chartListDiv.style.display = 'none';					

					toolsTab.className = '';
					toolsTabAnchor.className = '';
					toolsListDiv.style.display = 'none';

					webTab.className = 'active';
					webTabAnchor.className = 'current';
					webListDiv.style.display = '';					
					
					break;
				default:
					break;					
			}			
			
			document.getElementById('search_category').value = category;
		},
		
		populateReportCharts: function(){
			var globalList = document.getElementById('globalReportsChartDashletsList');
			var myTeamsList = document.getElementById('myTeamReportsChartDashletsList');
			var mySavedList = document.getElementById('mySavedReportsChartDashletsList');
			var myFavoritesList = document.getElementById('myFavoriteReportsChartDashletsList');

			var getMyFavorites = function(data){
                var response = JSON.parse(data.responseText);
				myFavoritesList.innerHTML = response['html'];
			}
			var mySavedObj = YAHOO.util.Connect.asyncRequest('GET', 'index.php?to_pdf=true&module='+module+'&action=DynamicAction&DynamicAction=getReportCharts&category=myFavorites', {success: getMyFavorites, failure: getMyFavorites});
			
			var getMySaved = function(data) {
                var response = JSON.parse(data.responseText);
				mySavedList.innerHTML = response['html'];
			}
			var mySavedObj = YAHOO.util.Connect.asyncRequest('GET', 'index.php?to_pdf=true&module='+module+'&action=DynamicAction&DynamicAction=getReportCharts&category=mySaved', {success: getMySaved, failure: getMySaved});

			var getMyTeams = function(data) {
				var response = JSON.parse(data.responseText);
				myTeamsList.innerHTML = response['html'];
			}
			var myTeamsObj = YAHOO.util.Connect.asyncRequest('GET', 'index.php?to_pdf=true&module='+module+'&action=DynamicAction&DynamicAction=getReportCharts&category=myTeams', {success: getMyTeams, failure: getMyTeams});
			
			var getGlobal = function(data) {
				var response = JSON.parse(data.responseText);
				globalList.innerHTML = response['html'];
			}
			var globalObj = YAHOO.util.Connect.asyncRequest('GET', 'index.php?to_pdf=true&module='+module+'&action=DynamicAction&DynamicAction=getReportCharts&category=global', {success: getGlobal, failure: getGlobal});		
			
			populatedReportCharts = true;
		},

		searchDashlets: function(searchStr, searchCategory){
			var moduleTab = document.getElementById('moduleCategory');
			var moduleTabAnchor = document.getElementById('moduleCategoryAnchor');
			var moduleListDiv = document.getElementById('moduleDashlets');

			var chartTab = document.getElementById('chartCategory');
			var chartTabAnchor = document.getElementById('chartCategoryAnchor');			
			var chartListDiv = document.getElementById('chartDashlets');			
			
			var toolsTab = document.getElementById('toolsCategory');
			var toolsTabAnchor = document.getElementById('toolsCategoryAnchor');			
			var toolsListDiv = document.getElementById('toolsDashlets');			

			if (moduleTab != null && chartTab != null && toolsTab != null){	
				moduleListDiv.style.display = 'none';
				chartListDiv.style.display = 'none';	
				toolsListDiv.style.display = 'none';
			
			}
			// dashboards case, where there are no tabs
			else{
				chartListDiv.style.display = 'none';
			}
			
			var searchResultsDiv = document.getElementById('searchResults');
			searchResultsDiv.style.display = '';
	
			var success = function(data) {
                var response = JSON.parse(data.responseText);

				searchResultsDiv.innerHTML = response['html'];
			}
			
			var cObj = YAHOO.util.Connect.asyncRequest('GET', 'index.php?to_pdf=true&module='+module+'&action=DynamicAction&DynamicAction=searchDashlets&search='+searchStr+'&category='+searchCategory, {success: success, failure: success});
			return false;
		},
		
		collapseList: function(chartList){
			document.getElementById(chartList+'List').style.display='none';
			document.getElementById(chartList+'ExpCol').innerHTML = '<a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.expandList(\''+chartList+'\');"><img border="0" src="' + DOTB.themes.image_server + 'index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName=advanced_search.gif" align="absmiddle" />';
		},
		
		expandList: function(chartList){
			document.getElementById(chartList+'List').style.display='';		
			document.getElementById(chartList+'ExpCol').innerHTML = '<a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.collapseList(\''+chartList+'\');"><img border="0" src="' + DOTB.themes.image_server + 'index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName=basic_search.gif" align="absmiddle" />';
		},
		
		collapseReportList: function(reportChartList){
			document.getElementById(reportChartList+'ReportsChartDashletsList').style.display='none';
			document.getElementById(reportChartList+'ExpCol').innerHTML = '<a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.expandReportList(\''+reportChartList+'\');"><img border="0" src="' + DOTB.themes.image_server + 'index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName=ProjectPlus.gif" align="absmiddle" />';
		},
		
		expandReportList: function(reportChartList){
			document.getElementById(reportChartList+'ReportsChartDashletsList').style.display='';
			document.getElementById(reportChartList+'ExpCol').innerHTML = '<a href="javascript:void(0)" onClick="javascript:DOTB.myDotb.collapseReportList(\''+reportChartList+'\');"><img border="0" src="' + DOTB.themes.image_server + 'index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName=ProjectMinus.gif" align="absmiddle" />';
		},
		
		clearSearch: function(){
			document.getElementById('search_string').value = '';

			var moduleTab = document.getElementById('moduleCategory');
			var moduleTabAnchor = document.getElementById('moduleCategoryAnchor');
			var moduleListDiv = document.getElementById('moduleDashlets');
			
			document.getElementById('searchResults').innerHTML = '';
			if (moduleTab != null){
				DOTB.myDotb.toggleDashletCategories('module');
			}
			else{
				document.getElementById('searchResults').style.display = 'none';
				document.getElementById('chartDashlets').style.display = '';
			}
		},
		
		doneAddDashlets: function() {
			DOTB.myDotb.dashletsDialog.hide();
			return false;
		},

		renderFirstLoadDialog: function() {
			DOTB.myDotb.firstLoad = new YAHOO.widget.Panel("firstLoad",
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
			DOTB.myDotb.firstLoad.setBody('<div id="firstLoad" align="center" style="vertical-align:middle;"><img src="' + DOTB.themes.image_server + 'index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName=img_loading.gif&v='+DOTB.VERSION_MARK+'" align="absmiddle" /> <b>' + DOTB.language.get('app_strings', 'LBL_FIRST_LOAD') +'</b></div>');
			DOTB.myDotb.firstLoad.render(document.body);		
			document.getElementById('firstLoad_c').style.display = '';
			DOTB.myDotb.firstLoad.show();
			window.setTimeout('DOTB.myDotb.hideFirstLoadDialog()', 4000);
		},
		
		hideFirstLoadDialog: function(){
			DOTB.myDotb.firstLoad.hide();
			document.getElementById('firstLoad_c').style.display = 'none';																
		},
		
		renderLoadingDialog: function() {
			DOTB.myDotb.loading = new YAHOO.widget.Panel("loading",
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
			DOTB.myDotb.loading.setBody('<div id="loadingPage" align="center" style="vertical-align:middle;"><img src="' + DOTB.themes.image_server + 'index.php?entryPoint=getImage&themeName='+DOTB.themes.theme_name+'&imageName=img_loading.gif&v='+DOTB.VERSION_MARK+'" align="absmiddle" /> <b>' + DOTB.language.get('app_strings', 'LBL_LOADING_PAGE') +'</b></div>');
			DOTB.myDotb.loading.render(document.body);		
			if (document.getElementById('loading_c'))
                document.getElementById('loading_c').style.display = 'none';
		},
		
		renderAddPageDialog: function() {
			var handleSuccess = function(o){
				var result = JSON.parse(o.responseText);
   
			    var pageName = result['pageName'];
			    var numCols = result['numCols'];
			    
				DOTB.myDotb.addTab(pageName,numCols);	
				if (!DOTB.isIE){	
					setTimeout("document.getElementById('addPageDialog_c').style.display = 'none';", 2000);					
				}
				DOTB.myDotb.addPageDialog.hide();
			};
			
			var handleFailure = function(o){
				if (!DOTB.isIE){	
					setTimeout("document.getElementById('addPageDialog_c').style.display = 'none';", 2000);					
				}
				DOTB.myDotb.addPageDialog.hide();
			};
					
			var handleSubmit = function(){
				this.submit();
			};
			
			var handleCancel = function(){
				DOTB.myDotb.addPageDialog.hide();
			};
					     
			// Instantiate the Dialog
			DOTB.myDotb.addPageDialog = new YAHOO.widget.Dialog("addPageDialog", 
			{ width : "300px",
			  fixedcenter : true,
			  visible : false, 
			  draggable: false,
			  effect:[{effect:YAHOO.widget.ContainerEffect.SLIDE, duration:0.5},
			  		  {effect:YAHOO.widget.ContainerEffect.FADE,duration:0.5}],																  
			  buttons : [ { text:DOTB.language.get('app_strings', 'LBL_SUBMIT_BUTTON_LABEL'), handler:handleSubmit, isDefault:true },
						  { text:DOTB.language.get('app_strings', 'LBL_CANCEL_BUTTON_LABEL'), handler:handleCancel } ],
			  modal : true
			 } );
																		 
			DOTB.myDotb.addPageDialog.callback = { success: handleSuccess, failure: handleFailure };

			DOTB.myDotb.addPageDialog.validate = function(){
				var postData = this.getData();
				
				if (postData.pageName == ""){
					alert(DOTB.language.get('app_strings', 'ERR_BLANK_PAGE_NAME'));
					return false;
				}

				return true;
			}

			document.getElementById('addPageDialog').style.display = '';                                            
			DOTB.myDotb.addPageDialog.render();
			document.getElementById('addPageDialog_c').style.display = 'none';			
		
		},
		
		renderDashletsDialog: function(){	
            var minHeight = 120;
            var maxHeight = 520;
            var minMargin = 16;

            // adjust dialog height according to current page height
            var pageHeight = document.documentElement.clientHeight;
            var height = Math.min(maxHeight, pageHeight - minMargin * 2);
            height = Math.max(height, minHeight);

			DOTB.myDotb.dashletsDialog = new YAHOO.widget.Dialog("dashletsDialog", 
			{ width : "480px",
			  height: height + "px",
			  fixedcenter : true,
			  draggable:false,
			  visible : false, 
			  modal : true,
			  close:false
			 } );

			var listeners = new YAHOO.util.KeyListener(document, { keys : 27 }, {fn: function() {DOTB.myDotb.closeDashletsDialog();} } );
			DOTB.myDotb.dashletsDialog.cfg.queueProperty("keylisteners", listeners);

			document.getElementById('dashletsDialog').style.display = '';																				 
			DOTB.myDotb.dashletsDialog.render();
			document.getElementById('dashletsDialog_c').style.display = 'none';			
		}	
		,

		changePageLayout: function(numCols){
			DOTB.myDotb.changeLayout(numCols);
			if (!DOTB.isIE){	
				setTimeout("document.getElementById('changeLayoutDialog_c').style.display = 'none';", 2000);					
			}
			DOTB.myDotb.changeLayoutDialog.hide();		
		},
		
		renderChangeLayoutDialog: function(){
			DOTB.myDotb.changeLayoutDialog = new YAHOO.widget.Dialog("changeLayoutDialog", 
			{ width : "300px",
			  fixedcenter : true,
			  visible : false, 
			  draggable: false,
			  effect:[{effect:YAHOO.widget.ContainerEffect.SLIDE, duration:0.5},
			  		  {effect:YAHOO.widget.ContainerEffect.FADE,duration:0.5}],
			  modal : true
			 } );

			document.getElementById('changeLayoutDialog').style.display = '';
			DOTB.myDotb.changeLayoutDialog.render();			
			document.getElementById('changeLayoutDialog_c').style.display = 'none';
		},
		
		attachDashletCtrlEvent: function(){
			var tablist = document.getElementById("tabList");
			if	(YAHOO.env.ua.ie) {
					YAHOO.util.Event.on(tablist, 'mouseenter', function() { 
						tablist.className = "subpanelTablist selected";
					}); 
					
					YAHOO.util.Event.on(tablist, 'mouseleave', function() { 
						tablist.className = "subpanelTablist";
					}); 
				} else {
					YAHOO.util.Event.on(tablist, 'mouseover', function() { 
						tablist.className = "subpanelTablist selected";
					}); 
					
					YAHOO.util.Event.on(tablist, 'mouseout', function() { 
						tablist.className = "subpanelTablist";
					}); 
				}
		}
		,
		attachToggleToolsetEvent: function(dashletId){
			var header = document.getElementById("dashlet_header_"+dashletId);
			if	(YAHOO.env.ua.ie) {
					YAHOO.util.Event.on(header, 'mouseenter', function() { 
						document.getElementById("dashlet_header_"+dashletId).className = "hd selected";
					}); 
					
					YAHOO.util.Event.on(header, 'mouseleave', function() { 
						document.getElementById("dashlet_header_"+dashletId).className = "hd";
					}); 
				} else {
					YAHOO.util.Event.on(header, 'mouseover', function() { 
						document.getElementById("dashlet_header_"+dashletId).className = "hd selected";
					}); 
					
					YAHOO.util.Event.on(header, 'mouseout', function() { 
						document.getElementById("dashlet_header_"+dashletId).className = "hd";
					}); 
				}
		}
	 }; 
}();
};
