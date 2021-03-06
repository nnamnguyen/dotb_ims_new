
/**
 * @class View.Views.Portal.FooterActionsView
 * @alias DOTB.App.view.views.PortalFooterActionsView
 * @extends View.View.Base.FooterActionsView
 */
({
    events: {
        'click [data-action=tour]': 'showTutorialClick',
        'click [data-action=support]': 'support',
    },

    /**
     * Support page differs between different clients.
     * @override
     */
    support: function() {
        var serverInfo = app.metadata.getServerInfo();
        var url = 'http://dotb.vn/ho-tro';

        window.open(url, '_blank');
    },

    /**
     * Portal uses the old (footer) Tour button.
     *
     * @override
     */
    enableTourButton: function() {
        this.$('[data-action=tour]').removeClass('disabled');
        this.events['click [data-action=tour]'] = 'showTutorialClick';
        this.undelegateEvents();
        this.delegateEvents();
    },

    /**
     * Portal uses the old (footer) Tour button.
     *
     * @override
     */
    disableTourButton: function() {
        this.$('[data-action=tour]').addClass('disabled');
        delete this.events['click [data-action=tour]'];
        this.undelegateEvents();
        this.delegateEvents();
    },

    /**
     * Portal uses the old (footer) Tour button.
     *
     * @override
     */
    showTutorialClick: function(e) {
        if (!app.tutorial.instance) {
            this.showTutorial();
            e.currentTarget.blur();
        }
    },

    /**
     * Kept so we can continue using `showTutorialClick`.
     *
     * @override
     */
    showTutorial: function(prefs) {
        app.tutorial.resetPrefs(prefs);
        app.tutorial.show(app.controller.context.get('layout'), {module: app.controller.context.get('module')});
    },

    /**
     * On portal view change, we still have to enable/disable the tour button
     *   since it still exists there.
     *
     * @inheritdoc
     */
    handleViewChange: function(layout, params) {
        this._super('handleViewChange', [layout, params]);
        app.tutorial.hasTutorial(this.layoutName, this.module) ? this.enableTourButton() : this.disableTourButton();
    }
})
