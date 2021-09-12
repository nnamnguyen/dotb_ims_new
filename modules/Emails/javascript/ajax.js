

if (typeof console == "undefined")
	console = { log: function(o) {alert(o)} };

var AjaxObject = {
	ret : '',
	currentRequestObject : null,
	//timeout : 30000, // 30 second timeout default
	timeout : 9999999999, // 30 second timeout default
	forceAbort : false,
	trail : new Array(),

	/**
	 */
	_reset : function() {
		this.timeout = 30000;
		this.forceAbort = false;
	},

	folderRenameCleanup : function() {
		DOTB.email2.folders.setDotbFolders();
	},

	fullSyncCleanup : function(o) {
		this.folders.checkMailCleanup(o);
		DOTB.email2.settings.settingsDialog.hide();
	},

	/**
	 */
	composeCache : function(o) {
		var idx = DOTB.email2.composeLayout.currentInstanceId; // post instance increment
		// get email templates and user signatures
		var ret = YAHOO.lang.JSON.parse(o.responseText);

		DOTB.email2.composeLayout.emailTemplates = ret.emailTemplates;
		DOTB.email2.composeLayout.signatures = ret.signatures;
		DOTB.email2.composeLayout.fromAccounts = ret.fromAccounts;

		DOTB.email2.composeLayout.setComposeOptions(idx);

		//Set the error array so we can notify the user when they try to hit send if any errors
		//are present.  We will also notify them now (after hitting compose button).
		DOTB.email2.composeLayout.outboundAccountErrors = ret.errorArray;


		//if error element is returning an array, then check the length to make sure we have error messages
		if (typeof(ret.errorArray)=='object' && ret.errorArray instanceof Array && ret.errorArray.length > 0){
			//add error messages for display
			for(i in ret.errorArray)
				DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, ret.errorArray[i], 'alert');
		}else if (typeof(ret.errorArray)=='object' && ret.errorArray!=null && ret.errorArray!='' ) {
			//if error element is returning an object, and the object value is not empty or null, then display error message
			for(i in ret.errorArray)
				DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, ret.errorArray[i], 'alert');
		}

		//YUI bug with IE6 - Wont restore visibility property for nested select elements.
		if(DOTB.isIE) {
			var overlayPanel = YAHOO.DOTB.MessageBox.panel;
			if(overlayPanel) {
			  overlayPanel.subscribe('hide',function() { YAHOO.util.Dom.setStyle('addressFrom' + idx,'visibility','');});
			}
		}
	},


	handleDeleteSignature : function(o) {
		DOTB.hideMessageBox();
        var ret = YAHOO.lang.JSON.parse(o.responseText);
		DOTB.email2.composeLayout.signatures = ret.signatures;
    	var field = document.getElementById('signature_id');
		DOTB.email2.util.emptySelectOptions(field);

		for(var i in ret.signatures) { // iterate through assoc array
			var opt = new Option(ret.signatures[i], i);
			field.options.add(opt);
		}
		setSigEditButtonVisibility();
	},

	/**
	 */
	handleDeleteReturn : function(o) {
		// force refresh ListView
		DOTB.hideMessageBox();
		if(document.getElementById('focusEmailMbox')) {
			YAHOO.namespace('frameFolders').selectednode = DOTB.email2.folders.getNodeFromMboxPath(document.getElementById('focusEmailMbox').innerHTML);
		}

		// need to display success message before calling next async call?
		document.getElementById(this.target).innerHTML = o.responseText;
	},

	/**
	 */
    handleFailure : function(o) {
		// Failure handler
		DOTB.showMessageBox(mod_strings.LBL_EXCEPTION, o.statusText, 'alert');
		if(document.getElementById('saveButton')) {
			document.getElementById('saveButton').disabled = false;
		}
	},

	handleReplyForward : function(o) {
		var a = YAHOO.lang.JSON.parse(o.responseText);
		globalA = a;
		var idx = DOTB.email2.composeLayout.currentInstanceId;

		document.getElementById('email_id' + idx).value = a.uid;
		document.getElementById('emailSubject' + idx).value = a.name;
		document.getElementById('addressTO' + idx).value = a.from;
		document.getElementById('uid' + idx).value = a.uid;
		if(a.cc) {
			document.getElementById('addressCC' + idx).value = a.cc;
			SE.composeLayout.showHiddenAddress('cc', idx);
		}

		if(a.type) {
			document.getElementById('type' + idx).value = a.type;
		}

		// apply attachment values
		DOTB.email2.composeLayout.loadAttachments(a.attachments);

		setTimeout("callbackReplyForward.finish(globalA);", 500);
	},

	handleReplyForwardForDraft : function(o) {
		var a = YAHOO.lang.JSON.parse(o.responseText);
		globalA = a;
		var idx = DOTB.email2.composeLayout.currentInstanceId;

		document.getElementById('email_id' + idx).value = a.uid;
		document.getElementById('emailSubject' + idx).value = a.name;
		document.getElementById('addressTO' + idx).value = a.to;

		if(a.cc) {
			document.getElementById('addressCC' + idx).value = a.cc;
			DOTB.email2.composeLayout.showHiddenAddress('cc',idx);
		}

		if(a.bcc) {
			document.getElementById('addressBCC' + idx).value = a.bcc;
			DOTB.email2.composeLayout.showHiddenAddress('bcc',idx);
		}


		if(a.type) {
			document.getElementById('type' + idx).value = a.type;
		}

        var teamOptions = document.getElementById('teamOptions' + idx);
        teamOptions.innerHTML = "";

        if (a.teamSetCode != null) {
	        var teamOptionsString = a.teamSetCode;
	        teamOptionsString = teamOptionsString.replace(/composeEmailForm/gi, ("composeOptionsForm" + idx));
	        teamOptions.innerHTML = teamOptionsString;
	        DOTB.util.evalScript(teamOptionsString);
        }

		// apply attachment values
		DOTB.email2.composeLayout.loadAttachments(a.attachments);

		setTimeout("callbackReplyForward.finish(globalA,0,1);", 500);
	},

	/**
	 */
	handleSuccess : function(o) {
		document.getElementById(this.target).innerHTML = o.responseText;
		DOTB.hideMessageBox();
	},

	/**
	 */
	ieDeleteSuccess : function(o) {
		DOTB.hideMessageBox();
		DOTB.email2.accounts.refreshInboundAccountTable();
		alert(app_strings.LBL_EMAIL_IE_DELETE_SUCCESSFUL);
		DOTB.email2.accounts.rebuildFolderList();
	},

	/**
	 */
	ieSaveSuccess : function(o) {
		document.getElementById('saveButton').disabled = false;
		var a = YAHOO.lang.JSON.parse(o.responseText);
		if (a) {
			if(a.error) {
				DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, app_strings.LBL_EMAIL_ERROR_CHECK_IE_SETTINGS, 'alert');
				DOTB.email2.accounts.ieAccountError(DOTB.email2.accounts.errorStyle);
			} else {
				resp = YAHOO.lang.JSON.parse(o.responseText);
				DOTB.email2.accounts.refreshInboundAccountTable();
				DOTB.email2.accounts.refreshOuboundAccountTable();
				DOTB.email2.folders.startEmailCheckOneAccount(resp.id, true);
				DOTB.email2.accounts.inboundAccountEditDialog.hide();
			}
		} else {
		     DOTB.hideMessageBox();
		     DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, app_strings.LBL_EMAIL_ERROR_SAVE_ACCOUNT, 'alert');
		}

	},

	/**
	 */
	loadAttachments : function(o) {
		var result = YAHOO.lang.JSON.parse(o.responseText);

		DOTB.email2.composeLayout.loadAttachments(result);
	},

	/**
	 */
	loadSignature : function(o) {
		var ret = YAHOO.lang.JSON.parse(o.responseText);
		DOTB.email2.signatures[ret.id] = ret.signature_html;
		DOTB.email2.composeLayout.setSignature(DOTB.email2.signatures.targetInstance);
	},

	/**
	 * Follow up to mark email read|unread|flagged
	 */
	markEmailCleanup : function(o) {
		var ret = YAHOO.lang.JSON.parse(o.responseText);
		if (!ret['status']) {
        	DOTB.hideMessageBox();
			DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, ret['message'], 'alert');
		} else {
			DOTB.email2.contextMenus.markEmailCleanup();
		} // else
	},

	/**
	 */
	rebuildShowFolders : function(o) {
		var t = YAHOO.lang.JSON.parse(o.responseText);
		var show = document.getElementById('ieAccountListShow');

		DOTB.email2.util.emptySelectOptions(show);

		for(i=0; i<t.length; i++) { // iterate through assoc array
			var opt = new Option(t[i].text, t[i].value, t[i].selected);
			opt.selected = t[i].selected;
			show.options.add(opt);
		}

		DOTB.email2.accounts.renderTree();
	},
	/**
	 */
	saveListViewSortOrderPart2 : function() {
		// create the JSON string the func expects
		focusFolderPath = '[ "Home", "' + ieName + '"';

		var f = new String(focusFolder);
		var fEx = f.split('.');

		for(i=0; i<fEx.length; i++) {
			focusFolderPath += ', "' + fEx[i] +'"'
		}

		focusFolderPath += ']';

		YAHOO.namespace('frameFolders').selectednode = DOTB.email2.folders.getNodeFromMboxPath(focusFolderPath);
		DOTB.email2.listView.populateListFrame(YAHOO.namespace('frameFolders').selectednode, ieId, 'true');
	},

	/**
	 *
	 */
	sendEmailCleanUp : function(o) {
        var ret;
        DOTB.hideMessageBox();

        try {
            ret = YAHOO.lang.JSON.parse(o.responseText);
            DOTB.email2.composeLayout.forceCloseCompose(ret.composeLayoutId);
        } catch(err) {
            if (o.responseText) {
                DOTB.showMessageBox(mod_strings.LBL_SEND_EMAIL_FAIL_TITLE, o.responseText, 'alert');
		    }
            // Else we have an error here.
        }        

		if (typeof(SE.grid) != 'undefined')
			SE.listView.refreshGrid();
		//Disabled while address book is disabled

		//If this call back was initiated by quick compose from a Detail View page, refresh the
		//history subpanel.  If it was initiated by quickcreate from shortcut bar, then
		//close the shortcut bar menu
		if ( (typeof(action_dotb_grp1) != 'undefined')) {
		    //make sure if the history subpanel exists before showing it
		    if(action_dotb_grp1 == 'DetailView' && document.getElementById("subpanel_history")) {
				showSubPanel('history',null,true);
		  	} else if(action_dotb_grp1 == 'quickcreate') {
		  		closeEmailOverlay();
		  	}
		}

	},

	ieSendSuccess : function(o) {
		DOTB.hideMessageBox();
		var ret = YAHOO.lang.JSON.parse(o.responseText);
		if (ret.status == false) {
		    if (ret.errorMessage) {
		        DOTB.showMessageBox(app_strings.LBL_EMAIL_TEST_OUTBOUND_SETTINGS, ret.errorMessage, 'plain');
		    }
		    else {
		        DOTB.showMessageBox(app_strings.LBL_EMAIL_TEST_OUTBOUND_SETTINGS, app_strings.LBL_EMAIL_INVALID_SYSTEM_OUTBOUND, 'plain');
		    }
		}
		else {
		    DOTB.showMessageBox(app_strings.LBL_EMAIL_TEST_OUTBOUND_SETTINGS_SENT, app_strings.LBL_EMAIL_TEST_NOTIFICATION_SENT, 'plain');
		}
	},

	/**
	 */
	settingsFolderRefresh : function(o) {
		var ret = YAHOO.lang.JSON.parse(o.responseText);
		var user = document.getElementById('userFolders');

		DOTB.email2.util.emptySelectOptions(user);

		for(i=0; i<ret.userFolders.length; i++) {
			var display = ret.userFolders[i].name;
			var value = ret.userFolders[i].id;
			var selected = (ret.userFolders[i].selected != "") ? true : false;
			var opt = new Option(display, value, selected);
			opt.selected = selected;
			user.options.add(opt);
		}
	},

	/**
	 */
	startRequest : function(callback, args, forceAbort) {
		if(this.currentRequestObject != null) {
			if(this.forceAbort == true) {
				YAHOO.util.Connect.abort(this.currentRequestObject, null, false);
			}
		}

        // add CSRF form token
        if (args && args.length > 0) {
            args += '&';
        } else {
            args = '';
        }
        args += 'csrf_token=' + DOTB.csrf.form_token;

		this.currentRequestObject = YAHOO.util.Connect.asyncRequest('POST', "./index.php", callback, args);
		this._reset();
	},

	requestInProgress : function() {
		return (YAHOO.util.Connect.isCallInProgress(this.currentRequestObject));
	},

	/**
	 */
	updateFolderSubscriptions : function() {
		DOTB.email2.folders.lazyLoadSettings(); // refresh view in Settings overlay
		DOTB.email2.folders.setDotbFolders(1000);// refresh view in TreeView
		DOTB.hideMessageBox();
	},

	/**
	 */
	updateFrameFolder : function() {
		DOTB.email2.folders.checkEmailAccounts();
	},

	/**
	 */
	updateUserPrefs : function(o) {
		DOTB.email2.userPrefs = YAHOO.lang.JSON.parse(o.responseText);
		DOTB.email2.folders.startCheckTimer(); // starts the auto-check interval
	},

	/**
	 */
	uploadAttachmentSuccessful : function(o) {
		// clear out field
		document.getElementById('email_attachment').value = '';
		
		var ret = YAHOO.lang.JSON.parse(o.responseText);
		ret.name = escape(ret.name);
		var idx = DOTB.email2.composeLayout.currentInstanceId;
		var overall = document.getElementById('addedFiles' + idx);
		var index = overall.childNodes.length;
		var out =
			"<div id='email_attachment_bucket" + idx + index + "'>" +
				// remove button
				"<img src='index.php?entryPoint=getImage&themeName=" + DOTB.themes.theme_name + "&imageName=minus.gif' " +
					"style='cursor:pointer' align='absmiddle' onclick='DOTB.email2.composeLayout.deleteUploadAttachment(\"" +
					idx + index + "\",\"" + ret.guid + ret.name + "\");'/>" +
				// file icon
				"<img src='index.php?entryPoint=getImage&themeName=" + DOTB.themes.theme_name + "&imageName=attachment.gif' " +
					"id='email_attachmentImage'" + idx + index + "align='absmiddle' />" +
				// hidden id field
				"<input type='hidden' value='" + ret.guid + ret.name + "' name='email_attachment" + index + "' id='email_attachment" + idx + index + "' />" +
				// file name
				((ret.nameForDisplay != null) ? ret.nameForDisplay + "&nbsp;" : ret.name + "&nbsp;") +
				"<br/>" +
			"</div>";
		overall.innerHTML += out;
		if(DOTB.email2.util.isIe()) {
			document.getElementById('addedFiles' + idx).innerHTML = document.getElementById('addedFiles' + idx).innerHTML;
		}

		// hide popup
		DOTB.email2.addFileDialog.hide();
		// focus attachments
		DOTB.email2.composeLayout.showAttachmentPanel(idx);
	}
};


