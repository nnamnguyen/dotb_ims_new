
/**
 * @class View.Views.Base.ProductBundles.QuoteDataGroupFooterView
 * @alias DOTB.App.view.views.BaseProductBundlesQuoteDataGroupFooterView
 * @extends View.Views.Base.View
 */
({
    /**
     * The colspan value for the list
     */
    listColSpan: 0,

    /**
     * Array of fields to use in the template
     */
    _fields: undefined,

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        var groupId;

        options.model = options.model || options.layout.model;

        // +1 to colspan since there are no leftColumns in the footer
        this.listColSpan = options.layout.listColSpan + 1;

        this._super('initialize', [options]);

        this._fields = _.flatten(_.pluck(this.meta.panels, 'fields'));

        // ninjastuff
        this.el = this.layout.el;
        this.setElement(this.el);
    },

    /**
     * Overriding _renderHtml to specifically place this template after the
     * quote data group list rows
     *
     * @inheritdoc
     */
    _renderHtml: function() {
        var $els = this.$('tr.quote-data-group-list');
        if ($els.length) {
            // get the last table row with class quote-data-group-list and place
            // this template after it  quote-data-group-header
            $(_.last($els)).after(this.template(this));
        } else {
            // the list is empty so just add the footer after the header
            $(this.$('tr.quote-data-group-header')).after(this.template(this));
        }
    }
})
