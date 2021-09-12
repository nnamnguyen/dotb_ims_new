
/**
 * @class View.Views.Base.ConfigDrawerHowtoView
 * @alias DOTB.App.view.views.BaseConfigDrawerHowtoView
 * @extends View.View
 */
({
    howtoData: {},

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        this.context.on('config:howtoData:change', this.onHowtoDataChange, this);
    },

    /**
     * Handles updating the howto data when it changes
     *
     * @param howtoData
     */
    onHowtoDataChange: function(howtoData) {
        this.howtoData = howtoData;
        this.render();
    }
})
