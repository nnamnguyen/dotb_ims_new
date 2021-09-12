
/**
 * @class View.Views.Base.DupecheckListView
 * @alias DOTB.App.view.views.BaseDupecheckListMenuView
 * @extends View.Views.Base.FlexListView
 */
({
    extendsFrom: 'FlexListView',
    plugins: ['ListColumnEllipsis', 'ListDisableSort', 'ListRemoveLinks', 'Pagination'],
    collectionSync: null,
    additionalTableClasses: null,

    /**
     * @inheritdoc
     *
     * The metadata used is the default `dupecheck-list` metadata, extended by
     * the module specific `dupecheck-list` metadata, extended by subviews
     * metadata.
     */
    initialize: function(options) {
        var dupeListMeta = app.metadata.getView(null, 'dupecheck-list') || {},
            moduleMeta = app.metadata.getView(options.module, 'dupecheck-list') || {};

        options.meta = _.extend({}, dupeListMeta, moduleMeta, options.meta || {});

        this._super('initialize', [options]);
        this.context.on('dupecheck:fetch:fire', this.fetchDuplicates, this);
    },

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        this.collection.on('reset', function() {
            this.context.trigger('dupecheck:collection:reset');
        }, this);
        this._super('bindDataChange');
    },

    /**
     * @inheritdoc
     */
    _renderHtml: function() {
        //Add css class Tuan Anh
        this.rightColumns[0].css_class = 'customListView';
        this.rightColumns[0].fields[0].icon='fa-hand-pointer';
        this.rightColumns[0].fields[0].label='';
        this.rightColumns[0].fields[0].css_class = 'btn';
        //End
        var classesToAdd = 'duplicates highlight';
        this._super('_renderHtml');
        if (this.additionalTableClasses) {
            classesToAdd = classesToAdd + ' ' + this.additionalTableClasses;
        }
        this.$('table.table-striped').addClass(classesToAdd);
    },

    /**
     * Fetch the duplicate collection.
     *
     * @param {Backbone.Model} model Duplicate check model.
     * @param {Object} options Fetch options.
     */
    fetchDuplicates: function(model, options) {
        this.collection.dupeCheckModel = model;
        this.collection.fetch(options);
    }
})
