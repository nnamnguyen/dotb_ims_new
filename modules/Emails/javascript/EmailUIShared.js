
DOTB.email2 = {
    cache : new Object(),
    o : null, // holder for reference to AjaxObject's return object (used in composeDraft())
    reGUID : new RegExp(/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/i),
    templates : {},
    tinyInstances : {
        currentHtmleditor : ''
    },

    /**
     * preserves hits from email server
     */ 
    _setDetailCache : function(ret) {
        if(ret.meta) {
            var compKey = ret.meta.mbox + ret.meta.uid;

            if(!DOTB.email2.cache[compKey]) {
                DOTB.email2.cache[compKey] = ret;
            }
        }
    },

    autoSetLayout : function() {
    	var c = document.getElementById('container');
        var tHeight = YAHOO.util.Dom.getViewportHeight() - YAHOO.util.Dom.getY(c) - 35;
        //Ensure a minimum height.
        tHeight = Math.max(tHeight, 550);
        c.style.height = tHeight + "px";
        DOTB.email2.complexLayout.set('height', tHeight);
        DOTB.email2.complexLayout.set('width', YAHOO.util.Dom.getViewportWidth() - 40);
        DOTB.email2.complexLayout.render();
        DOTB.email2.listViewLayout.resizePreview();        
    }
};


/**
 * Shows overlay progress message
 */

//overlayModal
DOTB.showMessageBoxModal = function(title, body) {
    DOTB.showMessageBox(title, body);
}

//overlay
DOTB.showMessageBox = function(reqtitle, body, type, additconfig) {
    var config = { };
    if (typeof(additconfig) == "object") {
        var config = additconfig;
    }
    config.type = type;
    config.title = reqtitle;
    config.msg = body;
    YAHOO.DOTB.MessageBox.show(config);
}

//hideOverlay
DOTB.hideMessageBox = function() {
	YAHOO.DOTB.MessageBox.hide();
};
