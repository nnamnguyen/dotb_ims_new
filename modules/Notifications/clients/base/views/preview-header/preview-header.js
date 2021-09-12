
/**
 * @class View.Views.Base.NotificationsPreviewHeaderView
 * @alias DOTB.App.view.views.BaseNotificationsPreviewHeaderView
 * @extends View.Views.Base.PreviewHeaderView
 */
({
    extendsFrom: 'PreviewHeaderView',

    /**
     * @inheritdoc
     *
     * @override To make 'previewEdit' always false. Notifications do not allow any editing (but not via module ACL).
     */
    checkACL: function(model) {
        this._super('checkACL', [model]);
        this.layout.previewEdit = false;
    }
})
