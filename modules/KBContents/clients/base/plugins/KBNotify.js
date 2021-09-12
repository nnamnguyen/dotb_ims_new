

(function(app) {
    app.events.on('app:init', function() {
        var components = [];

        /**
         * Plugin is used to notify different about events happened in KB.
         */
        app.plugins.register('KBNotify', ['view', 'field'], {
            onAttach: function(component, plugin) {
                components.push(component);
            },

            /**
             * Method used to notify all components that using plugin.
             *
             * @param {string} name Event name
             * @param {Object} options Options passed with event
             */
            notifyAll: function(name, options) {
                _.each(components, function(component) {
                    component.trigger(name, options);
                });
            },

            onDetach: function() {
                components = _.without(components, this);
            }
        });
    });

})(DOTB.App);
