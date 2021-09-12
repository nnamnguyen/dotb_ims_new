

({
    extendsFrom: 'FilterpanelLayout',

    /**
     * @inheritdoc
     */
    initialize: function(options) {

        this._super('initialize', [options]);

        if (this.context.get('layout') === 'record') {
            var hasSubpanels = false,
                layouts = app.metadata.getModule(options.module, 'layouts');
            if (layouts && layouts.subpanels && layouts.subpanels.meta) {
                hasSubpanels = (layouts.subpanels.meta.components.length > 0);
            }

            if (!hasSubpanels) {
                this.before('render', function() {
                    return false;
                }, this);

                this.template = app.template.empty;
                this.$el.html(this.template());
            }
        }
    }
})
