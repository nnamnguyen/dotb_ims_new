
/**
 * @class View.Fields.Base.InvitationActionsField
 * @alias DOTB.App.view.fields.BaseInvitationActionsField
 * @extends View.Fields.Base.BaseField
 */
({
    events: {
        'click [data-action]': 'toggleStatus'
    },

    /**
     * Toggle invitation acceptance status.
     *
     * This will fire the save automatically to the server since it is a toggle
     * button and won't make sense to do save from the view (same as favorite).
     *
     * @param {Event} evt The click event that triggered the change.
     */
    toggleStatus: function(evt) {
        var attr = {};

        attr[this.name] = $(evt.currentTarget).data('action');

        this.model.save(attr, {relate: true});
    }
})
