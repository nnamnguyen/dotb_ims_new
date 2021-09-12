
({
    extendsFrom: 'BaseKBContentsHtmleditable_tinymceField',

    /**
     * Override to load handlebar templates from `KBContents module
     * @inheritdoc
     */
    _loadTemplate: function() {
        var module = this.module;
        this.module = 'KBContents';
        this._super('_loadTemplate');
        this.module = module;
    }
})
