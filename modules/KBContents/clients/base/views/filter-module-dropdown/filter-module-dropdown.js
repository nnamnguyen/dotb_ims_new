

({
    extendsFrom: 'FilterModuleDropdownView',

    /**
     * @inheritdoc
     */
    getModuleListForSubpanels: function() {
        var filters = [];
        filters.push({id: 'all_modules', text: app.lang.get('LBL_MODULE_ALL')});

        var subpanels = this.pullSubpanelRelationships(),
            subpanelsAcls = this._getSubpanelsAclsActions();

        subpanels = this._pruneHiddenModules(subpanels);
        _.each(subpanels, function(value, key) {
            var module = app.data.getRelatedModule(this.module, value),
                aclToCheck = !_.isUndefined(subpanelsAcls[value]) ? subpanelsAcls[value] : 'list';

            if (app.acl.hasAccess(aclToCheck, module)) {
                filters.push({id: value, text: app.lang.get(key, this.module)});
            }
        }, this);
        return filters;
    },

    /**
     * Returns acl actions for subpanels based on metadata.
     * @return {Object} Alcs for subpanels.
     * @private
     */
    _getSubpanelsAclsActions: function() {
        var subpanelsMeta = app.metadata.getModule(this.module).layouts.subpanels,
            subpanelsAclActions = {};

        if (subpanelsMeta && subpanelsMeta.meta && subpanelsMeta.meta.components) {
            _.each(subpanelsMeta.meta.components, function(comp) {
                if (comp.context && comp.context.link) {
                    subpanelsAclActions[comp.context.link] = comp.acl_action ?
                        comp.acl_action : 'list';
                }
            });
        }

        return subpanelsAclActions;
    }
})
