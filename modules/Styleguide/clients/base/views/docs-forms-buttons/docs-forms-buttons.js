
({
    _render: function() {
        this._super('_render');
        // button state demo
        this.$('#fat-btn').click(function () {
            var btn = $(this);
            btn.button('loading');
            setTimeout(function () {
              btn.button('reset');
            }, 3000);
        })
    }
})
