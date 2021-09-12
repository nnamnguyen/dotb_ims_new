
({
    extendsFrom: 'ListView',
    sidebarClosed: false,
    initialize: function(options) {
        this._super('initialize', [options]);
        // Once the sidebartoggle is rendered we close the sidebar so the arrows are updated SP-719
        app.controller.context.on('sidebarRendered', this.closeSidebar, this);
        // FIXME: This is a copy-paste from flex-list.js. Remove this when
        // doing TY-728
        this._fields = _.flatten(_.pluck(this.meta.panels, 'fields'));
    },
    closeSidebar: function() {
        if (!this.sidebarClosed) {
            app.controller.context.trigger('toggleSidebar');
            this.sidebarClosed = true;
        }
    }
})
