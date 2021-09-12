


DOTB.dashlets = function() {
	return {
		/**
		 * Generic javascript method to use post a form 
		 * 
		 * @param object theForm pointer to the form object
		 * @param function callback function to call after for form is sent
		 *
		 * @return bool false
		 */ 
		postForm: function(theForm, callback) {	
			var success = function(data) {
				if(data) {
					callback(data.responseText);
				}
			}
			YAHOO.util.Connect.setForm(theForm); 
			var cObj = YAHOO.util.Connect.asyncRequest('POST', 'index.php', {success: success, failure: success});
			return false;
		},
		/**
		 * Generic javascript method to use Dashlet methods
		 * 
		 * @param string dashletId Id of the dashlet being call
		 * @param string methodName method to be called (function in the dashlet class)
		 * @param string postData data to send (eg foo=bar&foo2=bar2...)
		 * @param bool refreshAfter refreash the dashlet after sending data
		 * @param function callback function to be called after dashlet is refreshed (or not refresed) 
		 */ 
		callMethod: function(dashletId, methodName, postData, refreshAfter, callback) {
        	ajaxStatus.showStatus(DOTB.language.get('app_strings', 'LBL_SAVING'));
        	response = function(data) {
        		ajaxStatus.hideStatus();
				if(refreshAfter) DOTB.myDotb.retrieveDashlet(dashletId);
				if(callback) {
					callback(data.responseText);
				}
        	}
	    	post = 'to_pdf=1&module=Home&action=CallMethodDashlet&method=' + methodName + '&id=' + dashletId + '&' + postData;
			var cObj = YAHOO.util.Connect.asyncRequest('POST','index.php', 
							  {success: response, failure: response}, post);
		}
	 };
}();

if(DOTB.util.isTouchScreen() && typeof iScroll == 'undefined') {

	with (document.getElementsByTagName("head")[0].appendChild(document.createElement("script")))
	{
		setAttribute("id", "newScript", 0);
		setAttribute("type", "text/javascript", 0);
		setAttribute("src", "include/javascript/iscroll.js?v="+DOTB.VERSION_MARK, 0);
	}

}