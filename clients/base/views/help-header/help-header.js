
/**
 * View for managing the help component's header bar.
 *
 * @class View.Views.Base.HelpHeaderView
 * @alias DOTB.App.view.views.BaseHelpHeaderView
 * @extends View.View
 */
({
    /**
     * @deprecated Since 7.9. Will be removed in 7.11.
     * Please use {@link View.Layouts.Base.HelpLayout.close} instead.
     */
    triggerClose: function() {
        app.logger.warn('');
        app.events.trigger('app:help:toggle', false, this);
    }
})
