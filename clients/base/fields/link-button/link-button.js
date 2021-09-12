
/**
 * "Link" button used in selection list for linking existing records.
 *
 * @class View.Fields.Base.LinkButtonField
 * @alias DOTB.App.view.fields.BaseLinkButtonField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        this.massCollection = this.context.get('mass_collection');
        if (!this.massCollection) {
            return;
        }

        this.listenTo(this.massCollection, 'add remove', function() {
            this.setDisabled(this.massCollection.length === 0);
        });

        if (this.massCollection.length === 0) {
            this.setDisabled(true);
        }
    },

    /**
     * @inheritdoc
     */
    _loadTemplate: function() {
        this.type = 'rowaction';
        this._super('_loadTemplate');
        this.type = 'link-button';
    },

    /**
     * @inheritdoc
     */
    unbind: function() {
        this.stopListening(this.massCollection);
        this._super('unbind');
    }
})
