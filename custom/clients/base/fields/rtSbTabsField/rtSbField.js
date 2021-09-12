/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */

/**
 * @class View.Fields.Base.PipelineTypeField
 * @alias DOTB.App.view.fields.BasePipelineTypeField
 * @extends View.Fields.Base.BaseField
 */

({

  /**
   * @inheritdoc
   * @param options
   */
  initialize: function(options) {
    this._super('initialize', [options]);
    this.getTabs();

    this.showSettings = _.contains(app.metadata.getView("RT_DotbBoards").rtSbSettings.meta.Modules, this.module);
  },

  /**
   * Getting various PipelineType tabs with their header and module fields
   */
  getTabs: function() {
    this.tabs = [];
    var fieldsForTabs = [];
    var config = app.metadata.getView(this.module, 'rtDotbBoards');
    var lbl_by = (app.lang.getAppString('LBL_RT_BY')) ? app.lang.getAppString('LBL_RT_BY') : 'by';
    var keys = _.keys(app.metadata.getModule(this.module).fields);

    var self = this;
    config.groupBy = _.filter(config.groupBy, function(fie) {
      return App.acl.hasAccess('view', self.module, {
        field: fie,
        recordAcls: App.user.getAcls()[self.module]
      })
    });
    if (_.isArray(config.groupBy)) {
      config.groupBy = _.filter(config.groupBy, function(groupName) {
        return _.contains(keys, groupName);
      });
    }

    _.each(config.groupBy, function(field) {
      var fieldMeta = app.metadata.getModule(this.module, 'fields');
      var fieldLabel = fieldMeta[field].vname;
      var metaObject = {
        headerLabel: fieldLabel,
        moduleField: field,
        tabLabel: this.module + " " + lbl_by + " " + app.lang.get(fieldLabel, this.module)
      };
      this.tabs.push(metaObject);
    }, this);
  }
});