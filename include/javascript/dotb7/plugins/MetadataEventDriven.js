
/**
 * Plugin provide way for fields to handle events specified in metadata.
 * You can specify those events in metadata as:
 *
 * <pre><code>
 * events: {
 *     handler: "fire:some:event";
 * }
 * </code></pre>
 *
 * The default behavior triggers event on `this.view.context` and
 * `this.view.layout` if they exist.
 */
(function(app) {
    app.events.on('app:init', function() {
        app.plugins.register('MetadataEventDriven', ['field'], {
            /**
             * Triggers event.
             * @param {Event} domEvent Original DOM event.
             * @param {String} metadataEvent Name of event to trigger.
             */
            triggerMetadataEvent: function(domEvent, metadataEvent) {
                if (this.view.context) {
                    this.view.context.trigger(metadataEvent, this.model);
                }
                if (this.view.layout) {
                    this.view.layout.trigger(metadataEvent, this.model);
                }
            }
        });
    });
})(DOTB.App);
