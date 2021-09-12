
({

    events: {
        'click .search': 'showSearch'
    },

    _renderHtml: function() {
        if (app.acl.hasAccess('create', this.module)) {
            this.context.set('isCreateEnabled', true);
        }
        app.view.View.prototype._renderHtml.call(this);
    },

    showSearch: function() {
        // Toggle on search filter and off the pagination buttons
        this.$('.search').toggleClass('active');
        this.layout.trigger("list:search:toggle");
    }

})
