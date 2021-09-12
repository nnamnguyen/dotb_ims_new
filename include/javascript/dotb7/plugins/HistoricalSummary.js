
(function(app) {
    app.events.on('app:init', function() {
        app.plugins.register('HistoricalSummary', ['view'], {
            /**
             * @inheritdoc
             *
             * Bind the historical summary button handler.
             */
            onAttach: function(component, plugin) {
                this.on('init', function() {
                    this.context.on('button:historical_summary_button:click', this.historicalSummaryClicked, this);
                });
            },

            /**
             * Handles the click event, and open the historical-summary-list view
             */
            historicalSummaryClicked: function() {
                app.drawer.open({
                    layout: 'history-summary',
                    context: {
                        name: 'history'
                    }
                });
            },

            /**
             * @inheritdoc
             *
             * Clean up associated event handlers.
             */
            onDetach: function(component, plugin) {
                this.context.off('button:historical_summary_button:click', this.auditClicked, this);
            }
        });
    });
})(DOTB.App);
