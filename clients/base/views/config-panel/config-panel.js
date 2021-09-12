
/**
 * @class View.Views.Base.ConfigPanelView
 * @alias DOTB.App.view.views.BaseConfigPanelView
 * @extends View.View
 */
({
    /**
     * Holds the changing date value for the title
     */
    titleSelectedValues: '',

    /**
     * Holds the view's title name
     */
    titleViewNameTitle: '',

    /**
     * Holds the collapsible toggle title template
     */
    toggleTitleTpl: {},

    /**
     * Holds the vars for the title template
     * <pre><code>
     * {
     *  title: this.titleViewNameTitle,
     *  selectedValues: this.titleSelectedValues,
     *  viewName: this.name
     * }
     * <pre><code>
     */
    titleTemplateVars: {},

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        this.toggleTitleTpl = app.template.getView('config-panel.title');

        if (this.meta.label) {
            this.titleViewNameTitle = app.lang.get(this.meta.label, this.module);
        }
    },

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        this._super('bindDataChange');

        this.on('config:panel:hide', this.onConfigPanelHide, this);
        this.on('config:panel:show', this.onConfigPanelShow, this);
    },

    /**
     * @inheritdoc
     */
    _render: function() {
        this._super('_render');

        // add accordion-group class to wrapper $el div
        this.$el.addClass(this.name + '-group accordion-group');

        // update the title every render
        this.updateTitle();
    },

    /**
     * Updates the accordion toggle title
     */
    updateTitle: function() {
        // update the title values
        this._updateTitleValues();
        // update the title template vars
        this._updateTitleTemplateVars();

        // then inject them into the template
        this.$('#' + this.name + 'Title').html(this.toggleTitleTpl(this.titleTemplateVars));
    },

    /**
     * Updates `this.titleSelectedValues` before updating title so child classes
     * can set up how the title should be displayed
     * @private
     */
    _updateTitleValues: function() {
        this.titleSelectedValues = this.model.get(this.name);
    },

    /**
     * Updates `this.titleTemplateVars` before updating title so child classes
     * can set up how the title should be displayed
     * @private
     */
    _updateTitleTemplateVars: function() {
        this.titleTemplateVars = {
            title: this.titleViewNameTitle,
            selectedValues: this.titleSelectedValues,
            viewName: this.name
        };
    },

    /**
     * Handles when the config panel is hidden
     */
    onConfigPanelHide: function() {
    },

    /**
     * Handles when the config panel is shown
     */
    onConfigPanelShow: function() {
    }
})
