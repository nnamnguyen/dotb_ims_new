
/**
 * This is the extension of {@link View.Layouts.Base.DefaultLayout} that is used
 * for the history summary drawer.
 *
 * The aim of this extension is to make the right pane collapsed by default, and
 * to remove stickiness so the pane is always collapsed when you initialize the
 * layout.
 *
 * @class View.Layouts.Base.HistoryDefaultLayout
 * @alias DOTB.App.view.layouts.BaseHistoryDefaultLayout
 * @extends View.Layouts.Base.DefaultLayout
 */
({
    extendsFrom: 'DefaultLayout',

    /**
     * Extend to return `false` the first time this method is called, so the
     * pane is always collapsed on first load.
     *
     * @inheritdoc
     */
    isSidePaneVisible: function() {
        if (this._isSidePaneVisibleCalledOnce !== true) {
            this._isSidePaneVisibleCalledOnce = true;
            app.user.lastState.set(this._hideLastStateKey, 1);
            return false;
        }
        return this._super('isSidePaneVisible');
    },

    /**
     * Removes the cache entry because it is unnecessary to keep it since we
     * reset it on first load.
     *
     * @inheritdoc
     */
    _dispose: function() {
        app.user.lastState.remove(this._hideLastStateKey);

        this._super('_dispose');
    }
})
