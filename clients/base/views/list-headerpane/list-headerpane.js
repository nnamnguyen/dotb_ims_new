({
    extendsFrom: 'HeaderpaneView',
    initialize: function (options) {
        options.meta = _.extend(
            {},
            app.metadata.getView(null, 'list-headerpane'),
            app.metadata.getView(options.module, 'list-headerpane'),
            options.meta
        );
        //Add by Tuan Anh add btn primary for create btn
        if(typeof options.meta.buttons[0] != "undefined"){
            options.meta.buttons[0].css_class ='btn-primary ' +  options.meta.buttons[0].css_class;
        }
        //End
        //Add by Tuan Anh to disable import v-card
        options.meta.buttons = _.reject(options.meta.buttons, function (button) {
            return button.label == 'LNK_IMPORT_VCARD';
        });
        //End
        this._super('initialize', [options]);
    }
})
