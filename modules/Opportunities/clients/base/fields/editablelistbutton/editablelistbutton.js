
({
    extendsFrom: 'EditablelistbuttonField',
    /**
     * extend save options
     * @param {Object} options save options.
     * @return {Object} modified success param.
     */
    getCustomSaveOptions: function(options) {
        // make copy of original function we are extending
        var origSuccess = options.success;
        // return extended success function with added alert
        return {
            success: _.bind(function() {
                if (_.isFunction(origSuccess)) {
                    origSuccess.apply(this, arguments);
                }

                if(this.context.parent) {
                    var oppsCfg = app.metadata.getModule('Opportunities', 'config'),
                        reloadLinks = ['opportunities'];
                    if (oppsCfg && oppsCfg.opps_view_by == 'RevenueLineItems') {
                        reloadLinks.push('revenuelineitems');
                    }

                    this.context.parent.set('skipFetch', false);

                    // reload opportunities subpanel
                    this.context.parent.trigger('subpanel:reload', {links: reloadLinks});
                }
            }, this)
        };
    }
});
