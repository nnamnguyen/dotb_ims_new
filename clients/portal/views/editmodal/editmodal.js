
({
    extendsFrom: 'EditmodalView',

    /**
     * @inheritdoc
     *
     * Sets the `portal_flag` attribute to `true` on the model.
     */
    processModel: function(model) {
        this._super('processModel', [model]);

        if (model) {
            model.set('portal_flag', true);
        }
    }
})
