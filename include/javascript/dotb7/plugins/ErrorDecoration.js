
(function (app) {
    app.events.on("app:init", function () {
        app.plugins.register('ErrorDecoration', ['view'], {

            /**
             * Clears validation errors on start and success.
             *
             * @param {Object} component
             * @param {Object} plugin
             * @return {void}
             */
            onAttach: function(component, plugin) {
                this.on('init', function() {
                    this.model.on('validation:start validation:success', this.clearValidationErrors, this);
                }, this);
            },

            /**
             * Remove validation error decoration from fields
             *
             * @param fields Fields to remove error from
             */
            clearValidationErrors:function (fields) {
                fields = fields || _.toArray(this.fields);
                if (fields.length > 0) {
                    _.defer(function () {
                        _.each(fields, function (field) {
                            if (_.isFunction(field.clearErrorDecoration) && field.disposed !== true) {
                                field.isErrorState = false;
                                field.clearErrorDecoration();
                            }
                        });
                    }, fields);
                }
                _.defer(function() {
                    if (this.disposed) {
                        return;
                    }
                    this.$('.error').removeClass('error');
                    this.$('.error-tooltip').remove();
                    this.$('[data-toggle="tab"] .fa-exclamation-circle').remove();
                }, this);
            }
        });
    });
})(DOTB.App);
