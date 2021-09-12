({
    extendsFrom: 'ImageField',

    plugins: ['File', 'FieldDuplicate'],

    MAPSIZECLASS: {
        'large': 'label-module-lg',
        'medium': 'label-module-md',
        'button': 'label-module-btn',
        'default': '',  //This field does not fallback to this size
        'small': 'label-module-sm',
        'mini': 'label-module-mini'
    },

    /**
     * @override
     * @private
     */
    _render: function () {
        var template, className;

        //add by TKT
        this.icon = 'far fa-box';
        if (typeof app.config.module_icon[this.module] != "undefined") this.icon = app.config.module_icon[this.module].src;

        this._super("_render");
        if (this.action !== 'edit' || this.view.name === 'merge-duplicates') {
            if (_.isEmpty(this.value)) {
                className = _.isUndefined(this.MAPSIZECLASS[this.def.size]) ? this.MAPSIZECLASS['large'] : this.MAPSIZECLASS[this.def.size];
                // load the module icon template
                template = app.template.getField(this.type, 'module-icon', this.module);
                if (template) {
                    this.$('.image_field').replaceWith(template({
                        module: this.module,
                        labelSizeClass: className,
                        tooltipPlacement: app.lang.direction === 'ltr' ? 'right' : 'left',
                        icon: this.icon
                    }));
                }
            } else {
                // add the image_rounded class to the image_field div when there is an avatar to display
                this.$('.image_field').addClass('image_rounded');
            }
        }
        return this;
    },
    _loadTemplate: function () {
        this.type = 'image';
        this._super("_loadTemplate");
        this.type = this.def.type;
    }
})
