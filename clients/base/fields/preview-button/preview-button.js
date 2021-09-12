
({
    extendsFrom: 'RowactionField',

    /**
     * True if the preview button is for a BWC module, false if not
     * @property {boolean}
     */
    isBwcEnabled: undefined,

    /**
     * Holds the proper tooltip label key
     */
    tooltip: undefined,

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        var fieldModule = options.model.get('_module');
        this.isBwcEnabled = app.metadata.getModule(fieldModule).isBwcEnabled;

        this._super('initialize', [options]);

        if(this.isBwcEnabled) {
            this.tooltip = 'LBL_PREVIEW_BWC_TOOLTIP';
        } else {
            this.tooltip = this.def.tooltip;
        }
    }
})
