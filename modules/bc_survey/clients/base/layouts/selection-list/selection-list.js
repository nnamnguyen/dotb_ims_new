/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */
/**
 * @class View.Layouts.Base.SelectionListLayout
 * @alias DOTB.App.view.layouts.BaseSelectionListLayout
 * @extends View.Layout
 */
({
    plugins: ['ShortcutSession'],

    shortcuts: [
        'Headerpane:Cancel',
        'Sidebar:Toggle'
    ],

    loadData: function (options) {

        var fields = _.union(this.getFieldNames(), (this.context.get('fields') || []));
        this.context.set('fields', fields);
        this.context.set("currentFilterId", "survey-records");
        this._super('loadData', [options]);
    }
})
