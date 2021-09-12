

var EAMPOauth = (function () {

    /**
     * @type {string}
     */
    var redirectUrlOnCompletion = "";

    return {

        /**
         * Start the oauth process
         * @param url The oauth url to start authentication with
         * @param onCompleteRedirect The url to redirect the user after we've completed the oauth auth step
         */
        startOauthAuthentication: function (url, onCompleteRedirect) {
            redirectUrlOnCompletion = onCompleteRedirect;
            window.open(url, "_blank", "width=600,height=400,centerscreen=1,resizable=1");
        },

        /**
         * Handle the oauth completion event, note that the EAPM bean has already been saved at this point.
         * @param e
         */
        handleOauthComplete: function (e) {
            var data = JSON.parse(e.data);
            if (data.result) {
                if (!data.hasRefreshToken) {
                    alert("The application is unable to work in offline mode. Please sign out and sign in again.");
                }
            } else {
                alert("Unable to connect to the data source");
            }
            document.location = redirectUrlOnCompletion;
        }
    };
})();

window.addEventListener("message", EAMPOauth.handleOauthComplete);
