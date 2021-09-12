({
    initialize: function (options) {
        this._super('initialize', [options]);
    },
    _renderHtml: function () {
        var _this = this;

        //init callcenter
        if (app.isSynced) {
            app.api.call("read", app.api.buildURL('callcenter/getScript'), null, {
                success: function (data) {
                    if (data.success === 1) {
                        _this.callcenterInit();
                        window.callcenter_supplier = data.supplier;
                        window.has_callcenter = true;
                        if (data.supplier === 'Asterisk') {
                            $("body").append(data.html);
                        } else if (data.supplier === 'VoiceCloud') {
                            window.callcenter_callcenter_domain = data.callcenter_domain;
                            window.callcenter_domain = data.domain;
                            window.callcenter_key = data.key;
                            window.callcenter_ext = data.ext;
                            _this.callcenterInitVoiceCloud();
                        } else if (data.supplier === 'Voip24h') {
                            window.callcenter_ext = data.ext;
                            window.callcenter_ip = data.ip;
                            window.callcenter_key = data.key;
                            window.callcenter_secret = data.secret;
                            _this.callcenterInitVoip24h();
                        }
                    } else {
                        window.has_callcenter = false;
                    }
                }
            });
        }

        this.isAuthenticated = app.api.isAuthenticated();
        this._super('_renderHtml');
    },
    callcenterInit: function () {
        window.callcenter = {
            exist: function (phone) {
                var result = false;
                $('.callbox').each(function () {
                    if ($(this).find('#phoneNumber').val() === phone) result = true;
                });
                return result;
            },
            createCallbox: function (phone, call_status, call_direction) {
                App.view.createView({type: 'callCenter', call_direction: call_direction, call_status: call_status, data: {phoneNumber: phone, beanName: '', beanId: ''}});
            },
            changeCallStatus: function (phone, call_status) {
                $('.callbox').each(function () {
                    var $this = $(this);
                    if ($this.find('#phoneNumber').val() === phone) {
                        $this.find('.call_status_callbox').text(call_status);
                        $this.find('.callStatus_callbox').val(call_status);

                        if (call_status === 'Connected') {
                            $this.find('.call_status_callbox').removeClass('label-inverse').addClass('label-success');
                            window.callcenter.countCallDuration($this);
                        } else if (call_status === 'Hangup') {
                            $this.find('.call_status_callbox').removeClass('label-success').addClass('label-important');
                            window.callcenter.stopCountCallDuration();
                        }
                    }
                });
            },
            setDataStart: function (phone, data) {
                $('.callbox').each(function () {
                    var $this = $(this);
                    if ($this.find('#phoneNumber').val() === phone) {
                        $this.find('#callId').val(data.callId);
                        $this.find('#ext').val(data.ext);
                        $this.find('#start').val(data.start);
                        $this.find('#start_timestamp').val(data.start_timestamp);
                        $this.find('#source').val(data.source);
                    }
                });
            },
            setDataEnd: function (phone, data) {
                var _this = this;
                $('.callbox').each(function () {
                    var $this = $(this);
                    if ($this.find('#phoneNumber').val() === phone) {
                        $this.find('#end').val(data.end);
                        $this.find('#end_timestamp').val(data.end_timestamp);
                        $this.find('#recording').val(data.recording);
                        $this.find('#duration').val(parseInt((parseInt(data.end_timestamp, 10) - parseInt($this.find('#start_timestamp').val(), 10)) / 1000, 10));
                    }
                });
            },
            save: function (phone) {
                $('.callbox').each(function () {
                    var $this = $(this);
                    if ($this.find('#phoneNumber').val() === phone) {
                        $this.find('.save_callbox').prop('disabled', false);
                        $this.find('.save_callbox').attr('data-is-auto-save', '1').click();
                    }
                });
            },
            countCallDuration: function ($box) {
                var starttime = new Date().getTime();
                window.callcenter_count_duration = setInterval(function () {
                    var now = new Date().getTime();
                    var distance = now - starttime;
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    $box.find('.duration_callbox').text((distance / 1000 > 3600 ? ((hours < 10 ? '0' : '') + hours + ":") : '') + (minutes < 10 ? '0' : '') + minutes + ":" + (seconds < 10 ? '0' : '') + seconds);
                }, 1000);
            },
            stopCountCallDuration: function () {
                if (window.callcenter_count_duration) clearInterval(window.callcenter_count_duration);
            }
        };
    },
    callcenterInitVoip24h: function () {
        window.callcenter_supplier_voip24h = {
            clickToCall: function (phoneNumber) {
                $.ajax({
                    url: window.location.protocol + '//' + window.callcenter_ip + '/dial?voip=' + window.callcenter_key + '&secret=' + window.callcenter_secret + '&sip=' + window.callcenter_ext + '&phone=' + phoneNumber,
                    type: 'get',
                    async: true,
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    },
                    success: function (res) {
                        console.log('click to call ' + phoneNumber + ' success!');
                    }
                });
            },
            initServer: function () {
                var _this = this;

                var port = window.location.protocol === 'http:' ? 6868 : 8007;
                window.callcenter_socketio = io.connect(window.location.protocol + '//' + window.callcenter_ip + ':' + port, {transports: ['websocket'], reconnection: true});
                window.callcenter_socketio.on('connecting', function (e) {
                    window.callcenter_socketio.emit("sign", window.callcenter_key);
                });
                window.callcenter_socketio.on('connected', function () {
                    console.log('callcenter connected success!');
                });
                window.callcenter_socketio.on('say', function () {
                    setInterval(function () {
                        window.callcenter_socketio.emit("hello", window.callcenter_socketio.id);
                    }, 10000);
                });
                window.callcenter_socketio.on("Bandwidth", function (e) {
                    /* Đạt ngưỡng cho phép kết nối vào tổng đài */
                    window.callcenter_socketio.destroy();
                });
                window.callcenter_socketio.on("error", function (e) {
                    /* Lỗi sự cố hoặc lỗi kết nối, lỗi key v.v.v.v */
                    window.callcenter_socketio.destroy();
                });
                window.callcenter_socketio.on("connectionRefused", function (e) {
                    /* API chính xác nhưng tổng đài từ chối kết nối */
                    window.callcenter_socketio.destroy();
                });
                window.callcenter_socketio.on("connectTimeout", function (e) {
                    /* API chính xác nhưng tổng đài từ chối kết nối đang bảo trì hoặc sự cố*/
                    window.callcenter_socketio.destroy();
                });
                window.callcenter_socketio.on("connectEnd", function (e) {
                    /* API chính xác nhưng tổng đài từ chối kết nối do vòng đời kết nối quá giới hạn hoặc sự cố Tổng đài*/
                    window.callcenter_socketio.destroy();
                });
                window.callcenter_socketio.on("disconnectedServer", function (e) {
                    /* API chính xác nhưng tổng đài từ chối kết nối đang bảo trì hoặc sự cố*/
                    window.callcenter_socketio.destroy();
                });
                window.callcenter_socketio.on("disconnect", function (e) {
                    /*Tín hiệu mạng Clients với tổng đài đang không kết nối với nhau. Rớt Ping, Chặn Port .v.v.v.v*/
                    window.callcenter_socketio.connect();
                });

                window.callcenter_socketio.on("response", function (response) {
                    console.log(response);
                    if (window.call_saving) return;
                    if (parseInt(response.extend, 10) === parseInt(window.callcenter_ext, 10)) {
                        var call_status = 'Waiting';
                        switch (response.state.toLowerCase()) {
                            case 'up':
                                call_status = 'Connected';
                                break;
                            case 'hangup':
                                call_status = 'Hangup';
                                window.call_saving = true;
                                break;
                        }
                        // if (window.callcenter.exist(response.phone) === false) {
                        //     window.callcenter.createCallbox(response.phone, call_status, response.type);
                        // }
                        window.callcenter.changeCallStatus(response.phone, call_status);

                        var dt;
                        if (call_status === 'Connected') {
                            dt = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60 * 1000);
                            dt = dt.toISOString();
                            dt = dt.replace('T', ' ');
                            dt = dt.replace('Z', '');
                            dt = dt.substr(0, 19);

                            window.callcenter.setDataStart(response.phone, {
                                callId: response.callid,
                                ext: response.extend,
                                source: 'Voip24h',
                                start_timestamp: new Date().getTime(),
                                start: dt
                            });
                        } else if (call_status === 'Hangup') {
                            dt = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60 * 1000);
                            dt = dt.toISOString();
                            dt = dt.replace('T', ' ');
                            dt = dt.replace('Z', '');
                            dt = dt.substr(0, 19);

                            window.callcenter.setDataEnd(response.phone, {
                                end_timestamp: new Date().getTime(),
                                end: dt,
                                recording: '::Voip24h::' + window.location.protocol + '//' + window.callcenter_ip + '/dial/searching?voip=' + window.callcenter_key + '&secret=' + window.callcenter_secret + '&callid=' + response.callid
                            });

                            window.callcenter.save(response.phone);
                        }
                    }
                });
            }
        };
        window.callcenter_supplier_voip24h.initServer();
    },
    callcenterInitVoiceCloud: function () {
        window.callcenter_supplier_voicecloud = {
            clickToCall: function (phoneNumber) {
                $.ajax({
                    url: window.callcenter_callcenter_domain + '/api/CallControl/dial/from_number/' + window.callcenter_ext + '/to_number/' + phoneNumber + '/key/' + window.callcenter_key + '/domain/' + window.callcenter_domain,
                    type: 'get',
                    async: true,
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError);
                    },
                    success: function (res) {
                        if (res !== 'Success') {
                            window.callcenter.changeCallStatus(phoneNumber, 'Hangup');
                            return;
                        }
                        console.log(res);
                        console.log('click to call ' + phoneNumber + ' success!');
                        if (window.call_saving) return;

                        window.callcenter.changeCallStatus(phoneNumber, 'Connected');

                        var dt;
                        dt = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60 * 1000);
                        dt = dt.toISOString();
                        dt = dt.replace('T', ' ');
                        dt = dt.replace('Z', '');
                        dt = dt.substr(0, 19);

                        window.callcenter.setDataStart(phoneNumber, {
                            callId: new Date().getTime(),
                            ext: window.callcenter_ext,
                            source: 'VoiceCloud',
                            start_timestamp: new Date().getTime(),
                            start: dt
                        });
                    }
                });
            },
            initServer: function () {
                window.callcenter_socketio = io.connect('https://service.dotb.cloud:3001');
                window.callcenter_socketio.emit('login', JSON.stringify({user: App.user.id, key: App.config.uniqueKey}));
                window.callcenter_socketio.on('login', function (res) {
                    res = JSON.parse(res);
                    console.log(res.message);
                });
                window.callcenter_socketio.on('message', function (res) {
                    res = JSON.parse(res);
                    console.log(res);

                    if (window.call_saving) return;
                    window.callcenter.changeCallStatus(res.phone, 'Hangup');
                    if (res.status !== "ANSWER") {
                        toastr.warning('Call log not saved because call is not connected yet!');
                        return;
                    }
                    var dt;
                    dt = new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60 * 1000);
                    dt = dt.toISOString();
                    dt = dt.replace('T', ' ');
                    dt = dt.replace('Z', '');
                    dt = dt.substr(0, 19);

                    window.callcenter.setDataEnd(res.phone, {
                        end_timestamp: new Date().getTime(),
                        end: dt,
                        recording: res.recordingfile,
                        callId: res.callid,
                        ext: res.extension,
                        source: 'VoiceCloud',
                        start_timestamp: new Date().getTime(),
                        start: dt
                    });

                    window.callcenter.save(res.phone);
                });
            }
        };
        window.callcenter_supplier_voicecloud.initServer();
    }
})
