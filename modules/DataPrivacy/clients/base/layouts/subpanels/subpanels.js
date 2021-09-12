
/**
 * @class View.Layouts.Base.DataPrivacy.SubpanelsLayout
 * @alias DOTB.App.view.layouts.DataPrivacySubpanelsLayout
 * @extends View.Layout.Base.SubpanelsLayout
 */
({
    /**
     * @inheritdoc
     * inject the Mark for Erase action link to all subpanels
     */
    initComponents: function(component, def) {
        this._super('initComponents', arguments);

        // Add the erase action to all subpanel rowactions
        _.each(this._components, function(comp) {
            if (!comp.getComponent) {
                return;
            }
            var viewName = 'subpanel-list';
            if (comp.meta && comp.meta.components) {
                _.find(comp.meta.components, function(def) {
                    var name = '';
                    var prefix = 'subpanel-for';
                    if (def.view) {
                        name = _.isObject(def.view) ? def.view.name || def.view.type : def.view;
                    }

                    if (name === 'subpanel-list' || _.isString(name) && name.substr(0, prefix.length) === prefix) {
                        viewName = name;
                        return true;
                    }

                    return false;
                });
            }
            var subView = comp.getComponent(viewName);
            if (subView && subView.meta && subView.meta.rowactions && subView.meta.rowactions.actions) {
                subView.meta.rowactions.actions.push({
                    'type': 'dataprivacyerase',
                    'icon': 'fa-search-plus',
                    'name': 'dataprivacy-erase',
                    'label': 'LBL_DATAPRIVACY_MARKFORERASE'
                });
            }
        });
    }
})
