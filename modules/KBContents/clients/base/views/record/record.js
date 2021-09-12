

({
    extendsFrom: 'RecordView',

    /**
     * @inheritdoc
     *
     * Add KBContent plugin for view.
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], [
            'KBContent'
        ]);

        this._super('initialize', [options]);
        this.context.on('kbcontents:category:deleted', this._categoryDeleted, this);
    },

    /**
     * Process record on category delete.
     * @param {Object} node
     * @private
     */
    _categoryDeleted: function(node) {
        if (this.model.get('category_id') === node.data('id')) {
            this.model.unset('category_id');
            this.model.unset('category_name');
        }
        if (this.disposed) {
            return;
        }
        this.render();
    },

    /**
     * @inheritdoc
     *
     * Need to switch field to `edit` if it has errors.
     */
    handleFieldError: function(field, hasError) {
        this._super('handleFieldError', [field, hasError]);
        if (hasError && field.tplName === 'detail') {
            field.setMode('edit');
        }
    }

})
