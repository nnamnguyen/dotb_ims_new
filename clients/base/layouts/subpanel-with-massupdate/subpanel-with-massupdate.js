
/**
 * @class View.Layouts.Base.SubpanelWithMassupdateLayout
 * @alias DOTB.App.view.layouts.BaseSubpanelWithMassupdateLayout
 * @extends View.Layouts.Base.SubpanelLayout
 */
({
    extendsFrom:"SubpanelLayout",

    /**
     * Overriding to just check the items in a subpanel-with-massupdate
     * @inheritdoc
     * @override
     */
    _stopComponentToggle: function(component) {
        // subpanel header top should always render
        return component.name === "panel-top" || component.name === 'massupdate'
        || (!_.isUndefined(component.$el)
        && component.$el.hasClass('subpanel-header'));
    }
})
