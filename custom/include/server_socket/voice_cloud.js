window.callcenter_supplier_voicecloud = {
    initServer: function () {
        window.callcenter_socketio = io.connect(App.config.site_url + '/' + window.callcenter_config.port);
        window.callcenter_socketio.on('connect', function () {
            window.callcenter_socketio.emit('login', JSON.stringify({user_id: app.user.id}));
            window.callcenter_socketio.on('login', function (res) {
                res = JSON.parse(res);
                console.log(res);
            });
            window.callcenter_socketio.on('connected', function (res) {
                res = JSON.parse(res);
                console.log(res);
            });
            window.callcenter_socketio.on('hangup', function (res) {
                res = JSON.parse(res);
                console.log(res);
            });
            window.callcenter_socketio.on('comming', function (res) {
                res = JSON.parse(res);
                console.log(res);
            });
        });
    }
};
window.callcenter_supplier_voicecloud.initServer();
