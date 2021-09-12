

(function(app) {
    app.events.on('app:init', function() {
        app.plugins.register('File', ['field'], {
            /**
             * TODO: Empty function shouldn't be needed when SC-1576 is fixed.
             *
             * @inheritdoc
             * @return {void}
             */
            bindKeyDown: function() {},
            /**
             * TODO: Empty function shouldn't be needed when SC-1576 is fixed.
             *
             * @inheritdoc
             * @return {void}
             */
            bindDocumentMouseDown: function() {}
        });
    });
})(DOTB.App);
