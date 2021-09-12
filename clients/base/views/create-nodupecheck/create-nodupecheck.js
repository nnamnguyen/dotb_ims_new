
/**
 * @class View.Views.Base.CreateNodupecheckView
 * @alias DOTB.App.view.views.BaseCreateNodupecheckView
 * @extends View.Views.Base.CreateView
 */
({
    extendsFrom: 'CreateView',

    initialize: function(options) {
        this._super("initialize", [options]);
        this.enableDuplicateCheck = false;
    }
})
