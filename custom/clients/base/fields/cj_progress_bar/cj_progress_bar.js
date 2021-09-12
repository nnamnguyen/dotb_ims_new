/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
(function (app) {

    return {

        plugins: ['Tooltip'],

        /**
         * {@inheritDoc}
         *
         * @param {Number} value
         * @return {Number}
         */
        unformat: function (value) {
            var progress = parseFloat(value);
            progress /= 100;
            return progress;
        },

        /**
         * {@inheritDoc}
         *
         * @param {Number} value
         * @return {Number}
         */
        format: function (value) {
            var progress = parseFloat(value);
            progress *= 100;
            return parseInt(progress);
        },

        /**
         * @private
         */
        _loadTemplate: function () {
            // Always use the detail template
            this.options.viewName = "detail";
            app.view.Field.prototype._loadTemplate.call(this);
        }

    }

}(DOTB.App))
