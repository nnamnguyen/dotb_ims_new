

({
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this._initializeCollectionFilterDef(options);
    },

    /**
     * Initialize collection in the sub-sub-component recordlist
     * with specific filterDef using tags for build recordlist
     * filtered by tags.
     *
     * @param {Object} options
     * @private
     */
    _initializeCollectionFilterDef: function(options) {
        if (_.isUndefined(options.def.context.tag)) {
            return;
        }

        var filterDef = {
            filter: [{
                tag: {
                    $in: [{
                        id: false,
                        name: options.def.context.tag
                    }]
                },
                active_rev: {
                    $equals: 1
                }
            }]
        };

        var chain = ['sidebar', 'main-pane', 'list', 'recordlist'];
        var recordList = _.reduce(chain, function(component, name) {
            if (!_.isUndefined(component)) {
                return component.getComponent(name);
            }
        }, this);

        if (!_.isUndefined(recordList)) {
            recordList.collection.filterDef = filterDef;
        }
    }
})
