
/**
 * @class View.Views.Base.Tags.RecordView
 * @alias DOTB.App.view.views.BaseTagsRecordView
 * @extends View.Views.Base.RecordView
 */
({
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        // Initialize collection
        this.collection = app.data.createBeanCollection('Tags');
        this._super('initialize', [options]);
    },

    /**
     * @inheritdoc
     */
    saveClicked: function() {
        var options = {
            showAlerts: true,
            success: _.bind(this.handleTagSuccess, this),
            error: _.bind(this.handleTagError, this)
        };
        this.checkForTagDuplicate(options);
    },

    /**
     * Handle fetch error
     */
    handleTagError: function() {
        app.alert.show('collections_error', {
            level: 'error',
            messages: 'LBL_TAG_FETCH_ERROR'
        });
    },

    /**
     * Handle fetch success
     * @param {array} collection
     */
    handleTagSuccess: function(collection) {
        if (collection.length > 0) {
            // duplicate found, warn user and quit
            app.alert.show('tag_duplicate', {
                level: 'warning',
                messages: app.lang.get('LBL_EDIT_DUPLICATE_FOUND', 'Tags')
            });
        } else {
            // no duplicate found, continue with save
            this._super('saveClicked');
        }
    },

    /**
     * Check to see if new name is a duplicate
     * @param tagName
     * @param options
     */
    checkForTagDuplicate: function(options) {
        this.collection.filterDef = [{
            'name_lower': {'$equals': this.model.get('name').toLowerCase()}
        }, {
            'id': {'$not_equals': this.model.get('id')}
        }];

        this.collection.fetch(options);
    }
})
