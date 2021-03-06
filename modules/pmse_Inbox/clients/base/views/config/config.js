
({
//    extendsFrom :'RecordView',
//    className: 'settings',

    events: {
        //'click .dotb-cube': 'spinCube'
    },
    initialize: function(options) {
        if (app.acl.hasAccessToAny('developer')) {
            var self=this;
            var url = app.api.buildURL('pmse_Inbox', 'settings', null, options.params);
            app.api.call('READ', url, options.attributes, {
                success: function (data) {
                    self.model.set(data);
                }
            });
            this._super('initialize', [options]);
        } else {
            app.controller.loadView({
                layout: 'access-denied'
            });
        }
    }
})
