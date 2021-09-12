({
    extendsFrom: 'RowactionField',
    initialize: function (options) {
        this._super("initialize", [options]);
        this.type = 'rowaction';
    },

    _render: function () {
        debugger;
        var value = this.model.get('prj_status');

        if (value === 'ACTIVE') {
            this.def.tooltip = App.lang.get("LBL_PMSE_LABEL_DISABLE", "pmse_Project");
            this.label = App.lang.get("LBL_PMSE_LABEL_DISABLE", "pmse_Project");
        } else {
            this.def.tooltip = App.lang.get("LBL_PMSE_LABEL_ENABLE", "pmse_Project");
            this.label = App.lang.get("LBL_PMSE_LABEL_ENABLE", "pmse_Project");
        }

        this._super("_render");
    },

    bindDataChange: function () {
        if (this.model) {
            this.model.on("change", this.render, this);
        }
    }
})
