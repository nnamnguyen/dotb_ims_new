
var PMSE = PMSE || {};
var DotbProxy = function (options) {
    PMSE.Proxy.call(this, options);
    this.uid = null;
    this.getMethod = null;
    this.sendMethod = null;
    DotbProxy.prototype.initObject.call(this, options);
};

DotbProxy.prototype = new PMSE.Proxy();

DotbProxy.prototype.type = 'DotbProxy';

DotbProxy.prototype.initObject = function (options) {
    var defaults = {
        sendMethod: 'PUT',
        getMethod: 'GET',
        createMethod: 'POST',
        uid: null
    };
    $.extend(true, defaults, options);
    this.setUid(defaults.uid)
        .setSendMethod(defaults.sendMethod)
        .setGetMethod(defaults.getMethod)
        .setCreateMethod(defaults.createMethod);
};

DotbProxy.prototype.setUid = function (id) {
    this.uid = id;
    return this;
};


DotbProxy.prototype.setSendMethod = function (method) {
    this.sendMethod = method;
    return this;
};

DotbProxy.prototype.setGetMethod = function (method) {
    this.getMethod = method;
    return this;
};
DotbProxy.prototype.setCreateMethod = function (method) {
    this.createMethod = method;
    return this;
};

DotbProxy.prototype.getData = function (params, callback) {
    var operation, self = this, url;

    operation = this.getOperation(this.getMethod);
    if (operation === 'read' && params) {
        url = App.api.buildURL(this.url, null, null, params);
    } else {
        url = App.api.buildURL(this.url, null, null);
    }
    App.api.call(operation, url, {}, {
        success: function (response) {
            if (callback && callback.success) {
                callback.success.call(self, response);
            }
        },
        error: function (dotbHttpError) {
            if(callback && typeof callback.error === 'function') {
                callback.error.call(self, dotbHttpError);
            }
        }
    });
};

DotbProxy.prototype.sendData = function (data, callback) {

    var operation, self = this, send, url;

    operation = this.getOperation(this.sendMethod);
    url = App.api.buildURL(this.url, null, null);
    attributes = {
        data: data
    };

    App.api.call(operation, url, attributes, {
        success: function (response) {

            if (callback && callback.success) {
                callback.success.call(self, response);
            }
        }
    });
};
DotbProxy.prototype.createData = function (data, callback) {

    var operation, self = this, send, url;

    operation = this.getOperation(this.createMethod);
    url = App.api.buildURL(this.url, null, null);
    attributes = {
        data: data
    };

    App.api.call(operation, url, attributes, {
        success: function (response) {
            if (callback && callback.success) {
                callback.success.call(self, response);
            }
        }
    });
};
DotbProxy.prototype.removeData = function (params, callback) {
    var operation, self = this, url;
    operation = 'remove';
    if (operation === 'remove' && params) {
        url = App.api.buildURL(this.url, null, null, params);
    } else {
        url = App.api.buildURL(this.url, null, null);
    }
    App.api.call('delete', url, {}, {
        success: function (response) {
//            console.log('getData');
//            console.log(response);
            if (callback && callback.success) {
                callback.success.call(self, response);
            }
        }
    });
};

DotbProxy.prototype.getOperation = function (method) {
    var out;
    switch (method) {
        case 'GET':
            out = 'read';
            break;
        case 'POST':
            out = 'create';
            break;
        case 'PUT':
            out = 'update';
            break;
        case 'DELETE':
            out = 'delete';
            break;
    }
    return out;
};
