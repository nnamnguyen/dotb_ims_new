
(function(app) {
    app.events.on('app:init', function() {
        /**
         * ListEditable plugin is for fields that use a list-edit template instead of the standard edit
         * during inline editing on list views
         */
        app.plugins.register('ListEditable', ['field'], {
            _loadTemplate: function() {
                //Invoke the original method first
                Object.getPrototypeOf(this)._loadTemplate.call(this);
                if (this.view.action === 'list' && _.contains(['edit', 'disabled'], this.tplName)) {
                    var tplName = 'list-' + this.tplName;
                    this.template = app.template.getField(this.type, tplName, this.module, this.tplName) ||
                        app.template.empty;
                    this.tplName = tplName;
                }
            }
        });
    })
})(DOTB.App);
