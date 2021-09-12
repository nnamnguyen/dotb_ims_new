
({
    extendsFrom: "RowactionField",
    
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.clone(this.plugins) || [];
        this.plugins.push('DisableDelete');
        this._super("initialize", [options]);
    }
})
