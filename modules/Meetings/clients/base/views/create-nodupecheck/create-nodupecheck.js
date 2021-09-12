
/**
 * @class View.Views.Base.Meetings.CreateNodupecheckView
 * @alias DOTB.App.view.views.MeetingsCreateNodupecheckView
 * @extends View.Views.Base.CreateNodupecheckView
 */
({
    extendsFrom: 'CreateNodupecheckView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['AddAsInvitee', 'ReminderTimeDefaults']);
        this._super('initialize', [options]);
    }
})
