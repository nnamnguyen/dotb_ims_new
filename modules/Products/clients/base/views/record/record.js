
/**
 * @class View.Views.Base.Products.RecordView
 * @alias DOTB.App.view.views.BaseProductsRecordView
 * @extends View.Views.Base.RecordView
 */
({
    extendsFrom: 'BaseRecordView',

    /**
     * @inheritdoc
     */
    delegateButtonEvents: function() {
        this.context.on('button:convert_to_quote:click', this.convertToQuote, this);
        this.context.on('editable:record:toggleEdit', this._toggleRecordEdit, this);

        this._super('delegateButtonEvents');
    },

    /**
     * @inheritdoc
     */
    _toggleRecordEdit: function() {
        this.setButtonStates(this.STATE.EDIT);
    },

    /**
     * @inheritdoc
     */
    cancelClicked: function() {
        this.context.trigger('record:cancel:clicked');
        this._super('cancelClicked');
    }
})
