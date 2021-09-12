var callcenters = [];
var CALLCENTER = {
    dial: function (options) {
        var self = this;
        var data = {phone_number: '', bean_name: '', bean_id: ''};
        options = _.extend(data, options);
        App.api.call('update', App.api.buildURL('callcenter', 'dial'), {phone: options.phone_number}, {
            success: function (res) {
                if (res.message == "success") {
                    self.show({
                        from: res.from,
                        to: res.to,
                        bean_name: options.bean_name,
                        bean_id: options.bean_id,
                    })
                } else {
                    App.alert.show('message-id', {
                        level: 'error',
                        messages: App.lang.get('LBL_CAN_NOT_DIAL_CALLCENTER'),
                        autoClose: true
                    });
                }
            }
        });
    },
    show: function (options) {
        if (typeof options.from == "undefined" || typeof options.to == "undefined") this.create(options);
        else {
            var n = callcenters.length;
            var has = false;
            for (var i = 0; i < n; i++) {
                if (callcenters[i].callData.from == options.from && callcenters[i].callData.to == options.to) {
                    callcenters[i].update(options);
                    has = true;
                    break;
                }
            }
            if (!has) this.create(options);
        }
    },
    create: function (options) {
        var data = {callid: new Date().getTime(), from: '', to: '', event: 'waiting', bean_id: '', bean_name: '', direction: 'out'};
        data = _.extend(data, options);
        var c = App.view.createView({
            type: 'callCenter',
            callData: {
                callid: data.callid,
                from: data.from,
                to: data.to,
                event: data.event,
                bean_id: data.bean_id,
                bean_name: data.bean_name,
                direction: data.direction
            }
        });
        c.show();
        callcenters.push(c);
    }
};
$(document).ready(function () {
    var socket = io.connect(':9201');
    socket.on('connect', function () {
        socket.emit('login', JSON.stringify({
            user_id: App.user.id
        }));
        socket.on('message', function (data) {
            data = JSON.parse(data);
            console.log(data);
            CALLCENTER.show({
                callid: data.callid,
                from: data.from,
                to: data.to,
                event: data.event,
                time: data.time
            });
        });
        socket.on('connected', function (res) {
            console.log('Call Center is connected!');
        });
    });
});