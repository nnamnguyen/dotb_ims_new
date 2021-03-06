
/**
 * @class View.Layouts.Base.ConfigDrawerContentLayout
 * @alias DOTB.App.view.layouts.BaseConfigDrawerContentLayout
 * @extends View.Layout
 *
 * Triggered Events:
 *  config:howtoData:change - When a different accordion panel is clicked, a howtoData:change event will be triggered
 *      with the current how-to data for View.Views.Base.ConfigHowToView to listen for and update
 */
({
    events: {
        'click .accordion-toggle': 'onAccordionToggleClicked'
    },

    /**
     * The HTML ID of the Accordion divs
     */
    collapseDivId: 'config-accordion',

    /**
     * The currently-selected config panel
     */
    selectedPanel: undefined,

    /**
     * The current HowTo data Object
     */
    currentHowToData: undefined,

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.currentHowToData = {};
        this._initHowTo();
    },

    /**
     * @inheritdoc
     */
    _render: function() {
        var $toggles;

        this._super('_render');

        //This is because backbone injects a wrapper element.
        this.$el.addClass('accordion');
        this.$el.attr('id', this.collapseDivId);
        $toggles = this.$('.accordion-toggle');
        // ignore the first accordion toggle
        $toggles.splice(0, 1);
        $toggles.addClass('collapsed');

        //apply the accordion to this layout
        this.$('.collapse').collapse({
            toggle: false,
            parent: '#' + this.collapseDivId
        });

        // select the first panel in metadata
        this.selectPanel(_.first(this.meta.components).view);
    },

    /**
     * Used to select a specific panel by name
     * Correct names can be found in the specific view's hbs
     * Specifically found in the id attribute of '.accordion-heading a'
     *
     * @param {String} panelName The ID name of the panel to select
     */
    selectPanel: function(panelName) {
        this.selectedPanel = panelName;
        this.$('#' + panelName + 'Collapse').collapse('show');
    },

    /**
     * Event handler for 'click .accordion-toggle' event
     *
     * @param {jQuery.Event|undefined} evt
     */
    onAccordionToggleClicked: function(evt) {
        var panelName = (evt) ? $(evt.currentTarget).data('help-id') : this.selectedPanel;
        var oldPanel;
        var newPanel;

        if (evt && panelName === this.selectedPanel) {
            // dont allow closing the same tab
            return false;
        }

        this._switchHowToData(panelName);

        this.context.trigger('config:howtoData:change', this.currentHowToData);

        if (this.selectedPanel) {
            oldPanel = _.find(this._components, function(component) {
                return component.name === this.selectedPanel;
            }, this);

            if (oldPanel) {
                oldPanel.$('.accordion-toggle').addClass('collapsed');
                oldPanel.trigger('config:panel:hide');
            }
        }

        this.selectedPanel = panelName;

        newPanel = _.find(this._components, function(component) {
            return component.name === panelName;
        }, this);
        newPanel.trigger('config:panel:show');
    },

    /**
     * Function for child modules to initialize their own HowTo data
     *
     * @private
     */
    _initHowTo: function() {
    },

    /**
     * Handles switching the HowTo text and info by a specific accordion view being toggled
     *
     * @param {string} helpId The panel component name
     * @private
     */
    _switchHowToData: function(helpId) {
    },

    /**
     * Allows child config views with specific needs to be able to 'manually' update the HowTo text
     *
     * @param title
     * @param text
     */
    changeHowToData: function(title, text) {
        this.currentHowToData.title = title;
        this.currentHowToData.text = text;
        this.context.trigger('config:howtoData:change', this.currentHowToData);
    }
})
