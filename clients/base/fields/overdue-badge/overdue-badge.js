
/**
 * EventStatusField is a field for Meetings/Calls that shows a date field as a badge when event is overdue
 *
 * FIXME: This component will be moved out of clients/base folder as part of MAR-2274 and SC-3593
 *
 * @class View.Fields.Base.OverdueBadgeField
 * @alias DOTB.App.view.fields.BaseOverdueBadgeField
 * @extends View.Fields.Base.BaseField
 */
({
    _render: function() {
        var now = new Date(),
            due_date = this.model.get(this.name),
            date = new Date(due_date);
        this.model.set('overdue', !_.isNull(due_date) && date < now);
        this._super('_render');
    }
})
