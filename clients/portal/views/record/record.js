
({
    extendsFrom: 'RecordView',
    sidebarClosed: false,
    initialize: function(options) {
        this._super("initialize", [options]);
        // Once the sidebartoggle is rendered we close the sidebar so the arrows are updated SP-719
        app.controller.context.on("sidebarRendered", this.closeSidebar, this);
    },
    closeSidebar: function () {
        if (!this.sidebarClosed) {
            app.controller.context.trigger('toggleSidebar');
            this.sidebarClosed = true;
        }
    }
})
