
/**
 * @class View.ComposeDotbLinksListView
 * @alias DOTB.App.view.views.ComposeDotblinksListView
 * @extends View.FlexListView
 */

({
    extendsFrom: 'FlexListView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
    },

    /**
     * @inheritdoc
     * Load data from api endpoint
     */
    loadData: function() {
        var self = this;
        var baseModule = this.context.get('baseModule');
        var url = app.api.buildURL('pmse_Emails_Templates', baseModule +  '/find_modules', null, {module_list: baseModule});
        app.alert.show('dotb_link_load', {level: 'process'})
        app.api.call('GET', url, null, {
            success: function(data) {
                var processedData = self._processResults(data.result);
                if (self.collection) {
                    self.collection.add(processedData);
                    self.collection.dataFetched = true;
                    self.render();
                }
                app.alert.dismiss('dotb_link_load', {level: 'process'});

            },
            error: function(e) {
                app.alert.dismiss('dotb_link_load', {level: 'process'});
            }
        });

    },

    /**
     * Sanitize the results by cleaning up names and adding how module is related
     * to the target module
     * @param results
     * @returns {*} array of target module and related modules
     * @private
     */
    _processResults: function(results) {
        var targetModule = _.first(results);
        var relatedModules = _.rest(results, 1)

        //strip off '<' and '>' from target module's name
        targetModule.text = targetModule.text.substring(1, targetModule.text.length-1);
        targetModule.relatedTo = app.lang.get('LBL_BASE_MODULE', 'pmse_Emails_Templates');

        _.map(relatedModules, function(relatedModule){
            return _.extend(relatedModule, {relatedTo: app.lang.get('LBL_RELATED_TO_TARGET_MODULE', 'pmse_Emails_Templates')})
        });
        relatedModules.unshift(targetModule);
        return relatedModules;
    }
})
