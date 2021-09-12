

({
    extendsFrom: 'EditablelistbuttonField',

    /**
     * Overriding because Currencies cannot be unlinked nor deleted
     *
     * @inheritdoc
     * @override
     */
    getCustomSaveOptions: function(options) {
        options.complete = function() {};
        return options;
    }
})
