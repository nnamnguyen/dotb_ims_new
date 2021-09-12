

/**
 * @author dwheeler
 */
//Load up the YUI loader and go!
DOTB.yui = {
	loader : new YAHOO.util.YUILoader({
        // Bug #48940 Skin always must be blank
        skin: {
            base: 'blank',
            defaultSkin: ''
        }
    })
} 

DOTB.yui.loader.addModule({
	name:'dotbwidgets',
	type:'js', 
	path:'DotbYUIWidgets.js', 
	requires:['yahoo', 'layout', 'dragdrop', 'treeview', 'json', 'datatable', 'container', 'button', 'tabview'], 
	varname: YAHOO.DOTB
});
