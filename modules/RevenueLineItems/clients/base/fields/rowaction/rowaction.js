
({
    extendsFrom: "RowactionField",
    
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.clone(this.plugins) || [];

        if (!options.context.get('isCreateSubpanel')) {
            // if this is not a create subpanel, add the DisableDelete plugin
            // on a create subpanel, don't add the plugin so users can delete rows
            this.plugins.push('DisableDelete');
        }

        this._super("initialize", [options]);
    }
})
