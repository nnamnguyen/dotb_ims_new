
({
    // dashboards home
    _renderHtml: function () {
        var self = this;
        this._super('_renderHtml');

        this.$('.dashlet-example').on('click.styleguide', function(){
            var dashlet = $(this).data('dashlet'),
                metadata = app.metadata.getView('Home', dashlet).dashlets[0];
            metadata.type = dashlet;
            metadata.component = dashlet;
            self.layout.previewDashlet(metadata);
        });

        this.$('[data-modal]').on('click.styleguide', function(){
            var modal = $(this).data('modal');
            $(modal).appendTo('body').modal('show');
        });
    },

    _dispose: function() {
        this.$('.dashlet-example').off('click.styleguide');
        this.$('[data-modal]').off('click.styleguide');
        this._super('_dispose');
    }
})
