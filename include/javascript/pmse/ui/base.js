
// jscs:disable
var PMSE = PMSE || {};
/**
 * @class PMSE.Base
 * PMSE.Base Class
 *
 *
 * @constructor
 * Create a new instance of the class
 * @param {Object} options
 */
PMSE.Base = function(options) {
    var defaults = {
        id : (options && options.id) || 'base-ui-' + UITools.getIndex()
    };

    // Do not deep copy here
    $.extend(defaults, options);

    /**
     * Unique Identifier
     * @type {String}
     */
    this.id = defaults.id;
};

/**
 * Sets the id property
 * @return {String}
 */
PMSE.Base.prototype.setId = function(value) {
    this.id = value;
    return this;
};

/**
 * Object Type
 * @type {String}
 * @private
 */
PMSE.Base.prototype.type = 'Core';

/**
 * Object Family
 * @type {String}
 * @private
 */
PMSE.Base.prototype.family = 'Core';

/**
 * Returns the object type
 * @return {String}
 */
PMSE.Base.prototype.getType = function() {
    return this.type;
};

/**
 * Returns the object family
 * @return {String}
 */
PMSE.Base.prototype.getFamily = function() {
    return this.family;
};

/**
 * Destroys the fields ob the object
 */
PMSE.Base.prototype.dispose = function() {
    var key;
    for (key in this) {
        this[key] = null;
    }
};
if (typeof exports !== "undefined") {
    module.exports = PMSE.Base;
}
