

({
    extendsFrom: 'PanelTopView',

    plugins: ['KBContent'],

    /**
     * @inheritdoc
     */
    createRelatedClicked: function(event) {
        var parentModel = this.context.parent.get('model');
        if (parentModel) {
            this.createRelatedContent(parentModel, this.CONTENT_LOCALIZATION);
        }
    }
})
