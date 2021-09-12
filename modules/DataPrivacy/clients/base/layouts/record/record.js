
 /**
 * @class View.Layouts.Base.DataPrivacy.RecordLayout
 * @alias DOTB.App.view.layouts.BaseDataPrivacyRecordLayout
 * @extends View.Layouts.Base.RecordLayout
 */
({
    extendsFrom: 'RecordLayout',

    /**
     * @inheritdoc
     *
     * Adds handler for invoking Mark for Erasure view
     */
    initialize: function(options) {
        this._super('initialize', arguments);
        this.listenTo(this.context, 'mark-erasure:click', this.showMarkForEraseDrawer);
    },

    /**
     * Open a drawer to mark fields on the given model for erasure.
     *
     * @param {Data.Bean} modelForErase Model to mark fields on.
     */
    showMarkForEraseDrawer: function(modelForErase) {
        var context = this.context.getChildContext({
            name: 'Pii',
            model: app.data.createBean('Pii'),
            modelForErase: modelForErase,
            fetch: false
        });

        app.drawer.open({
            layout: 'mark-for-erasure',
            context: context
        });
    }
})
