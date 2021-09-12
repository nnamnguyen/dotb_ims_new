
var PMSE = PMSE || {};
/**
 * @class PMSE.Proxy
 * Handles the proxy connections
 * @extends PMSE.Base
 *
 * @constructor
 * Creates a new instance of the class
 * @param {Object} options
 */
PMSE.Proxy = function(options) {
    PMSE.Base.call(this, options);
    /**
     * Defines the URL to connect
     * @type {String}
     */
    this.url = null;
    this.callback = null;
    this.attributes = null;
    PMSE.Proxy.prototype.initObject.call(this, options);
};
PMSE.Proxy.prototype = new PMSE.Base();

/**
 * Defines the object's type
 * @type {String}
 */
PMSE.Proxy.prototype.type = 'PMSE.Proxy';

/**
 * Defines the object's family
 * @type {String}
 */
PMSE.Proxy.prototype.family = 'PMSE.Proxy';

/**
 * Initializes the object with default values
 * @param {Object} options
 */
PMSE.Proxy.prototype.initObject = function(options) {
    var defaults = {
        url: null,
        callback: null,
        attributes: null
    };
    $.extend(true, defaults, options);
    this.setUrl(defaults.url)
        .setCallback(defaults.callback)
        .setAttributes(defaults.attributes);
};

/**
 * Sets the URL property
 * @param {String} url
 * @return {*}
 */
PMSE.Proxy.prototype.setUrl = function(url) {
    this.url = url;
    return this;
};

PMSE.Proxy.prototype.setCallback = function(callback) {
    this.callback = callback;
    return this;
};

PMSE.Proxy.prototype.setAttributes = function(attributes) {
    this.attributes = attributes;
    return this;
};

/**
 * Obtains the data
 */
PMSE.Proxy.prototype.getData = function() {

};

/**
 * Sends the data
 * @param {Object} data
 * @param {Object} [callback]
 */
PMSE.Proxy.prototype.sendData = function(data, callback) {

};
