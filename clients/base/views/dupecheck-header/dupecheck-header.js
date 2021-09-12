
/**
 * @class View.Views.Base.DupecheckHeaderView
 * @alias DOTB.App.view.views.BaseDupecheckHeaderView
 * @extends View.View
 */
({

    initialize: function(options) {
        app.view.View.prototype.initialize.call(this, options);
        this.context.on('dupecheck:collection:reset', this.updateCount, this);
     },

    updateCount: function() {
        var translatedString = app.lang.get(
            'LBL_DUPLICATES_FOUND',
            this.module,
            {'duplicateCount': this.collection.length}
        );
        this.$('span.duplicate_count').text(translatedString);
    }
})
