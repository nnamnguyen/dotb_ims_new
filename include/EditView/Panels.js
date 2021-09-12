

function initPanel(id, state) {
    panelId = 'detailpanel_' + id;
    expandPanel(id);
    if(state == 'collapsed') {
        collapsePanel(id);
    }
}

function expandPanel(id) {
    var panelId = 'detailpanel_' + id;
    document.getElementById(panelId).className = document.getElementById(panelId).className.replace(/(expanded|collapsed)/ig, '') + ' expanded';
}

function collapsePanel(id) {
    var panelId = 'detailpanel_' + id;
    document.getElementById(panelId).className = document.getElementById(panelId).className.replace(/(expanded|collapsed)/ig, '') + ' collapsed';
}

function setCollapseState(mod, panel, isCollapsed) {
    var dotb_panel_collase = Get_Cookie("dotb_panel_collase");
    if(dotb_panel_collase == null) {
        dotb_panel_collase = {};
    } else {
        dotb_panel_collase = YAHOO.lang.JSON.parse(dotb_panel_collase);
    }
    dotb_panel_collase[mod] = dotb_panel_collase[mod] || {};
    dotb_panel_collase[mod][panel] = isCollapsed;

    Set_Cookie('dotb_panel_collase', YAHOO.lang.JSON.stringify(dotb_panel_collase),30,'/','','');
}