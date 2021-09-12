
/**
 * @class View.Views.Base.Quotes.QuoteDataGrandTotalsHeaderView
 * @alias DOTB.App.view.views.BaseQuotesQuoteDataGrandTotalsHeaderView
 * @extends View.Views.Base.View
 */
({
    /**
     * @inheritdoc
     */
    events: {
        'click [name="create_qli_button"]': '_onCreateQLIBtnClicked',
        'click [name="create_comment_button"]': '_onCreateCommentBtnClicked',
        'click [name="create_group_button"]': '_onCreateGroupBtnClicked'
    },

    /**
     * @inheritdoc
     */
    className: 'quote-data-grand-totals-header-wrapper quote-totals-row',

    /**
     * Handles when the create Quoted Line Item button is clicked
     *
     * @param {MouseEvent} evt The mouse click event
     * @private
     */
    _onCreateQLIBtnClicked: function(evt) {
        this.context.trigger('quotes:defaultGroup:create', 'qli');
    },

    /**
     * Handles when the create Comment button is clicked
     *
     * @param {MouseEvent} evt The mouse click event
     * @private
     */
    _onCreateCommentBtnClicked: function(evt) {
        this.context.trigger('quotes:defaultGroup:create', 'note');
    },

    /**
     * Handles when the create Group button is clicked
     *
     * @param {MouseEvent} evt The mouse click event
     * @private
     */
    _onCreateGroupBtnClicked: function(evt) {
        this.context.trigger('quotes:group:create');
    }
})
