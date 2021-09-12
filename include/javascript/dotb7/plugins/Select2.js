
(function($) {
    $(function() {
        if (!window.Select2) {
            return;
        }
        var originalDestroy = window.Select2.class.abstract.prototype.destroy;

        _.extend(window.Select2.class.abstract.prototype, {
            /**
             * @inheritdoc
             *
             * Dispose safe select2 drop mask on destroy.
             */
            destroy: function() {
                originalDestroy.call(this);
                var mask = $('#select2-drop-mask');
                mask.remove();
            }
        });

    });
})(jQuery);
