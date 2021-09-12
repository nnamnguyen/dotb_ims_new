/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
({
    /**
     * {@inheritdoc}
     */
    initialize: function (options) {
        this._super("initialize", [options]);
        app.events.on("data:sync:error", this.onError, this);
    },

    /**
     * Displays an error when having an invalid license
     *
     * @param {string} method
     * @param {object} model
     * @param {object} options
     * @param {object} error
     */
    onError: function (method, model, options, error) {
        if (error.code === "invalid_license") {
            app.alert.show('invalid_license', {
                level: 'error',
                messages: error.message,
                autoClose: true
            });
        }
    }
})
