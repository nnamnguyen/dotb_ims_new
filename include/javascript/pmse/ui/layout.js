
// jscs:disable
var PMSE = PMSE || {};
/**
 * @class PMSE.Layout
 * Handle the layout for panels
 * @extends PMSE.Base
 *
 * @constructor
 * Creates a new instance of this class
 * @param {Object} options
 */
PMSE.Layout = function(options) {
    PMSE.Base.call(this, options);

    PMSE.Layout.prototype.initObject.call(this, options);
};

PMSE.Layout.prototype = new PMSE.Base();

/**
 * Defines the object's type
 * @type {String}
 */
PMSE.Layout.prototype.type = 'PMSE.Layout';

/**
 * Defines the object's family
 * @type {String}
 */
PMSE.Layout.prototype.family = 'PMSE.Layout';

/**
 * Initializes the object with default values
 * @param {Object} options
 */
PMSE.Layout.prototype.initObject = function(options) {

};
