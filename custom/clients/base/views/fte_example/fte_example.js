/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * This file is part of the 'Goto data' module.
 * Author: Olivier Nepomiachty DotBCRM - DotbLabs
 */
({
    plugins: ['Dashlet'],

    initDashlet: function () {},

    loadData: function (options) {
        if(this.meta.config){
            return;
        }

        this.demodata = [];
        var self = this;

        options = options || {};

        _.extend(options, {
            success: _.bind(function (data) {
                this.createBeans(data);
                this.render();
            }, this),
            error: _.bind(function () {
            }, this),
            complete: options ? options.complete : null
        })

        app.api.call("read", app.api.buildURL('examples'), null, options);
    },

    createBeans: function (data) {
        var items = [];
        _.each(data, function (item, index) {
            if (item) {
                var bean = app.data.createBean(item._module, {"id": item.id, "name": item.name});
                items.push(bean);
            }
        }, this);

        if(items.length > 0){
            this.demodata.push({items: items});
        }
    }
})

