
/**
 * @singleton
 * @alias DOTB.App.dotbAuthStore
 */
(function(app) {
    var serviceName = "DotbCRM",
        emptyFn = function() {},
        tokenMap = {
            "AuthAccessToken" : app.AUTH_ACCESS_TOKEN,
            "AuthRefreshToken" : app.AUTH_REFRESH_TOKEN
        };

    var _keychain = {
        /**
         * Returns the auth token of the current user.
         *
         * This method simply reads the global AUTH_ACCESS_TOKEN or
         * AUTH_REFRESH_TOKEN that was set when the native application was launched.
         *
         * @param {String} key Item key.
         * @return {String} authentication token for the current user.
         */
        get: function(key) {
            return tokenMap[key];
        },

        /**
         * Puts an item into the keychain.
         * @param {String} key Item key.
         * @param {String} value Item to put.
         */
        set: function(key, value) {
            tokenMap[key] = value;
        },

        /**
         * Deletes an item from the keychain.
         * @param {String} key Item key.
         */
        cut: function(key) {
            delete tokenMap[key];
        }
    };

    app.augment("dotbAuthStore", _keychain);

})(DOTB.App);