///////////////////////////////////////////////////////////////////////////
////	PER MODULE CALLBACK OBJECTS
AjaxObject.accounts = {
	saveOutboundCleanup : function(o) {
		DOTB.email2.accounts.refreshOuboundAccountTable();
		DOTB.email2.accounts.outboundDialog.hide();
		var id = o.responseText;
		DOTB.email2.accounts.newAddedOutboundId = id;
		},
	saveDefaultOutboundCleanup: function(o){

	},
	callbackEditOutbound : {
		success	: function(o)
		{
			var ret = YAHOO.lang.JSON.parse(o.responseText);
			// show overlay
			DOTB.email2.accounts.showAddSmtp();

			// fill values
			document.getElementById("mail_id").value = ret.id;
			document.getElementById("type").value = ret.type;
			document.getElementById("mail_sendtype").value = ret.mail_sendtype;
			document.getElementById("mail_name").value = ret.name;
			document.getElementById("mail_smtpserver").value = ret.mail_smtpserver;
			document.getElementById("outboundEmailForm").mail_smtptype.value = ret.mail_smtptype;
			document.getElementById("mail_smtpport").value = ret.mail_smtpport;
			document.getElementById("mail_smtpuser").value = ret.mail_smtpuser;
			document.getElementById("mail_smtpauth_req").checked = (ret.mail_smtpauth_req == 1) ? true : false;
			DOTB.email2.accounts.smtp_authenticate_field_display();
			document.getElementById("mail_smtpssl").options[ret.mail_smtpssl].selected = true;

            if(ret.type == 'system-override') {
			     DOTB.email2.accounts.toggleOutboundAccountDisabledFields(true);
			     DOTB.email2.accounts.changeEmailScreenDisplay(ret.mail_smtptype,true);
            }
            else {
			     DOTB.email2.accounts.toggleOutboundAccountDisabledFields(false);
			     DOTB.email2.accounts.changeEmailScreenDisplay(ret.mail_smtptype,false);
            }
            DOTB.util.setEmailPasswordDisplay('mail_smtppass', ret.has_password);

		},
		failure	: AjaxObject.handleFailure,
		timeout	: AjaxObject.timeout,
		scope	: AjaxObject
	},
	callbackDeleteOutbound : {
		success	: function(o) {
		    var ret = YAHOO.lang.JSON.parse(o.responseText);
		    if(ret.is_error)
		    {
		        if(confirm(ret.error_message))
                {
                    DOTB.showMessageBox(app_strings.LBL_EMAIL_IE_DELETE, app_strings.LBL_EMAIL_ONE_MOMENT);
                    AjaxObject.startRequest(AjaxObject.accounts.callbackDeleteOutbound, urlStandard + "&emailUIAction=deleteOutbound&confirm=true&outbound_email=" + ret.outbound_email);
                }
                else
                    DOTB.hideMessageBox();
		    }
		    else
		    {
			     DOTB.hideMessageBox();
			     DOTB.email2.accounts.refreshOuboundAccountTable();
		    }
		},

		failure	: AjaxObject.handleFailure,
		timeout	: AjaxObject.timeout,
		scope	: AjaxObject
	},

	callbackCheckMailProgress : {
	   success : function(o) {
	       if (typeof(DOTB.email2.accounts.totalMsgCount) == "undefined") {
	           DOTB.email2.accounts.totalMsgCount = -1;
	       }

	       //Check for server timeout / errors
	       var ret = YAHOO.lang.JSON.parse(o.responseText);
	       var done = false;

	       if (typeof(o.responseText) == 'undefined' || o.responseText == "" || ret == false) {
	           DOTB.hideMessageBox();
	           DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, app_strings.LBL_EMAIL_ERROR_TIMEOUT, 'alert');
	           DOTB.email2.accounts.totalMsgCount = -1;
               done = true;
	       }

	       var currIeId = ret['ieid'];


	       var serverCount = ret.count;

	       if (ret['status'] == 'done') {
	           for(i=0; i < DOTB.email2.accounts.ieIds.length; i++) {
	               if (i == DOTB.email2.accounts.ieIds.length - 1) {
	                   //We are all done
	                   done = true;
	                   break;
	               } else if (DOTB.email2.accounts.ieIds[i] == currIeId) {
	                   //Go to next account
	                   currIeId = DOTB.email2.accounts.ieIds[i+1];
	                   ret.count = 0;
	                   DOTB.email2.accounts.totalMsgCount = -1;
	                   break;
	               }
	           }
	       }
	       else if (ret.mbox && ret.totalcount && ret.count) {
	           DOTB.email2.accounts.totalMsgCount = ret.totalcount;
	           if (ret.count >= ret.totalcount) {
	               serverCount = 0;
	           }
	       } else if (DOTB.email2.accounts.totalMsgCount < 0 && ret.totalcount) {
	           DOTB.email2.accounts.totalMsgCount = ret.totalcount;
	       } else {
		       DOTB.hideMessageBox();
               DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, app_strings.LBL_EMAIL_ERROR_TIMEOUT, 'alert');
               DOTB.email2.accounts.totalMsgCount = -1;
               done = true;
		   }

	       if (done) {
	           DOTB.email2.accounts.totalMsgCount = -1;
	           DOTB.hideMessageBox();
	           DOTB.email2.folders.rebuildFolders();
	           SE.listView.refreshGrid();
	       } else if (DOTB.email2.accounts.totalMsgCount < 0) {
               YAHOO.DOTB.MessageBox.updateProgress(0, mod_strings.LBL_CHECKING_ACCOUNT + ' '+ (i + 2) + ' '+ mod_strings.LBL_OF + ' ' + DOTB.email2.accounts.ieIds.length);
               AjaxObject.startRequest(AjaxObject.accounts.callbackCheckMailProgress, urlStandard +
                                '&emailUIAction=checkEmailProgress&ieId=' + currIeId + "&currentCount=0&synch=" + ret.synch);
           } else {
               YAHOO.DOTB.MessageBox.updateProgress((ret.count / DOTB.email2.accounts.totalMsgCount) * 100,
                   app_strings.LBL_EMAIL_DOWNLOAD_STATUS.replace(/\[\[count\]\]/, ret.count).replace(/\[\[total\]\]/, DOTB.email2.accounts.totalMsgCount));
	           AjaxObject.startRequest(AjaxObject.accounts.callbackCheckMailProgress, urlStandard +
                   '&emailUIAction=checkEmailProgress&ieId=' + currIeId + "&currentCount=" + serverCount +
                   '&mbox=' + ret.mbox + '&synch=' + ret.synch + '&totalcount=' + DOTB.email2.accounts.totalMsgCount);
	       }
	   },
	   failure : AjaxObject.handleFailure,
       timeout : AjaxObject.timeout,
       scope   : AjaxObject
	}
};

