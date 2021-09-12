({
    extendsFrom: 'RowactionField',
    events: {
        'click a[name="copy_to_user"]': 'searchDrawer',
        'click a[name="copy_to_team"]': 'searchDrawer',
        'click a[name="copy_to_role"]': 'searchDrawer',
    },

    searchDrawer: function (evt) {


        var abc = new app.utils.FilterOptions()
            .config({
                'initial_filter': 'custom_copy',
                'filter_populate': {
                    'private': 1,
                }
            })
            .format();
        var layout = 'multi-selection-list';
        var context = {
            module: $(evt.currentTarget).attr("targetmodule"),
        };

        if ($(evt.currentTarget).attr("targetmodule") == 'Teams') {
            layout = 'selection-list';
            _.extend(context, {
                filterOptions: abc
            });
        } else {
            _.extend(context, {
                preselectedModelIds: _.clone(this.model.get(this.def.id_name)),
                maxSelectedRecords: this._maxSelectedRecords,
                isMultiSelect: true
            });
        }


        app.drawer.open({
            layout: layout,
            context: context
        }, _.bind(this.setUserDashboard, this));
    },
    setUserDashboard: function (model) {
        if(!model){
            return;
        }
        var self = this;
        app.alert.show('dashboard_progress', {
            level: 'process',
            title: 'In Process...'
        });
        app.api.call("create", app.api.buildURL('copy_dashboard'), {model: model, moduleName: self.def.target_module, idDashboard: self.model.id}, {
            success: function (res) {
                app.alert.dismiss('dashboard_progress');
                app.alert.show('message-id', {
                    level: 'success',
                    autoClose: true
                });
                $('[data-action="refreshList"]>button').trigger('click');
            }
        });
    }
})
