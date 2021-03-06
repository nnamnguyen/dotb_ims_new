
/**
 * @class View.Layouts.Base.DashletCellLayout
 * @alias DOTB.App.view.layouts.BaseDashletCellLayout
 * @extends View.Layouts.Base.DashletRowLayout
 */
({
    extendsFrom: 'DashletRowLayout',
    tagName: 'ul',
    className: 'dashlet-cell rows row-fluid',

    /**
     * @inheritdoc
     */
    _placeComponent: function(comp, def) {
        var span = 'dashlet-container span' + (def.width || 12),
            self = this;
        this.$el.append($('<li>', {'class': span, name: 'dashlet_' + comp.index}).data('index', function() {
            var index = def.layout.index.split('').pop();
            return self.index + '' + index;
        }).append(comp.el));
    },

    /**
     * Updates and sets metadata based on the meta param
     * @param {Object} meta
     * @return {Object} meta
     */
    setMetadata: function(meta) {
        meta.components = meta.components || [];
        _.each(meta.components, function(component, index){
            if(!(component.view || component.layout)) {
                meta.components[index] = _.extend({}, {
                    layout: {
                        type: 'dashlet',
                        index: this.index + '' + index,
                        empty: true,
                        components: [
                            {
                                view: 'dashlet-cell-empty',
                                context:{
                                    module:'Home',
                                    create:true
                                }
                            }
                        ]
                    }
                }, component);
            } else {
                var def = component.view || component.layout;
                if (!_.isObject(def)) {
                    def = component;
                }
                if(component.context) {
                    _.extend(component.context, {
                        forceNew: true
                    })
                }
                meta.components[index] = {
                    layout: {
                        type: 'dashlet',
                        index: this.index + '' + index,
                        label: def.label || def.name || "",
                        components: [
                            component
                        ]
                    },
                    width: component.width
                };
            }
        }, this);

        return meta;
    }
})
