({
    events: {
        'click button[name=rtSbBtn]': 'changeDotbBoard',
    },

    initialize: function (options) {
        this._super('initialize', [options]);
        this.tabsTypes = [];
        _.each(this.meta.fields, function (field) {
            if (field.type == "rtSbTabsField") {
                this.tabsTypes.push(field);
            }
        }, this);

        var config = app.metadata.getView(this.module, 'rtDotbBoards');
        var modMeta = app.metadata.getModule(this.module);
        var self = this;
        config.groupBy = _.filter(config.groupBy, function (fie) {
            return App.acl.hasAccess('view', self.module, {
                field: fie,
                recordAcls: App.user.getAcls()[self.module]
            })
        });
        if (_.isArray(config.groupBy)) {
            config.groupBy = _.filter(config.groupBy, function (groupName) {
                return _.contains(_.keys(modMeta.fields), groupName);
            });
        }
        var rtTabType = config.groupBy[0];

        this.tabStateKey = app.user.lastState.buildKey('last-tab', 'rtDotbBoards', this.module);
        rtTabType = app.user.lastState.get(this.tabStateKey) || rtTabType;
        this.context.get('model').set('rtSbTabsField', rtTabType);
    },

    changeDotbBoard: function (event) {

        var $currentTarget = this.$(event.currentTarget);
        if ($currentTarget.hasClass('selected')) {
            return;
        }

        this.$('button[name=rtSbBtn]').removeClass('selected');
        $currentTarget.addClass('selected');

        var rtDotbBoards = this.layout.getComponent('rtDotbBoards');
        var rtSbSettings = this.layout.getComponent('rtSbSettings');
        rtSbSettings.displayConfig = false;
        rtDotbBoards.displayBoard = true;
        if (event.currentTarget.attributes[2].nodeValue == "settings") {
            rtSbSettings.stepTwo();
            //rtDotbBoards.renderSettings();
            rtDotbBoards.displayBoard = false;
            rtDotbBoards.render();
            rtSbSettings.displayConfig = true;
            rtSbSettings.stepTwo();
        } else {
            rtSbSettings.render();
            rtDotbBoards.changeGroupingAndRender(event.currentTarget.attributes[1].nodeValue);
            app.user.lastState.set(this.tabStateKey, event.currentTarget.attributes[1].nodeValue);
        }
    },
})