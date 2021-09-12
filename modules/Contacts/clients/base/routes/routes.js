(function (app) {
    DOTB.App.events.on("router:init", function () {
        var routes = [
            {
                route: 'Contacts/SendSMS',
                name: 'sendSMS',
                callback: function () {
                    app.router.redirect('bwc/index.php?module=Contacts&action=SendSMS');
                }
            }
        ];
        DOTB.App.router.addRoutes(routes);
    })
})(DOTB.App);
