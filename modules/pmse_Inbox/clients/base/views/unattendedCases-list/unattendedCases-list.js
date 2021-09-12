
({
    extendsFrom: 'RecordlistView',
    contextEvents: {
        "list:reassign:fire": "reassignCase"
    },

    _render: function() {
        if (app.acl.hasAccessToAny('developer')) {
            this._super('_render');
        } else {
            app.controller.loadView({
                layout: 'access-denied'
            });
        }
    },
    reassignCase: function (model) {
        var self=this;
        app.drawer.open({
            layout: 'reassignCases',
            context: {
                module: 'pmse_Inbox',
                parent: this.context,
                cas_id: model.get('cas_id'),
                unattended: true
            }

        },
            function(variables) {
                if(variables==='saving'){
                    self.reloadList();
                }
            });
    },
    reloadList: function() {
        this.context.reloadData({
            recursive:false,
        });
    }
})
