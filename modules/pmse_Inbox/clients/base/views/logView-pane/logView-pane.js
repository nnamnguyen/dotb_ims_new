

({
    /**
     * @inheritdoc
     *
     * Sets up the file field to edit mode
     *
     * @param {View.Field} field
     * @private
     */
    _renderField: function(field) {
        if (app.acl.hasAccessToAny('developer')) {
            app.view.View.prototype._renderField.call(this, field);
            field.$el.children().css('width','100%');
            field.$el.children().attr('readonly','readonly');
        } else {
            app.controller.loadView({
                layout: 'access-denied'
            });
        }
    }
})
