
/**
 * @class View.Views.Base.Meetings.RecordView
 * @alias DOTB.App.view.views.BaseMeetingsRecordView
 * @extends View.Views.Base.RecordView
 */
({
    extendsFrom: 'RecordView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['EditAllRecurrences', 'AddAsInvitee']);
        this._super('initialize', [options]);
    }
})
