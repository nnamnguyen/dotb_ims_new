
(function(app) {
    app.events.on('app:init', function() {
        app.plugins.register('Audit', ['view'], {
            /**
             * @inheritdoc
             *
             * Bind the audit button handler.
             */
            onAttach: function(component, plugin) {
                this.on('init', function() {
                    this.context.on('button:audit_button:click', this.auditClicked, this);
                });
            },

            /**
             * Handles the click event, and open the audit view in the drawer.
             */
            auditClicked: function() {
                var context = this.context.getChildContext({
                    module: 'Audit',
                    model: this.context && this.context.get('model') || this.model
                });

                app.drawer.open({
                    layout: 'audit',
                    context: context
                });
            },

            /**
             * @inheritdoc
             *
             * Clean up associated event handlers.
             */
            onDetach: function(component, plugin) {
                this.context.off('button:audit_button:click', this.auditClicked, this);
            }
        });
    });
})(DOTB.App);
