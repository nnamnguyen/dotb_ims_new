
/**
 * @class View.Views.Base.Emails.RecordlistView
 * @alias DOTB.App.view.views.BaseEmailsRecordlistView
 * @extends View.Views.Base.RecordlistView
 */
({
    extendsFrom: 'RecordlistView',

    /**
     * @inheritdoc
     * When record name is empty, return (no subject)
     */
    _getNameForMessage: function(model) {
        var name = this._super('_getNameForMessage', [model]);

        if (_.isEmpty(name)) {
            return app.lang.get('LBL_NO_SUBJECT', this.module);
        }

        return name;
    }
})
