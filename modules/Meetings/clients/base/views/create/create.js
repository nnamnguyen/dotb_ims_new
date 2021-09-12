
/**
 * @class View.Views.Base.Meetings.CreateView
 * @alias DOTB.App.view.views.MeetingsCreateView
 * @extends View.Views.Base.CreateView
 */
({
    extendsFrom: 'CreateView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['AddAsInvitee', 'ReminderTimeDefaults']);
        this._super('initialize', [options]);
    }
})