///////////////////////////////////////////////////////////////////////////////
////	COMPOSE LAYOUT
AjaxObject.composeLayout = {
	/**
	 * Populates the record id
	 */
    saveDraftCleanup : function(o) {
        var ret;
        DOTB.hideMessageBox();

        try {
            ret = YAHOO.lang.JSON.parse(o.responseText);
            DOTB.email2.composeLayout.forceCloseCompose(ret.composeLayoutId);
        } catch(err) {
            if (o.responseText) {
                DOTB.showMessageBox(mod_strings.LBL_ERROR_SAVING_DRAFT, o.responseText, 'alert');
            }
        }
    }
};

AjaxObject.composeLayout.callback = {
	saveDraft : {
		success	: AjaxObject.composeLayout.saveDraftCleanup,
		failure	: AjaxObject.handleFailure,
		timeout	: AjaxObject.timeout,
		scope	: AjaxObject
	}
};

AjaxObject.detailView = {
	/**
	 * Pops-up a printable view of an email
	 */
	displayPrintable : function(o) {
		var ret = YAHOO.lang.JSON.parse(o.responseText);
		var displayTemplate = new YAHOO.DOTB.Template(DOTB.email2.templates['viewPrintable']);
		// 2 below must be in global context
		meta = ret.meta;
		meta['panelId'] = DOTB.email2.util.getPanelId();
		email = ret.meta.email;
		if (typeof(email.cc) == 'undefined') {
		  email.cc = "";
		}

		var out = displayTemplate.exec({
			'app_strings'	: app_strings,
			'theme'			: theme,
			'idx'			: 'Preview',
			'meta'			: meta,
			'email'			: meta.email
		});

		// open popup window
		var popup = window.open('modules/Emails/templates/_blank.html', 'printwin' ,
		    'scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');

		popup.document.write(out);
		popup.document.close();
	},

	/**
	 * Takes formatted response and creates a modal pop-over containing a title and content
	 */
	displayView : function(o) {
		var SED = DOTB.email2.detailView;
		var ret = YAHOO.lang.JSON.parse(o.responseText);

		if(!SED.viewDialog) {
			SED.viewDialog = new YAHOO.widget.Dialog("viewDialog", {
				modal:true,
            	visible:true,
            	fixedcenter:true,
            	constraintoviewport: true,
				shadow	: true
			});
            SED.viewDialog.renderEvent.subscribe(function() {
            	var content = this.body.firstChild;
            	var viewH = YAHOO.util.Dom.getViewportHeight();
            	if (content) {
            		this.body.style.overflow = "auto";
            		this.body.style.width = "800px";
            		this.body.style.height = (viewH - 75 > content.clientHeight ? (content.clientHeight) : (viewH - 75)) + "px";
            	}
            }, SED.viewDialog);
		} // end lazy load
		SED.viewDialog.setHeader(ret.title);
		SED.viewDialog.setBody(ret.html);
		SED.viewDialog.render();
		SED.viewDialog.show();
	},

	/**
	 * Generates a modal popup to populate with the contents of bean's full EditView
	 */
	showQuickCreateForm : function(o) {
		var SED = DOTB.email2.detailView;
		var ret = YAHOO.lang.JSON.parse(o.responseText);

		if(!SED.quickCreateDialog) {
			SED.quickCreateDialog = new YAHOO.widget.Dialog("quickCreateForEmail", {
				modal:true,
				visible:true,
            	fixedcenter:true,
            	constraintoviewport: true,
				shadow	: true
			});

            SED.quickCreateDialog.renderEvent.subscribe(function() {
            	var viewH = YAHOO.util.Dom.getViewportHeight();
            	var contH = 0;
            	for (var i in this.body.childNodes) {
            		if (this.body.childNodes[i].clientHeight) {
            			contH += this.body.childNodes[i].clientHeight;
            		} else if (this.body.childNodes[i].offsetHeight) {
            			contH += this.body.childNodes[i].offsetHeight;
            		} // if
            	}
        		this.body.style.width = "800px";
        		this.body.style.height = (viewH - 75 > contH ? (contH + 10) : (viewH - 75)) + "px";
        		this.body.style.overflow = "auto";
            }, SED.quickCreateDialog);

            // dialog contents may override current drag-n-drop mode
            // so restore it when the dialog is hidden (bug #49330)
            var mode = YAHOO.util.DDM.mode;
            SED.quickCreateDialog.hideEvent.subscribe(function() {
                YAHOO.util.DDM.mode = mode;
            });
            SED.quickCreateDialog.setHeader(app_strings.LBL_EMAIL_QUICK_CREATE);
		} // end lazy load
		if (ret.html) {
			ret.html = ret.html.replace('<script type="text/javascript" src="include/DotbEmailAddress/DotbEmailAddress.js?v='+DOTB.VERSION_MARK+'"></script>', "");
		}
		SED.quickCreateDialog.setBody(ret.html ? ret.html : "&nbsp;");
		SED.quickCreateDialog.render();
		DOTB.util.evalScript(ret.html + '<script language="javascript">enableQS(true);</script>');

		SED.quickCreateDialog.ieId = ret.ieId;
		SED.quickCreateDialog.uid = ret.uid;
        SED.quickCreateDialog.mbox = ret.mbox;
        SED.quickCreateDialog.qcmodule = ret.module;

        SED.quickCreateDialog.show();

		var editForm = document.getElementById('form_EmailQCView_' + ret.module);
		if (editForm) {
		  editForm.module.value = 'Emails';
		  var count = 0;
          if (DOTB.EmailAddressWidget.count[ret.module]) {
              count = DOTB.EmailAddressWidget.count[ret.module] - 1;
          }
          var tableId = YAHOO.util.Dom.getElementsByClassName('emailaddresses', 'table', editForm)[0];
          tableId = tableId ? tableId.id : tableId;
		  var instId = ret.module + count;
		  SED.quickCreateEmailsToAdd = ret.emailAddress;
		  SED.quickCreateEmailCallback = function(instId, tableId) {
              //try to fill up the email address if and only if emailwidget is existed in the form
              if(tableId) {
                  var eaw = DOTB.EmailAddressWidget.instances[instId];
                  if (eaw) {
                      eaw.prefillEmailAddresses(tableId, DOTB.email2.detailView.quickCreateEmailsToAdd);
                  } else {
                      window.setTimeout(function() {
                          DOTB.email2.detailView.quickCreateEmailCallback(instId, tableId);
                      }, 100);

                  }
              }
		  }
		  window.setTimeout(function() {
              DOTB.email2.detailView.quickCreateEmailCallback(instId, tableId);
            }, 100);
		}
	},

	saveQuickCreateForm : function(o) {
	    DOTB.hideMessageBox();
		DOTB.email2.detailView.quickCreateDialog.hide();
		validate['EditView'] = [ ];
	},

	saveQuickCreateFormAndReply : function(o) {
        DOTB.hideMessageBox();
        var ret = YAHOO.lang.JSON.parse(o.responseText);
        DOTB.email2.detailView.quickCreateDialog.hide();
        var qcd = DOTB.email2.detailView.quickCreateDialog;
        var type = (qcd.qcmodule == 'Cases') ? 'replyCase' : 'reply';
        if (ret) {
            var emailID = ret.id;
            DOTB.email2.composeLayout.c0_replyForwardEmail(null, ret.id, 'dotb::Emails', type);
        } else {
            DOTB.email2.composeLayout.c0_replyForwardEmail(qcd.ieId, qcd.uid, qcd.mbox, type);
        }
        //Cean the validate cache to prevent errors on the next call
        validate['EditView'] = [ ];
    },

	saveQuickCreateFormAndAddToAddressBook : function(o) {
	   DOTB.hideMessageBox();
		DOTB.email2.detailView.quickCreateDialog.hide();
		DOTB.email2.complexLayout.findPanel('contactsTab').show();
		validate['EditView'] = [ ];
	},

	handleAssignmentDialogAssignAction : function() {


	    var assign_user_id = window.document.forms['Distribute'].elements['assigned_user_id'].value;

	    var dist = 'direct';
	    var users = false;
	    var rules = false;
	    var get = "";
	    var found_teams = false;
	    var warning_message = mod_strings.LBL_WARN_NO_USERS;
	    //Ensure a valid team selection.
	    if( typeof validate['Distribute'] == 'undefined' )
	       addToValidate('Distribute', 'team_name', 'teamset_mass', false, 'Team');

	   formValidTeamSet = validate_form('Distribute','');
	   if(!formValidTeamSet)
	       return false;

	    var warning_message = mod_strings.LBL_WARN_NO_USERS_OR_TEAM;
	    var teamIdsArray = DOTB.collection.prototype.getTeamIdsfromUI('Distribute', 'team_name');
	    if (teamIdsArray != null && teamIdsArray.length > 0)   {
	        var team_ids = teamIdsArray.join(",");
	        var primary_team = DOTB.collection.prototype.getPrimaryTeamidsFromUI('Distribute', 'team_name');
	        if( primary_team != '' || team_ids.replace(',',"") != '')
	        found_teams = true;

	        get = get + "&team_ids=" + team_ids + "&primary_team_id=" + primary_team;
	    }
	    //Determine what type of team update the user wants to perform.
	    var el = window.document.forms['Distribute'].elements['team_name_type'];
	    var teamUpdateType;
	    for(var j=0;j<el.length;j++)
	    {
	        if(el[j].checked)
	           teamUpdateType = el[j].value;
	    }
	    get = get + "&team_update_type=" + teamUpdateType;
	    if(!found_teams && assign_user_id == '' )
	    {
	        alert(warning_message);
	        return;
	    }

	    var emailUids = DOTB.email2.listView.getUidsFromSelection();
	    var uids = "";
	    for(i=0; i<emailUids.length; i++) {
	        if(uids != '') {
	            uids += app_strings.LBL_EMAIL_DELIMITER;
	        }
	        uids += emailUids[i];
	    }

	    var row = DOTB.email2.grid.getSelectedRows()[0];
	    var data = DOTB.email2.grid.getRecord(row).getData();
	    var ieid = data.ieId;
	    var mbox = data.mbox;
	    AjaxObject.startRequest(callbackAssignmentAction, urlStandard + '&emailUIAction=' + "doAssignmentAssign&uids=" + uids + "&ieId=" + ieid + "&folder=" + mbox + "&distribute_method=" + dist + "&users=" +assign_user_id + get);
	    DOTB.email2.contextMenus.assignToDialogue.hide();
	    DOTB.showMessageBox('Assignment', app_strings.LBL_EMAIL_ONE_MOMENT);

	},

	handleAssignmentDialogDeleteAction : function() {
		// TO pass list of UIDS/emailIds
		var uids = DOTB.email2.listView.getUidsFromSelection();
		var row = DOTB.email2.grid.getSelections()[0];
		var ieid = row.data.ieId;
	    var mbox = row.data.mbox;
        AjaxObject.startRequest(callbackAssignmentAction, urlStandard + '&emailUIAction=' + "doAssignmentDelete&uids=" + uids + "&ieId=" + ieId + "&folder=" + mbox);
        DOTB.email2.contextMenus.assignmentDialog.hide();
		DOTB.showMessageBox(app_strings.LBL_EMAIL_PERFORMING_TASK, app_strings.LBL_EMAIL_ONE_MOMENT);

		// AJAX Call

	},

	showEmailDetailView : function(o) {
        DOTB.hideMessageBox();
        var SED = DOTB.email2.detailView;
		var ret = YAHOO.lang.JSON.parse(o.responseText);

		if(!SED.quickCreateDialog) {
			SED.quickCreateDialog = new YAHOO.widget.Dialog("emailDetailDialog", {
				modal:true,
				visible:false,
            	//fixedcenter:true,
            	constraintoviewport: true,
            	draggable: true,
				autofillheight: "body",
				shadow	: true
			});
			SED.quickCreateDialog.renderEvent.subscribe(function() {
            	var viewHeight = YAHOO.util.Dom.getViewportHeight();
            	var contH = 0;
            	for (var i in this.body.childNodes) {
            		if (this.body.childNodes[i].offsetHeight)
            			contH += this.body.childNodes[i].offsetHeight;
            	}
        		this.body.style.overflow = "auto";
        		this.body.style.width = "800px";
        		this.body.style.height = (viewHeight - 75 > contH ? (contH + 10) : (viewHeight - 75)) + "px";
        		this.center();
            }, SED.quickCreateDialog);

            // dialog contents may override current drag-n-drop mode
            // so restore it when the dialog is hidden (bug #49330)
            var mode = YAHOO.util.DDM.mode;
            SED.quickCreateDialog.hideEvent.subscribe(function() {
                YAHOO.util.DDM.mode = mode;
            });
		}
		SED.quickCreateDialog.setHeader(app_strings.LBL_EMAIL_RECORD);
		SED.quickCreateDialog.setBody(ret.html);
		SED.quickCreateDialog.render();
        DOTB.util.evalScript(ret.html);
        SED.quickCreateDialog.show();
	},

	showAssignmentDialogWithData : function(o) {
        var SEC = DOTB.email2.contextMenus;
		DOTB.hideMessageBox();
        var ret = YAHOO.lang.JSON.parse(o.responseText);
        if (!SEC.assignmentDialog) {
	        SEC.assignmentDialog = new YAHOO.widget.Dialog("assignmentDialog", {
	        	visible:false,
            	fixedcenter:true,
            	constraintoviewport: true,
	        	modal   : true
	        });
	        SEC.assignmentDialog.setBody("");
	        SEC.assignmentDialog.setHeader(app_strings.LBL_EMAIL_ASSIGNMENT);
	        SEC.assignmentDialog.renderEvent.subscribe(function() {
            	var iev = YAHOO.util.Dom.get("Distribute");
            	if (iev) {
            		this.body.style.width = "700px";
            	}
            },  SEC.assignmentDialog);
	        SEC.assignmentDialog.render();
        }
        SEC.assignmentDialog.setBody(ret);
        SEC.assignmentDialog.render();
        validate = [];
        SEC.assignmentDialog.show();
        DOTB.util.evalScript(ret);
	},

	showImportForm : function(o) {
		var SED = DOTB.email2.detailView;
		var ret = YAHOO.lang.JSON.parse(o.responseText);
        
        document.getElementById('quickCreateContent').innerHTML = "";
        DOTB.hideMessageBox();
        if (!ret) {
            return false;
        }

        if(!SED.importDialog) {
            SED.importDialog = new YAHOO.widget.Dialog("importDialog", {
            	modal:true,
            	visible:false,
            	fixedcenter:true,
            	constraintoviewport: true,
                buttons : [{
                	text: app_strings.LBL_EMAIL_ARCHIVE_TO_DOTB, isDefault: true, handler: function(){
                		AjaxObject.detailView.getImportAction(SED.importDialog.ret); }
                }]
            });
            SED.importDialog.setHeader(app_strings.LBL_EMAIL_IMPORT_SETTINGS);
            SED.importDialog.setBody("");
            SED.importDialog.hideEvent.subscribe(function(){
            	for(var i in QSFieldsArray) {
            		if (QSFieldsArray[i] != null && typeof(QSFieldsArray[i]) == "object") {
	            		QSFieldsArray[i].destroy();
	            		delete QSFieldsArray[i];
            		}
            		if (QSProcessedFieldsArray[i]) {
            			QSProcessedFieldsArray[i] = false;
            		} // if
				}
            });
            SED.importDialog.renderEvent.subscribe(function() {
            	var iev = YAHOO.util.Dom.get("ImportEditView");
            	if (iev) {
            		this.body.style.width = "600px";
            	}
            }, SED.importDialog);
            SED.importDialog.render();
        } // end lazy load
        SED.importDialog.setBody(ret.html);
        SED.importDialog.ret = ret;
        DOTB.util.evalScript(ret.html);
        SED.importDialog.render();
        validate = [];
        SED.importDialog.show();
        SED.importDialog.focusFirstButton();
    },
    getImportAction : function(ret) {
        if (!check_form('ImportEditView')) return false;
        if (!DOTB.collection.prototype.validateTemSet('ImportEditView', 'team_name')) {
        	alert(mod_strings.LBL_EMAILS_NO_PRIMARY_TEAM_SPECIFIED);
        	return false;
        } // if
		var get = "";
        var editView = document.getElementById('ImportEditView');
        var teamIdsArray = DOTB.collection.prototype.getTeamIdsfromUI('ImportEditView', 'team_name');
		if (teamIdsArray != null && teamIdsArray.length > 0)   {
            get = get + "&team_ids=" + teamIdsArray.join(",") + "&primary_team_id=" + DOTB.collection.prototype.getPrimaryTeamidsFromUI('ImportEditView', 'team_name');
        }
        var selTeamIdsArray = DOTB.collection.prototype.getSelectedTeamIdsFromUI('ImportEditView', 'team_name');
        if (selTeamIdsArray != null && selTeamIdsArray.length > 0) {
            get += "&selected_team_ids=" + selTeamIdsArray.join(",");
        }
        if (editView.assigned_user_id != null) {
            get = get + "&user_id=" + editView.assigned_user_id.value
        }
        var parent_id = editView.parent_id.value;
        var parent_type = editView.parent_type.value;
        var row = DOTB.email2.grid.getSelectedRows()[0];
        row = DOTB.email2.grid.getRecord(row);
        var data = row.getData();
        var ieId = data.ieId;
        var mbox = data.mbox;
        var serverDelete = editView.serverDelete.checked;
        var emailUids = DOTB.email2.listView.getUidsFromSelection();
        var uids = "";
        for(i=0; i<emailUids.length; i++) {
            if(uids != '') {
                uids += app_strings.LBL_EMAIL_DELIMITER;
            }
            uids += emailUids[i];
        }

        var action = 'importEmail&uid=';
        if (ret.move) {
            action = 'moveEmails';
            action = action + '&sourceFolder=' + ret['srcFolder'];
            action = action + '&sourceIeId=' + ret['srcIeId'];
            action = action + '&destinationFolder=' + ret['dstFolder'];
            action = action + '&destinationIeId=' + ret['dstIeId'];
            action = action + '&emailUids=';
        }
        if (action.search(/importEmail/) != -1) {
            DOTB.showMessageBox(app_strings.LBL_EMAIL_IMPORTING_EMAIL, app_strings.LBL_EMAIL_ONE_MOMENT);
        } else {
            DOTB.showMessageBox("Moving Email(s)", app_strings.LBL_EMAIL_ONE_MOMENT);
        }

        AjaxObject.startRequest(callbackStatusForImport, urlStandard + '&emailUIAction=' + action + uids + "&ieId=" + ieId + "&mbox=" + mbox +
        get + "&parent_id=" + parent_id + "&parent_type=" + parent_type + '&delete=' + serverDelete);
        DOTB.email2.detailView.importDialog.hide();
        document.getElementById('importDialogContent').innerHTML = "";

    },
    showRelateForm : function(o) {
        var SED = DOTB.email2.detailView;
    	var ret = YAHOO.lang.JSON.parse(o.responseText);
        document.getElementById('quickCreateContent').innerHTML = "";
        DOTB.hideMessageBox();
        if (!ret) {
            return false;
        }
        dialog_loaded = true;

        if(!SED.relateDialog) {
            SED.relateDialog = new YAHOO.widget.Dialog('relateDialog', {
				modal:true,
				visible:true,
            	fixedcenter:true,
            	width: '800px',
            	constraintoviewport: true,
				buttons : [{
                	text: app_strings.LBL_EMAIL_RELATE_TO, isDefault: true, handler: function(){
    					if (!check_form('RelateEditView')) return false;
    					var get = "";
    	                var editView = document.getElementById('RelateEditView');
    	                var parent_id = editView.parent_id.value;
    	                var parent_type = editView.parent_type.value;
    	                var row = DOTB.email2.grid.getSelectedRows()[0];
    	                row  = DOTB.email2.grid.getRecord(row);
    	                var ieId = row.getData().ieId;
    	                var mbox = row.getData().mbox;
    	                var emailUids = DOTB.email2.listView.getUidsFromSelection();
    	                var uids = "";
    	                for(i=0; i<emailUids.length; i++) {
    	                    if(uids != '') {
    	                        uids += app_strings.LBL_EMAIL_DELIMITER;
    	                    }
    	                    uids += emailUids[i];
    	                }
    	                DOTB.showMessageBox(app_strings.LBL_EMAIL_PERFORMING_TASK, app_strings.LBL_EMAIL_ONE_MOMENT);
    	                AjaxObject.startRequest(callbackStatusForImport, urlStandard + '&emailUIAction=relateEmails&uid=' + uids
    	                    + "&ieId=" + ieId + "&mbox=" + mbox + "&parent_id=" + parent_id + "&parent_type=" + parent_type);
    	                SED.relateDialog.hide();
    	                document.getElementById('relateDialogContent').innerHTML = "";
	                }
                }]
			});

            SED.relateDialog.hideEvent.subscribe(function(){
            	if (QSFieldsArray['ImportEditView_parent_name'] != null) {
            		QSFieldsArray['ImportEditView_parent_name'].destroy();
            		delete QSFieldsArray['ImportEditView_parent_name'];
            	} // if
				if (QSProcessedFieldsArray['ImportEditView_parent_name']) {
					QSProcessedFieldsArray['ImportEditView_parent_name'] = false;
				} // if
            });

            SED.relateDialog.renderEvent.subscribe(function() {
            	var viewPortHeight = YAHOO.util.Dom.getViewportHeight();
            	var contH = 0;
            	for (var i in this.body.childNodes) {
            		if (this.body.childNodes[i].clientHeight)
            			contH += this.body.childNodes[i].clientHeight;
            	}
            }, SED.relateDialog);
            SED.relateDialog.setHeader(app_strings.LBL_EMAIL_RELATE_EMAIL);
		} // end lazy load

        SED.relateDialog.setBody(ret.html);
        SED.relateDialog.render();
        DOTB.util.evalScript(ret.html);
        SED.relateDialog.show();
    }
};
/**
 * DetailView callbacks
 */
