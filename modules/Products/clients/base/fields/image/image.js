
({
    extendsFrom: 'BaseImageField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        // if this image exists in the Quotes QLI quote data section, force it
        // to use a detail template and don't allow the image field to be editable
        if (this.view.module === 'ProductBundles') {
            this.action = 'detail';
            this.options.viewName = 'detail';
            this.def.width = 16;
            this.def.height = 16;
        }
    }
})
