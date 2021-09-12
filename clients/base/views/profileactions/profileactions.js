
/**
 * @class View.Views.Base.ProfileactionsView
 * @alias DOTB.App.view.views.BaseProfileactionsView
 * @extends View.View
 */
({
    plugins: ['Dropdown'],

    initialize: function(options) {
        app.view.View.prototype.initialize.call(this, options);
        app.events.on("app:sync:complete", this.render, this);
        app.events.on("bwc:avatar:removed", this.bwcAvatarRemoved, this);
        app.user.on("change:picture", this.setCurrentUserData, this);
    },

    /**
     * Render profile actions dropdown menu
     * @private
     */
    _renderHtml: function() {
        // FIXME check why the router is not loaded before all the other components are rendered
        if (!app.router || !app.api.isAuthenticated() || app.config.appStatus === 'offline') {
            return;
        }

        if (!_.isEmpty(this.meta)) {
            this.menulist = this.filterAvailableMenu(app.utils.deepCopy(this.meta));
        }
        this._super('_renderHtml');
    },

    /**
     * Filters menu metadata
     * @param Array menuMeta
     * @return {Array}
     */
    filterAvailableMenu: function(menuMeta){
        var result = [];
        _.each(menuMeta,function(item) {
            item = this.filterMenuProperties(item);
            if (!_.isEmpty(item.acl_module) &&
                !app.acl.hasAccess(item.acl_action, item.acl_module)) {
                return;
            }

            // if current user is neither a developer nor allowed to access admin actions,
            // but the action is reserved for admin, skip this action
            if (!app.acl.hasAccessToAny('developer') &&
                !app.acl.hasAccess('admin', 'Administration') &&
                item.acl_action === 'admin') {
                return;
            }

            result.push(item);
        },this);
        return result;
    },

    /**
     * Filters single menu data
     * @param Array menu data
     * @return {Array}
     */
    filterMenuProperties:function(singleItem){
        if(singleItem['label'] === 'LBL_PROFILE'){
            singleItem['img_url'] = this.pictureUrl;
        }

        //handle with new button - Lap Nguyen
        if(_.contains(['LBL_MANAGE_TEAMS_TITLE', 'LBL_STUDIO', 'LBL_CONFIG_TABS'], singleItem['label'])){
            singleItem['label'] = app.lang.get( singleItem['label'], 'Administration');
        }

        return singleItem;
    },
    //TODO: Remove once bwc is completely pruned out of the product
    bwcProfileEntered: function() {
        //Refetch latest user data (since bwc updated avatar); reset
        var self = this;
        app.user.load(function() {
            self.setCurrentUserData();
        });
    },
    //This will get called when avatar is removed from bwc User profile edit (SP-1949)
    //TODO: Remove once bwc is completely pruned out of the product
    bwcAvatarRemoved: function() {
        app.user.set("picture", '');//so `this.pictureUrl` is falsy and default avatar kicks in on .hbs template
        this.setCurrentUserData();
    },
    /**
     * Sets the current user's information like full name, user name, avatar, etc.
     * @protected
     */
    setCurrentUserData: function() {
        this.fullName = app.user.get("full_name");
        this.userName = app.user.get("user_name");
        this.userId = app.user.get('id');
        var picture = app.user.get("picture");

        this.pictureUrl = picture ? app.api.buildFileURL({
            module: "Users",
            id: this.userId,
            field: "picture"
        }, {
            cleanCache: true
        }) : '';

        this.render();
    },
    _dispose: function() {
        if (app.user) app.user.off(null, null, this);
        app.view.View.prototype._dispose.call(this);
    }
})
