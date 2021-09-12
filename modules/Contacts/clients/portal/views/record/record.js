

/**
 * Add support for changing application language when the Portal user's
 * preferred language changes.
 *
 * @class View.Views.Portal.Contacts.RecordView
 * @alias DOTB.App.view.views.PortalContactsRecordView
 * @extends View.Views.Base.RecordView
 */
({
    extendsFrom: 'RecordView',
    /**
     * @override
     */
    bindDataChange: function(){
        this._super("bindDataChange");
        var model = this.context.get('model');
        model.on('sync', this._setPreferredLanguage, this);
    },
    /**
     * Update application language based on Portal user's preferred language
     * @private
     */
    _setPreferredLanguage: function(){
        var newLang = this.model.get("preferred_language");
        if(_.isString(newLang) && newLang !== app.lang.getLanguage()){
            app.alert.show('language', {level: 'warning', title: 'LBL_LOADING_LANGUAGE', autoclose: false});
            app.lang.setLanguage(newLang, function(){
                app.alert.dismiss('language');
            });

        }
    }
})
