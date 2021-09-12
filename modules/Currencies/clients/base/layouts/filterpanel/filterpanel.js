

({
    extendsFrom: 'FilterpanelLayout',

    /**
     * @inheritdoc
     */
    initialize: function(options) {

        this._super('initialize', [options]);

        if (this.context.get('layout') === 'record') {
            this.before('render', function() {
                return false;
            }, this);

            this.template = app.template.empty;
            this.$el.html(this.template());
        }
    }
})
