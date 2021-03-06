
({
    /**
     * @inheritdoc
     */
    _render: function() {
        var action = 'view';
        if (this.def.link && this.def.route) {
            action = this.def.route.action;
        }
        if (((!app.acl.hasAccess('developer', this.model.get('cas_dotb_module')) || this.model.get('prj_deleted') == '1')
            && this.def.name == 'pro_title') ||
            (!app.acl.hasAccess(action, this.model.get('cas_dotb_module')) && this.def.name == 'cas_title')) {
            this.def.link = false;
        }
        if (this.def.link) {
            this.href = this.buildHref();
        }
        app.view.Field.prototype._render.call(this);
    },


    _isErasedField: function() {
        var erased = false;
        if (this.def.name == 'cas_title') {
            var module;
            if (this.model.attributes.is_a_person) {
                module = this.model.module;
                this.model.module = this.model.attributes.cas_dotb_module;
                this.model.fields.name.type = 'fullname';
                this.model.attributes.cas_title = app.utils.formatNameModel(
                    this.model.attributes.cas_dotb_module,
                    this.model.attributes
                );
            }
            erased = app.utils.isNameErased(this.model);
            if (this.model.attributes.is_a_person) {
                this.model.module = module;
            }
        }
        return erased;
    },

    buildHref: function() {
        var defRoute = this.def.route ? this.def.route : {},
            module = this.model.module || this.context.get('module');
        switch (this.def.name) {
            case 'pro_title':
                return '#' + app.router.buildRoute('pmse_Project', this.model.attributes.prj_id, defRoute.action, this.def.bwcLink);
                break;
            case 'cas_title':
                return '#' + app.router.buildRoute(this.model.attributes.cas_dotb_module, this.model.attributes.cas_dotb_object_id, defRoute.action, this.def.bwcLink);
                break;
        }
    },

    unformat: function(value) {
        return _.isString(value) ? value.trim() : value;
    }
})
