/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 */
/**
 * @class View.Views.Base.ForecastsConfigScenariosView
 * @alias DOTB.App.view.layouts.BaseForecastsConfigScenariosView
 * @extends View.Views.Base.ConfigPanelView
 */
({
    extendsFrom: 'ConfigPanelView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
    },

    /**
     * @inheritdoc
     *
     */
    _render: function() {
        this._super('_render');
    },

    /**
     * @inheritdoc
     *
     * Sets up a binding to the start month dropdown to populate the day drop down on change
     *
     * @param {View.Field} field
     * @private
     */
    _renderField: function(field) {
        field.options.viewName = 'edit';
        field.options.click_to_edit = true;
        field.action = 'edit';
        field.tplName = 'edit';
        this._super('_renderField', [field]);
    },
})