
var AjaxObject = {
	ret : '',
	currentRequestObject : null,
	timeout : 300000, // 5 minutes timeout, sometime response time may over 30 seconds
	forceAbort : false,
	
	/**
	 */
	_reset : function() {
		this.timeout = 300000;
		this.forceAbort = false;
	},
    handleFailure : function(o) {
    	alert(DOTB.language.get('Administration', 'LBL_ASYNC_CALL_FAILED'));
	},
	/**
	 */
	startRequest : function(callback, args, forceAbort) {
		if(this.currentRequestObject != null) {
			if(this.forceAbort == true || callback.forceAbort == true) {
				YAHOO.util.Connect.abort(this.currentRequestObject, null, false);
			}
		}
		
		this.currentRequestObject = YAHOO.util.Connect.asyncRequest('POST', "./index.php?module=Administration&action=Async&to_pdf=true", callback, args);
		this._reset();
	},
	
	/**************************************************************************
	 * Place callback handlers below this comment
	 **************************************************************************/
	 
	/**
	 * gets an estimate of how many rows to process
	 */
	refreshEstimate : function(o) {
		this.ret = YAHOO.lang.JSON.parse(o.responseText);
		document.getElementById('repairXssDisplay').style.display = 'inline';
		document.getElementById('repairXssCount').value = this.ret.count;
		
		DOTB.Administration.RepairXSS.toRepair = this.ret.toRepair;
	},
	showRepairXssResult : function(o) {
		var resultCounter = document.getElementById('repairXssResultCount');
		
		this.ret = YAHOO.lang.JSON.parse(o.responseText);
		document.getElementById('repairXssResults').style.display = 'inline';
		
		if(this.ret.msg == 'success') {
			DOTB.Administration.RepairXSS.repairedCount += this.ret.count;
			resultCounter.value = DOTB.Administration.RepairXSS.repairedCount;
		} else {
			resultCounter.value = this.ret;
		}
		
		DOTB.Administration.RepairXSS.executeRepair();
	}
};

/*****************************************************************************
 *	MODEL callback object:
 * ****************************************************************************
	var callback = {
		success:AjaxObject.handleSuccess,
		failure:AjaxObject.handleFailure,
		timeout:AjaxObject.timeout,
		scope:AjaxObject,
		forceAbort:true, // optional
		argument:[ieId, ieName, focusFolder] // optional
	};
 */

var callbackRepairXssRefreshEstimate = {
	success:AjaxObject.refreshEstimate,
	failure:AjaxObject.handleFailure,
	timeout:AjaxObject.timeout,
	scope:AjaxObject
};
var callbackRepairXssExecute = {
	success:AjaxObject.showRepairXssResult,
	failure:AjaxObject.handleFailure,
	timeout:AjaxObject.timeout,
	scope:AjaxObject
};