AjaxObject.detailView.callback = {
	emailDetail : {
		success	: function(o) {
			DOTB.email2.o = o;
			var ret = YAHOO.lang.JSON.parse(o.responseText);
			DOTB.email2.detailView.consumeMetaDetail(ret);
		},
		argument: [targetDiv],
		failure	: AjaxObject.handleFailure,
		timeout	: 0,
		scope	: AjaxObject
	},
	emailPreview : {
		success	: function(o) {
			DOTB.email2.o = o;
			var ret = YAHOO.lang.JSON.parse(o.responseText);
			DOTB.email2.detailView.consumeMetaPreview(ret);
		},
		failure	: AjaxObject.handleFailure,
		timeout	: 0,
		scope	: AjaxObject
	},
	viewPrint : {
		success	: AjaxObject.detailView.displayPrintable,
		failure	: AjaxObject.handleFailure,
		timeout	: AjaxObject.timeout,
		scope	: AjaxObject
	},
	viewRaw : {
		success	: AjaxObject.detailView.displayView,
		failure	: AjaxObject.handleFailure,
		timeout	: AjaxObject.timeout,
		scope	: AjaxObject
	}
};

AjaxObject.folders = {
	/**
	 * check-mail post actions
	 */
	checkMailCleanup : function(o) {
		DOTB.hideMessageBox();
		AjaxObject.folders.rebuildFolders(o); // rebuild TreeView

		// refresh focus ListView
		SE.listView.refreshGrid();
		DOTB.email2.folders.startCheckTimer(); // resets the timer
	},

	/**
	 */
	rebuildFolders : function(o) {
		DOTB.hideMessageBox();

		var data = YAHOO.lang.JSON.parse(o.responseText);

		email2treeinit(DOTB.email2.tree, data.tree_data, 'frameFolders', data.param);
		DOTB.email2.folders.setDotbFolders();
	}
};
AjaxObject.folders.callback = {
	checkMail : {
		success	: AjaxObject.folders.checkMailCleanup,
		failure	: AjaxObject.handleFailure,
		timeout	: 600000, // 5 mins
		scope	: AjaxObject
	}
}

