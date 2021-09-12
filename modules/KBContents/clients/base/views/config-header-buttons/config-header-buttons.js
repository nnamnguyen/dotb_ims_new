
/**
 * @class View.Views.Base.SchedulersJobsConfigHeaderButtonsView
 * @alias DOTB.App.view.layouts.BaseSchedulersJobsConfigHeaderButtonsView
 * @extends View.Views.Base.ConfigHeaderButtonsView
 */
({
    extendsFrom: 'ConfigHeaderButtonsView',

    /**
     * Saves the config model
     *
     * Also calling doValidate to check that there is no Language duplication
     *
     * @private
     */
    _saveConfig: function() {
        var self = this,
            model = this.context.get('model');

        // Standard ConfigHeaderButtonsView doesn't use doValidate
        model.doValidate(null, function(isValid) {
            if (isValid) {
                self._super('_saveConfig');
            } else {
                self.getField('save_button').setDisabled(false);
            }
        });
    }
})
