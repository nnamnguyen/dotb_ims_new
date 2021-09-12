
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

                if (this.model && !_.isEmpty(this.model.get('quote_id'))) {
                    app.alert.show('save_rli_quote_notice', {
                        level: 'info',
                        messages: app.lang.get(
                            'SAVE_RLI_QUOTE_NOTICE',
                            'RevenueLineItems'
                        ),
                        autoClose: true
                    });
                }

                // trigger a save event across the parent context so listening components
                // know the changes made in this row has been saved
                if(this.context.parent) {
                    this.context.parent.trigger('editablelist:save', this.model);
                }
            }, this)
        };
    }
});