AjaxObject.rules = {
	loadRulesForSettings : function(o) {
		document.getElementById("rulesListCell").innerHTML = o.responseText;
		// assume we have the class we need
		DOTB.routing.getStrings();
		DOTB.routing.getDependentDropdowns();
	}
};
////	END PER MODULE CALLBACK OBJECTS
///////////////////////////////////////////////////////////////////////////


var callback = {
	success	: AjaxObject.handleSuccess,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackAccount = {
	success	: AjaxObject.ieSaveSuccess,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackAccountDelete = {
	success	: AjaxObject.ieDeleteSuccess,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackOutboundTest = {
	success	: AjaxObject.ieSendSuccess,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};



var callbackTeamInfoForSettings = {
success : function (o) {
	var data = YAHOO.lang.JSON.parse(o.responseText);
	document.getElementById('EditViewGroupFolderTeamTD').innerHTML = data.defaultgroupfolder;
},
failure	: AjaxObject.handleFailure,
timeout	: AjaxObject.timeout,
scope	: AjaxObject

};

var callbackStatusForImport = {
success : function (o) {
	DOTB.hideMessageBox();
	if (o.responseText != "")  {
		var statusString = "";
		var data = YAHOO.lang.JSON.parse(o.responseText);
		for(i=0; i<data.length; i++) {
			statusString = statusString + data[i] + '<br/>';
		}
		DOTB.showMessageBox(DOTB.language.get('Emails','LBL_IMPORT_STATUS_TITLE'), statusString, 'alert');
	}
	SE.listView.refreshGrid();

},
failure	: AjaxObject.handleFailure,
timeout	: AjaxObject.timeout,
scope	: AjaxObject

};
var callbackComposeCache = {
	success	: AjaxObject.composeCache,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackDelete = {
	success	: AjaxObject.handleDeleteReturn,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackEmailDetailMultiple = {
	success	: function(o) {
		DOTB.hideMessageBox();
        var retMulti = YAHOO.lang.JSON.parse(o.responseText);
		var ret = new Object();

		for(var i=0; i<retMulti.length; i++) {
			ret = retMulti[i];

			DOTB.email2._setDetailCache(ret);
			DOTB.email2.detailView.populateDetailView(ret.meta.uid, ret.meta.mbox, ret.meta.ieId, true, DOTB.email2.innerLayout);
		}
	},
	failure	: AjaxObject.handleFailure,
	timeout	: 0,
	scope	: AjaxObject
};
var callbackListViewSortOrderChange = {
	success	: AjaxObject.saveListViewSortOrderPart2,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject,
	argument	: [ieId, ieName, focusFolder]
};
var callbackEmptyTrash = {
	success	: function(o) {
		DOTB.hideMessageBox();
		AjaxObject.folderRenameCleanup;
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackClearCacheFiles = {
	success	: function(o) {
		DOTB.hideMessageBox();
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackFolderRename = {
	success	: function(o) {DOTB.hideMessageBox();DOTB.email2.folders.rebuildFolders();},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackFolderDelete = {
	success	: function(o) {
		var ret = YAHOO.lang.JSON.parse(o.responseText);
		if (ret.status) {
		    if (ret.folder_id) {
		        var node = DOTB.email2.folders.getNodeFromId(ret.folder_id);
		        if(node)
		        	DOTB.email2.tree.removeNode(node, true);
		    } else if (ret.ieId && ret.mbox) {
		        var node = DOTB.email2.folders.getNodeFromIeIdAndMailbox(ret.ieId, ret.mbox);
		        if(node)
		        	DOTB.email2.tree.removeNode(node, true);
		    }
			DOTB.hideMessageBox();
		} else {
			DOTB.hideMessageBox();
			DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, ret.errorMessage, 'alert');
		} // else
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackFolderSave = {
	success	: function(o) {
		var ret = YAHOO.lang.JSON.parse(o.responseText);

		switch(ret.action) {
			case 'newFolderSave':
				DOTB.email2.folders.rebuildFolders();
			break;
		}
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackFolderSubscriptions = {
	success	: AjaxObject.updateFolderSubscriptions,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackFolderUpdate = {
	success	: AjaxObject.updateFrameFolder,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackFolders = {
	success	: AjaxObject.folders.rebuildFolders,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackFullSync = {
	success	: AjaxObject.fullSyncCleanup,
	failure	: AjaxObject.handleFailure,
	timeout	: 9999999999999,
	scope	: AjaxObject
};
var callbackGeneric = {
	success	: function() {
		DOTB.hideMessageBox();
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackIeAccountRetrieve = {
	success	: function(o) {
		// return JSON encoding
		DOTB.hideMessageBox();
		DOTB.email2.accounts.fillIeAccount(o.responseText);
		DOTB.email2.accounts.showEditInboundAccountDialogue(false);
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackImportOneEmail = {
	success :  AjaxObject.detailView.showImportForm,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackRelateEmail = {
    success : AjaxObject.detailView.showRelateForm,
    failure : AjaxObject.handleFailure,
    timeout : AjaxObject.timeout,
    scope   : AjaxObject
}
var callbackEmailDetailView = {
    success : AjaxObject.detailView.showEmailDetailView,
    failure : AjaxObject.handleFailure,
    timeout : AjaxObject.timeout,
    scope   : AjaxObject
}
var callbackAssignmentDialog = {
	success :  AjaxObject.detailView.showAssignmentDialogWithData,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackAssignmentAction = {
	success :  function(o) {
		SE.listView.refreshGrid();
		DOTB.hideMessageBox();
		if(o.responseText != '') {
	       DOTB.showMessageBox(mod_strings.LBL_ASSIGNMNT_ACT_RESULT, o.responseText, 'alert');
	    } // if
	} ,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackMoveEmails = {
	success :  function(o) {
	    SE.listView.refreshGrid();
		DOTB.hideMessageBox();
		if(o.responseText != '') {
	       DOTB.showMessageBox(app_strings.LBL_EMAIL_ERROR_DESC, o.responseText, 'alert');
	    } // if
	} ,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackLoadAttachments = {
	success	: AjaxObject.loadAttachments,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackLoadRules = {
	success	: AjaxObject.rules.loadRulesForSettings,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackLoadSignature = {
	success	: AjaxObject.loadSignature,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackDeleteSignature = {
	success	: AjaxObject.handleDeleteSignature,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackOutboundSave = {
	success	: AjaxObject.accounts.saveOutboundCleanup,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackDefaultOutboundSave = {
	success	: AjaxObject.accounts.saveDefaultOutboundCleanup,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackQuickCreate = {
	success	: AjaxObject.detailView.showQuickCreateForm,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackQuickCreateSave = {
	success	: AjaxObject.detailView.saveQuickCreateForm,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackQuickCreateSaveAndAddToAddressBook = {
	success	: AjaxObject.detailView.saveQuickCreateFormAndAddToAddressBook,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackQuickCreateSaveAndReply = {
    success : AjaxObject.detailView.saveQuickCreateFormAndReply,
    failure : AjaxObject.handleFailure,
    timeout : AjaxObject.timeout,
    scope   : AjaxObject
}
var callbackQuickCreateSaveAndReplyCase = {
    success : AjaxObject.detailView.saveQuickCreateFormAndReplyCase,
    failure : AjaxObject.handleFailure,
    timeout : AjaxObject.timeout,
    scope   : AjaxObject
}
var callbackRebuildShowAccountList = {
	success	: AjaxObject.rebuildShowFolders,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};

var callbackRefreshDotbFolders = {
	success	: function(o) {
		var t = YAHOO.lang.JSON.parse(o.responseText);
		DOTB.email2.folders.setDotbFoldersEnd(t);
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackReplyForward = {
	success	: AjaxObject.handleReplyForward,
	finish : function(a, retryCount,isReOrFwDraft) {
		if (typeof(retryCount) == 'undefined') {
			retryCount = 0;
		} else {
			retryCount++;
		}
		if (typeof(isReOrFwDraft) == 'undefined') {
			isReOrFwDraft = 0;
		}
		var idx = DOTB.email2.composeLayout.currentInstanceId;
		var t = tinyMCE.getInstanceById('htmleditor' + idx);
        try {
			var html = t.getContent();

            html = "&nbsp;";
            //add hr tag if this is not a reply draft or forward draft
            if(!isReOrFwDraft){
                html += "<div><hr></div>";
            }
            html += SE.util.nl2br(a.description);

			t.setContent(html);//

            if (a.type != 'draft') {
                // Next step, attach signature
                DOTB.email2.composeLayout.resizeEditorSetSignature(idx,true);
            }

		} catch(e) {
			if (retryCount < 5) {
				setTimeout("callbackReplyForward.finish(globalA, " + retryCount + ");", 500);
				return;
			}
		}
		var tabArray = DOTB.email2.innerLayout.get("tabs");
		if (tabArray != null && tabArray.length > 0) {
			for (i = 0 ; i < tabArray.length ; i++) {
				var tabObject = tabArray[i];
				if (tabObject.get("id") == ("composeTab" + idx)) {
					var tabLabel = a.name;
			        if (tabLabel != null && tabLabel.length > 25) {
			        	tabLabel = tabLabel.substring(0, 25) + "...";
			        } // if
					tabObject.get("labelEl").firstChild.data = tabLabel;
					break;
				}
			}
		}

		if (a.parent_name != null && a.parent_name != "") {
			document.getElementById('data_parent_name' + idx).value = a.parent_name;
		}
		if (a.parent_type != null && a.parent_type != "") {
			document.getElementById('data_parent_type' + idx).value = a.parent_type;
		}
		if (a.parent_id != null && a.parent_id != "") {
			document.getElementById('data_parent_id' + idx).value = a.parent_id;
		}
		if (a.fromAccounts.status) {
			var addressFrom = document.getElementById('addressFrom' + idx);
	        DOTB.email2.util.emptySelectOptions(addressFrom);
	        var fromAccountOpts = a.fromAccounts.data;
	        for(i=0; i<fromAccountOpts.length; i++) {
	              var key = fromAccountOpts[i].value;
	              var display = fromAccountOpts[i].text;
	              var opt = new Option(display, key);
	              if (fromAccountOpts[i].selected) {
	              	opt.selected = true;
	              }
	              addressFrom.options.add(opt);
	        }
		} // if
		DOTB.hideMessageBox();

	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject,
	argument	: [sendType]
};
var callbackSendEmail = {
	success	: AjaxObject.sendEmailCleanUp,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackSettings = {
	success	: AjaxObject.updateUserPrefs,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackSettingsFolderRefresh = {
	success	: AjaxObject.settingsFolderRefresh,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackLoadSettingFolder = {
	success	: function(o) {
		AjaxObject.settingsFolderRefresh(o);
		DOTB.email2.accounts.rebuildFolderList(); // refresh frameFolder
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject

};
var callbackUploadAttachment = {
	success	: AjaxObject.uploadAttachmentSuccessful,
	upload	: AjaxObject.uploadAttachmentSuccessful,
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};
var callbackUserPrefs = {
	success	: function(o) {
		DOTB.email2.userPrefs = YAHOO.lang.JSON.parse(o.responseText);
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};

var callbackContextmenus = {
	markUnread : {
		success : AjaxObject.markEmailCleanup,
		failure : AjaxObject.handleFailure,
		timeout : AjaxObject.timeout,
		scope   : AjaxObject
	}
};
var updateMailingLists = {
	success	: function(o) {
		DOTB.email2.userPrefs.emailLists = YAHOO.lang.JSON.parse(o.responseText);
		DOTB.email2.addressBook.setLists();
	},
	failure	: AjaxObject.handleFailure,
	timeout	: AjaxObject.timeout,
	scope	: AjaxObject
};

var callbackCheckEmail2 = {
	success : function(o) {
        var ret = YAHOO.lang.JSON.parse(o.responseText);
		DOTB.showMessageBox(app_strings.LBL_EMAIL_CHECKING_NEW, ret.text);


	},
	failure : AjaxObject.handleFailure,
	timeout : AjaxObject.timeout,
	scope	: AjaxObject
}
