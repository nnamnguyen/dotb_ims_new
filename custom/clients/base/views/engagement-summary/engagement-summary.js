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
 * @package FTE Usage Tracking
 *
 */
({
    plugins: ['Dashlet'],

    initDashlet: function () {},

    loadData: function (options) {
        if (this.meta.config) {
            return;
        }

        this.demodata = [];
        var self = this;

        options = options || {};

        _.extend(options, {
            success: _.bind(function (data) {
                data.reportedActions = this._chunk(_.toArray(data.reportedActions), 3);
                this.data = data;

                this.render();
            }, this),
            error: _.bind(function () {
            }, this),
            complete: options ? options.complete : null
        })

        app.api.call("read", app.api.buildURL('logstats'), null, options);
    },

    _chunk: function (array, count) {
        if (count == null || count < 1) return [];
        var result = [];
        var i = 0, length = array.length;
        while (i < length) {
            result.push(Array.prototype.slice.call(array, i, i += count));
        }

        return result;
    }
})

