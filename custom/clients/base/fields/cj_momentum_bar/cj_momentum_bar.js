/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
(function (app) {

    return {

        plugins: ['Tooltip'],

        /**
         * @inheritDoc
         */
        _render: function() {
            var ratio = this.model.get("momentum_ratio");

            if (ratio >= 0.75) {
                this.barColor = "#33800d";
            } else if (ratio >= 0.5) {
                this.barColor = "#e5a117";
            } else if (ratio >= 0.25) {
                this.barColor = "#fb8724";
            } else {
                this.barColor = "#e61718";
            }

            this._super('_render');
        },

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
            return Math.round(progress);
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
