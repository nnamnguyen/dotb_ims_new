({
    extendsFrom: 'HeaderpaneView',

    initialize: function (options) {
        this._super('initialize', [options]);
        this.title = app.lang.get('LBL_CONFIG_TITLE', this.module);

        this.context.on('settings:close', function () {
            app.router.goBack();
        });
    }
})
