({
    extendsFrom: 'TogglepanelLayout',
    processToggles: function (options) {
        var newToggles = app.config.modules_use_kanban;
        if (options.context.attributes.layout === 'records') {
            if ($.inArray(options.module, newToggles) !== -1) {
                if (!_.isEmpty(options.meta.availableToggles) &&
                    _.isEmpty(
                        _.find(options.meta.components, function (comp) {
                            return comp.layout === 'rtDotbBoards';
                        })
                    )) {
                    // push options.meta.components
                    options.meta.components.push({
                        layout: "rtDotbBoards"
                    });
                    // push options.meta.availableToggles
                    var rtSB = {
                        name: 'rtDotbBoards',
                        icon: 'fa-columns',
                        label: 'LBL_SB_DOTB_BOARDS'
                    };
                    options.meta.availableToggles.push(rtSB);
                }
                $('head').append('<link rel="stylesheet" type="text/css" href="modules/RT_DotbBoards/css/rtSB.css">');
            } else if (!_.isEmpty(
                _.find(options.meta.components, function (comp) {
                    return comp.layout === 'rtDotbBoards';
                })
            )) {
                options.meta.components = _.filter(options.meta.components, function (comp) {
                    return comp.layout !== 'rtDotbBoards';
                });
                options.meta.availableToggles = _.filter(options.meta.availableToggles, function (tog) {
                    return tog.name !== 'rtDotbBoards';
                })
            }
        }

        this._super('processToggles', [options]);
    },
})