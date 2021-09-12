
/**
 * Sticky Rowaction does not disappear when user does not have access.
 *
 * It becomes disabled instead. This allows us to keep things lined up nicely
 * in Subpanel.
 *
 * @class View.Fields.Base.StickyRowactionField
 * @alias DOTB.App.view.fields.BaseStickyRowactionField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',
    /**
     * @param options
     * @override
     */
    initialize: function(options) {
        this._super("initialize", [options]);
        this.type = 'rowaction';  //TODO Hack that loads rowaction templates.  I hope to remove this when SP-966 is fixed.
    },
    /**
     * We always render StickyRowactions and instead set disable class when the user has no access
     * @private
     */
    _render: function() {
        if(this.isDisabled()){
            if(_.isUndefined(this.def.css_class) || this.def.css_class.indexOf('disabled') === -1){
                this.def.css_class = (this.def.css_class) ? this.def.css_class + " disabled" : "disabled";
            }
            //Remove event listeners on this action since it is disabled
            this.undelegateEvents();
        }
        // this can't be inside the isDisabled if block above because css_class can be set to 'disabled' by metadata
        if (!_.isUndefined(this.def.css_class) && this.def.css_class.indexOf('disabled') !== -1) {
            this.tabIndex = -1;
        }

        this._super("_render");
    },
    /**
     * Essentially the replacement of 'hasAccess' method for implementors of StickyRowactionField.
     * Used to determine if this rowaction should be rendered in a disabled state because the user lacks permission, etc.
     *
     * This is a default implementation disables when the user lacks access.
     * @return {boolean}
     */
    isDisabled: function(){
        return !this._super("hasAccess");
    },
    /**
     * Forces StickyRowaction to be rendered and visible in Actiondropdowns.
     * @return {boolean} `true` always
     */
    hasAccess: function(){
        return true;
    }

})
