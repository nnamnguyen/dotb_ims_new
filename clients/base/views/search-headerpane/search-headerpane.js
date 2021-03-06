
/**
 * Headerpane view for the {@link View.Layouts.Base.SearchLayout
 * Search layout}.
 *
 * @class View.Views.Base.SearchHeaderpaneView
 * @alias DOTB.App.view.views.BaseSearchHeaderpaneView
 * @extends View.Views.Base.HeaderpaneView
 */
({
    extendsFrom: 'HeaderpaneView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        this.context.on('change:searchTerm change:tagParams', function(model, value) {
            var tagParams = this.context.get('tagParams') || [];
            this.searchTerm = {term: this.context.get('searchTerm'), tags: tagParams.join(', ')};
            this.render();
        }, this);

        // Let this.searchTerm hold searchTerm and tag data for headerpane title
        var tagParams = this.context.get('tagParams') || [];
        this.searchTerm = {term: this.context.get('searchTerm'), tags: tagParams.join(', ')};
    },

    /**
     * Formats the title passing the search term.
     *
     * @override
     */
    _formatTitle: function(title) {
        if (!title) {
            return '';
        }
        return app.lang.get(title, this.module, {
            searchTerm: new Handlebars.SafeString(this.searchTerm)
        });
    },

    /**
     * @inheritdoc
     */
    unbind: function() {
        this._super('unbind');
        $(window).off('resize.searchheader');
        this.layout.off('headerpane:adjust_fields', this.adjustTitle);
    }
})
