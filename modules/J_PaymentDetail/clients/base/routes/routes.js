(function (app) {
    app.events.on("router:init", function (router) {
        var routes = [
            {
                route: 'J_PaymentDetail/:id/:action',
                name: 'J_PaymentDetail_Edit',
                callback: function (id, action) {
                    if(action === 'edit') {
                        var url ='J_PaymentDetail/'+id;
                        app.router.redirect(url);
                        app.alert.show('message-id', {
                            level: 'info',
                            messages: app.lang.get('LBL_PREVENT_EDIT_BALANCE', 'J_Balance'),
                            autoClose: false
                        });
                    }
                }
            },
        ];
        app.router.addRoutes(routes);
    })
})(DOTB.App);