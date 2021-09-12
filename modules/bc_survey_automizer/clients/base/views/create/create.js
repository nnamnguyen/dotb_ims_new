({
    /**
     * The file used to handle actions for create for survey template
     *
     * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
     * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
     * agreed to the terms and conditions of the License, and you may not use this file except in compliance
     * with the License.
     *
     * @author     Biztech Consultancy
     */
    extendsFrom: 'CreateView',
    initialize: function (options) {

        // checking licence configuration ///////////////////////

        var url = App.api.buildURL("bc_survey", "checkingLicenseStatus", "", {});
        App.api.call('GET', url, {}, {
            success: function (data) {
                if (data != 'success') {
                    location.assign('#bc_survey_automizer/layout/access-denied');
                }
            },
        });

        this._super('initialize', [options]);
    },
    /**
     * Save and close drawer
     */
    saveAndClose: function () {
        this.initiateSave(_.bind(function () {
            if (this.closestComponent('drawer')) {
                app.drawer.close(this.context, this.model);
            } else {
                app.navigate(this.context, this.model);
            }
            javascript:parent.DOTB.App.router.navigate("bc_survey_automizer/" + this.model.id, {trigger: true});
        }, this));
    },
    _dispose: function () {
        //additional stuff before calling the core create _dispose goes here
        this._super('_dispose');
    }

})
