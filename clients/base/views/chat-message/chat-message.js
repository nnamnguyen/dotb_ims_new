({
    events: {
        'click .chat-message-btn-reply': 'chatReply'
    },
    initialize: function (options) {
        this._super('initialize', [options]);

        if (app.controller.context.attributes.module == 'Cases') {
            app.api.call('create', app.api.buildURL('chat-message/set_noty_is_read'), {
                parent_id: app.controller.context.attributes.modelId
            }, {});
        }
    },
    render: function () {
        this._super('render');
        var self = this;
        app.api.call('create', app.api.buildURL('chat-message'), {
            parent_id: app.controller.context.attributes.modelId,
            parent_type: app.controller.context.attributes.module
        }, {
            success: function (res) {
                self.closeLoading();
                if (res.success) {
                    var n = res.data.length;
                    for (var i = 0; i < n; i++) {
                        var attachment = '';
                        var directionColor = '';
                        if (res.data[i].attachment_id) attachment = res.data[i].attachment_id != '' ? ('<br/><a class="btn btn-default" href="download_attachment.php?id=' + res.data[i].attachment_id + '&name=' + res.data[i].attachment_name + '">' + res.data[i].attachment_name + '</a>') : '';
                        if (res.data[i].direction == 'inbound') directionColor = 'color:red';
                        var h = '<li class="left clearfix">' +
                            '                    <span class="chat-img pull-left"><i class="fal fa-comment fa-2x"></i></span>' +
                            '                    <div class="chat-body clearfix">' +
                            '                        <div class="header" style="margin-bottom: 10px">' +
                            '                            <a href="#Users/' + res.data[i].created_by + '">' +
                            '                               <strong style="font-size: 120%;' + directionColor + '">' + res.data[i].created_by_name + '</strong>' +
                            '                            </a>' +
                            '                            <small><i class="far fa-clock-o"></i> ' + res.data[i].date_entered + '</small>' +
                            '                        </div>' +
                            '                        <div class="content" style="padding-left: 15px">' + res.data[i].description +
                            attachment +
                            '                        </div>' +
                            '                    </div>' +
                            '                </li>';
                        $('.chat-message-list.chat').append(h);
                    }
                }
            }
        });
    },
    showLoading: function () {
        app.alert.show('loading', {
            level: 'process',
            title: 'loading'
        });
    },
    closeLoading: function () {
        app.alert.dismiss('loading');
    },
    showSuccessAlert: function () {
        app.alert.show('saved', {
            level: 'success',
            messages: '',
            autoClose: true
        });
    },
    showErrorAlert: function () {
        app.alert.show(errored, {
            level: 'error',
            messages: '',
            autoClose: true
        });
    },
    saveComment: function (attachment) {
        var self = this;
        app.api.call('create', app.api.buildURL('chat-message/save'), {
            parent_id: app.controller.context.attributes.modelId,
            parent_type: app.controller.context.attributes.module,
            description: $('#chat-messge-content').val(),
            attachment: attachment
        }, {
            success: function (res) {
                self.closeLoading();
                if (res.success) {
                    var attachment = '';
                    if (res.data.attachment_id) attachment = res.data.attachment_id != '' ? ('<br/><a class="btn btn-default" href="download_attachment.php?id=' + res.data.attachment_id + '&name=' + res.data.attachment_name + '">' + res.data.attachment_name + '</a>') : '';
                    $('#chat-messge-content').val('');
                    $('#chat-messge-content-attachment').val('');
                    self.showSuccessAlert();
                    var h = '<li class="left clearfix">' +
                        '                    <span class="chat-img pull-left"><i class="far fa-comment fa-2x"></i></span>' +
                        '                    <div class="chat-body clearfix">' +
                        '                        <div class="header" style="margin-bottom: 10px">' +
                        '                            <a href="#Users/' + res.data.created_by + '">' +
                        '                               <strong style="font-size: 120%">' + res.data.created_by_name + '</strong>' +
                        '                            </a>' +
                        '                            <small><i class="far fa-clock-o"></i>' + res.data.date_entered + '</small>' +
                        '                        </div>' +
                        '                        <div class="content" style="padding-left: 15px">' + res.data.description +
                        attachment +
                        '                        </div>' +
                        '                    </div>' +
                        '                </li>';
                    $('.chat-message-list.chat').append(h);
                } else self.showErrorAlert();
            }
        });
    },
    chatReply: function () {
        var self = this;
        self.showLoading();
        var fileAttachment = document.getElementById('chat-messge-content-attachment').files;
        if (fileAttachment.length > 0) {
            f = fileAttachment[0];
            var freader = new FileReader();
            freader.onload = (function (theFile) {
                return function (e) {
                    var attachment = {
                        data: e.target.result.substr(e.target.result.indexOf('base64,') + 7),
                        name: theFile.name
                    };
                    self.saveComment(attachment);
                }
            })(f);
            freader.readAsDataURL(f);
        } else {
            self.saveComment({});
        }
    }
})