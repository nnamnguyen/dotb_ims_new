
({
    extendsFrom: 'FilterRowsView',

    /**
     * @inheritdoc
     */
    loadFilterFields: function(moduleName) {
        this._super('loadFilterFields', [moduleName]);

        var cfg = app.metadata.getModule("Forecasts", "config");
        if (cfg && cfg.is_setup === 1) {
            _.each(this.filterFields, function(field, key, list) {
                if (key.indexOf('_case') != -1) {
                    var fieldName = 'show_worksheet_' + key.replace('_case', '');
                    if (cfg[fieldName] !== 1) {
                        delete list[key];
                        delete this.fieldList[key];
                    }
                }
            }, this);
        } else {
            delete this.fieldList['commit_stage'];
            delete this.filterFields['commit_stage'];
        }
    }
})
