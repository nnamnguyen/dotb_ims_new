
/**
 * @class View.Fields.Base.Forecasts.ButtonField
 * @alias DOTB.App.view.fields.BaseForecastsButtonField
 * @extends View.Fields.Base.ButtonField
 */
({
    extendsFrom: 'ButtonField',

    /**
     * Override so we can have a custom hasAccess for forecast to check on the header-pane buttons
     *
     * @inheritdoc
     */
    hasAccess: function() {
        // this is a special use case for forecasts
        // currently the only buttons that set acl_action == 'current_user' are the save_draft and commit buttons
        // if it's not equal to 'current_user' then go up the prototype chain.
        if(this.def.acl_action == 'current_user') {
            var su = this.context.get('selectedUser') || app.user.toJSON();
            return su.id === app.user.get('id');
        } else {
            return this._super('hasAccess');
        }
    }
})
