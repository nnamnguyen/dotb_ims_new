({
    extendsFrom: 'CreateView',

    /**
     * @inheritDoc
     */
    initialize: function(options) {
        app.alert.show("CreateDisabled",{level: 'info',autoClose: true, messages: app.lang.get('LBL_CREATE_DISABLED','ops_Backups')});
        app.router.navigate("ops_Backups", {trigger: true});
    }
})