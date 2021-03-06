
({
    // components dropdowns
    _renderHtml: function () {
        this._super('_renderHtml');

        this.$('[data-alert]').on('click', function() {

            var $button = $(this),
                level = $button.data('alert'),
                state = $button.text(),
                auto_close = ['info','success'].indexOf(level) > -1;

            app.alert.dismiss('core_meltdown_' + level);

            if (state !== 'Example') {
                $button.text('Example');
            } else {
                app.alert.show('core_meltdown_' + level, {
                    level: level,
                    messages: 'The core is in meltdown!!',
                    autoClose: auto_close,
                    onClose: function () {
                        $button.text('Example');
                    }
                });
                $button.text('Dismiss');
            }
        });
    },

    _dispose: function() {
        this.$('[data-alert]').off('click');
        app.alert.dismissAll();

        this._super('_dispose');
    }
})
