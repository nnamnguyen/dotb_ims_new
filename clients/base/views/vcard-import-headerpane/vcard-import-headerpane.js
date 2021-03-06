
/**
 * @class View.Views.Base.VcardImportHeaderpaneView
 * @alias DOTB.App.view.views.BaseVcardImportHeaderpaneView
 * @extends View.Views.Base.HeaderpaneView
 */
({
    extendsFrom: 'HeaderpaneView',

    events: {
        'click [name=vcard_cancel_button]': 'initiateCancel'
    },

    /**
     * Add listener for toggling the disabled state of the finish button
     *
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.context.on('vcard:import-finish-button:toggle', this._toggleFinishButton, this);
    },

    /**
     * Toggle the state of the finish button (enabled/disabled)
     *
     * @param {boolean} enabled Whether the button should be enabled
     * @private
     */
    _toggleFinishButton: function(enabled) {
        this.getField('vcard_finish_button').setDisabled(!enabled);
    },

    /**
     * Handle cancel action - closing the drawer
     */
    initiateCancel: function() {
        app.drawer.close();
    }
})
