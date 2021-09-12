
(function (app) {
    app.events.on('app:init', function () {
        /**
         * Get the list of shortcuts that is allowed in this session.
         *
         * @param {View.Layout} layout
         * @returns {Array}
         */
        var getShortcutList = function(layout) {
            return layout.options.meta.shortcuts || layout.shortcuts;
        };

        app.plugins.register('ShortcutSession', ['layout'], {
            /**
             * Create new shortcut session.
             */
            onAttach: function() {
                var shortcutList = getShortcutList(this);
                if (!_.isEmpty(shortcutList)) {
                    app.shortcuts.createSession(shortcutList, this);
                }
            }
        });
    });
})(DOTB.App);
