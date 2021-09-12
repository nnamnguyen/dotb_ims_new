({
    initialize: function (options) {
        this._super('initialize', [options]);
        this.fields = [];

        var inlineTag = this.def.inline ? '-inline' : '';
        this.def.css_class = (this.def.css_class ? this.def.css_class + ' fieldset' :
            'fieldset') + inlineTag;

        if (this.def.equal_spacing && this.def.inline) {
            this.def.css_class += ' fieldset-equal';
        }
    },

    _getFallbackTemplate: function (viewName) {
        if (_.contains(this.fallbackActions, viewName)) {
            return viewName;
        }
        if (app.template.get('f.' + this.type + '.' + this.view.fallbackFieldTemplate)) {
            return this.view.fallbackFieldTemplate;
        }
        return 'detail';
    },

    _loadTemplate: function () {
        this._super('_loadTemplate');

        if ((this.view.name === 'record' || this.view.name === 'create'
            || this.view.name === 'create-nodupecheck' || this.view.name === 'pmse-case')
            && this.type === 'fieldset' && !_.contains(this.fallbackActions, this.action)) {

            this.template = app.template.getField('fieldset', 'record-detail', this.model.module);
        }
    },
    showNoData: function () {

        if (!this.def.readonly) {
            return false;
        }

        return !_.some(this.fields, function (field) {
            return field.name && field.model.has(field.name);
        });
    },

    _render: function () {

        var fields = this._getChildFields();
        _.each(fields, function (field) {
            field.placeholder = field.getPlaceholder();
        }, this);

        this.focusIndex = 0;

        this._super('_render');

        this._renderFields(fields);
        //Add by Tuan Anh
        //Add icon show map to detail view
        if (this.action === "detail" && fields.length != 0) {
            if (fields[0]["def"]["css_class"] === "address_street") {
                if (fields[0].value !== null) {
                    var checkExistDateModified = setInterval(function () {

                        if ($("div[data-name='date_entered'] span div").prop("title")) {

                            if (fields[0].$el != null) {

                                if (fields[0].$el.find("div").length != 0) {
                                    valuePara = "'" + fields[0].$el.find("div").prop("title") + "'";
                                    outHTML =
                                        '<span class="" style="position: absolute;" tabindex="-1">\n' +
                                        '<a class="customIcon" onclick="gmaps.displayMap(' + valuePara + ')">' +
                                        '<i style="cursor: pointer;font-size:20px; color: #193059; transition: all .2s ease-in-out;" class="customIcon far fa-map-marked-alt"></i>' +
                                        '</a>\n' +
                                        '</span>';
                                    fields[fields.length - 1].$el.parent().append(outHTML);
                                }
                            }
                            clearInterval(checkExistDateModified);
                        }

                    }, 100);

                }
            }
        }
        //Init gg map search fields
        if (this["action"] === "edit" && fields.length != 0) {

            if (fields[0]["def"]["css_class"] === "address_street") {

                var checkExist = setInterval(function () {
                    if ($(':input[name="' + fields[3]['name'] + '"]').length) {
                        gmaps.initAutocomplete($('input[name="' + fields[0]['name'] + '"]'), {
                            city: $(':input[name="' + fields[3]['name'] + '"]'),
                            state: $(':input[name="' + fields[2]['name'] + '"]'),
                            ward: $(':input[name="' + fields[1]['name'] + '"]'),
                            country: $(':input[name="' + fields[4]['name'] + '"]'),
                            latitude: $(':input[name="' + fields[5]['name'] + '"]'),
                            longitude: $(':input[name="' + fields[6]['name'] + '"]'),
                        });
                        clearInterval(checkExist);
                    }
                }, 100);
            }
        }
        //End
        return this;
    },
    _renderFields: function (fields) {
        var fieldElems = {};

        this.$('span[sfuuid]').each(function () {
            var $this = $(this);
            var sfId = $this.attr('sfuuid');
            fieldElems[sfId] = $this;
        });

        _.each(fields, function (field) {

            field.setElement(fieldElems[field.sfId]);
            field.render();


        }, this);
    },
    _getChildFieldsMeta: function () {

        return app.utils.deepCopy(this.def.fields);
    },

    _getChildFields: function () {
        if (!_.isEmpty(this.fields)) {
            return this.fields;
        }

        var metaFields = this._getChildFieldsMeta();
        if (metaFields) {
            _.each(metaFields, function (fieldDef) {
                //Begin Added by Tuan Anh
                //change type of address street to text

                if (fieldDef.css_class === "address_street") {
                    fieldDef.type = "text";
                }
                var field = app.view.createField({
                    def: fieldDef,
                    view: this.view,
                    nested: true,
                    viewName: this.options.viewName,
                    model: this.model
                });
                this.fields.push(field);
                field.parent = this;

                //End
            }, this);
        }
        return this.fields;
    },
    clearErrorDecoration: function () {
        _.each(this.fields, function (field) {
            field.clearErrorDecoration();
        });

        this._super('clearErrorDecoration');
    },
    focus: function () {
        // this should be zero but lets make sure
        if (this.focusIndex < 0 || !this.focusIndex) {
            this.focusIndex = 0;
        }

        if (this.focusIndex >= this.fields.length) {
            // done focusing our inputs return false
            this.focusIndex = -1;
            return false;
        } else {
            // this field is disabled skip ahead
            if (this.fields[this.focusIndex] && this.fields[this.focusIndex].isDisabled()) {
                this.focusIndex++;
                return this.focus();
            }
            // if the next field returns true its not done focusing so don't
            // increment to the next field
            if (_.isFunction(this.fields[this.focusIndex].focus) && this.fields[this.focusIndex].focus()) {
            } else {
                var field = this.fields[this.focusIndex];
                var $el = field.$(field.fieldTag + ':first');
                $el.focus().val($el.val());
                this.focusIndex++;
            }
            return true;
        }
    },
    _resetAction: function () {
        this._super('_resetAction');
        _.each(this.fields, function (field) {
            field._resetAction();
        });
    },
    setDisabled: function (disable) {
        disable = _.isUndefined(disable) ? true : disable;
        this._super('setDisabled', [disable]);
        _.each(this.fields, function (field) {
            field.setDisabled(disable);
        }, this);
    },
    setViewName: function (view) {
        this._super('setViewName', [view]);
        _.each(this.fields, function (field) {
            field.setViewName(view);
        }, this);
    },
    setMode: function (name) {
        this.focusIndex = 0;

        //Set the mode on child fields without rendering
        _.each(this.fields, function (field) {
            var oldAction = field._previousAction || field.action;
            field._removeViewClass(oldAction);
            if (field.isDisabled()) {
                field._previousAction = name;
            } else {
                field.action = name;
            }
        });

        this._super('setMode', [name]);
    },
    bindDomChange: function () {
    },
    bindDataChange: function () {

        var removeNoData = _.debounce(function () {
            if (this.disposed) {
                return;
            }

            if (this.action === 'nodata') {
                this.setMode('detail');
            }
        }, 100);

        _.each(this._getChildFields(), function (field) {
            this.model.on('change:' + field.name, removeNoData, this);
        }, this);
    },
    unbindDom: function () {
    },
    _dispose: function () {
        _.each(this.fields, function (field) {
            field.parent = null;
            field.dispose();
        });
        this.fields = null;
        app.view.Field.prototype._dispose.call(this);
    }
})
