
/**
 * @class View.Fields.Base.Products.QuoteDataRelateField
 * @alias DOTB.App.view.fields.BaseProductsQuoteDataRelateField
 * @extends View.Fields.Base.BaseRelateField
 */
({
    extendsFrom: 'BaseRelateField',

    /**
     * The temporary "(New QLI}" string to add if users type in their own product name
     * @type {string}
     */
    createNewLabel: undefined,

    /**
     * The temporary ID to user for newly created QLI names
     * @type {string}
     */
    newQLIId: undefined,

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.createNewLabel = app.lang.get('LBL_CREATE_NEW_QLI_IN_DROPDOWN', 'Products');
        this.newQLIId = 'newQLIId';

        this._super('initialize', [options]);
    },

    /**
     * Overriding because getSearchModule needs to return Products for this metadata
     *
     * @inheritdoc
     */
    _getPopulateMetadata: function() {
        return app.metadata.getModule('Products');
    },

    /**
     * Overridden select2 change handler for the custom case of being able to add new unlinked Products
     * @param evt
     * @private
     */
    _onSelect2Change: function(evt) {
        var $select2 = $(evt.target).data('select2');
        var id = evt.val;
        var value = id ? $select2.selection.find('span').text() : $(evt.target).data('rname');
        var collection = $select2.context;
        var model;
        var attributes = {
            id: '',
            value: ''
        };

        if (value && value.indexOf(this.createNewLabel)) {
            // if value had new QLI label, remove it
            value = value.replace(this.createNewLabel, '');
        }

        value = value ? value.trim() : value;

        // default to given id/value or empty strings, cleans up logic significantly
        attributes.id = id || '';
        attributes.value = value || '';

        if (collection && id) {
            // if we have search results use that to set new values
            model = collection.get(id);
            if (model) {
                attributes.id = model.id;
                attributes.value = model.get('name');
                _.each(model.attributes, function(value, field) {
                    if (app.acl.hasAccessToModel('view', model, field)) {
                        attributes[field] = attributes[field] || model.get(field);
                    }
                });
            }
        } else if (evt.currentTarget.value && value) {
            // if we have previous values keep them
            attributes.id = value;
            attributes.value = evt.currentTarget.value;
        }

        // set the attribute values
        this.setValue(attributes);

        if (id === this.newQLIId) {
            // if this is a new QLI
            this.model.set({
                product_template_id: '',
                product_template_name: value,
                name: value
            });
            // update the select2 label
            this.$(this.fieldTag).select2('val', value);
        }

        return;
    },

    /**
     * Extending to add the custom createSearchChoice option
     *
     * @inheritdoc
     */
    _getSelect2Options: function() {
        return _.extend(this._super('_getSelect2Options'), {
            createSearchChoice: _.bind(this._createSearchChoice, this)
        });
    },

    /**
     * Extending to also check models' product_template_name/name and product_template_id/id
     *
     * @inheritdoc
     */
    format: function(value) {
        var idList;
        value = value || this.model.get(this.name) || this.model.get('name');

        this._super('format', [value]);

        // If value is not set (new row item) then the select2 will show the ID and we dont want that
        if (value) {
            idList = this.model.get(this.def.id_name) || this.model.get('id');
            if (_.isArray(value)) {
                this.formattedIds = idList.join(this._separator);
            } else {
                this.formattedIds = idList;
            }

            if (_.isEmpty(this.formattedIds)) {
                this.formattedIds = value;
            }
        }

        return value;
    },

    /**
     * Overriding if there's no product_template_id or name, use the Products module and record ID
     *
     * @inheritdoc
     */
    _buildRoute: function() {
        this.buildRoute(this.model.module, this.model.get('id'));
    },

    /**
     * Overriding as should default to the model's ID then if empty go to the link id
     *
     * @inheritdoc
     */
    _getRelateId: function() {
        return this.model.get(this.def.id_name) || this.model.get('id') ;
    },

    /**
     * Add a new search choice for the user's text
     *
     * @param {string} term The text the user is searching for
     * @return {{id: (*|string), text: *}}
     * @private
     */
    _createSearchChoice: function(term) {
        return {
            id: this.newQLIId,
            text: term + this.createNewLabel
        };
    },

    openSelectDrawer: function() {
        var layout = 'selection-list';
        var context = {
            module: this.getSearchModule(),
            fields: this.getSearchFields(),
            filterOptions: this.getFilterOptions()
        };

        if (!!this.def.isMultiSelect) {
            layout = 'multi-selection-list';
            _.extend(context, {
                preselectedModelIds: _.clone(this.model.get(this.def.id_name)),
                maxSelectedRecords: this._maxSelectedRecords,
                isMultiSelect: true
            });
        }
        app.drawer.open({
            layout: layout,
            context: context
        }, _.bind(this.setValue, this));
    },
    updateRelatedFields: function(model) {
        var newData = {},
            self = this;
        _.each(this.def.populate_list, function(target, source) {
            source = _.isNumber(source) ? target : source;
            if (!_.isUndefined(model[source]) && app.acl.hasAccessToModel('edit', this.model, target)) {
                var before = this.model.get(target),
                    after = model[source];

                if (before !== after) {
                    newData[target] = model[source];
                }
            }
        }, this);
        newData['unit'] = model['unit_name'];

        if (_.isEmpty(newData)) {
            return;
        }

        // if this.def.auto_populate is true set new data and doesn't show alert message
        if (!_.isUndefined(this.def.auto_populate) && this.def.auto_populate == true) {
            // if we have a currency_id, set it first to trigger the currency conversion before setting
            // the values to the model, this prevents double conversion from happening
            if (!_.isUndefined(newData.currency_id)) {
                this.model.set({currency_id: newData.currency_id});
                delete newData.currency_id;
            }
            this.model.set(newData);
            return;
        }

        // load template key for confirmation message from defs or use default
        var messageTplKey = this.def.populate_confirm_label || 'TPL_OVERWRITE_POPULATED_DATA_CONFIRM',
            messageTpl = Handlebars.compile(app.lang.get(messageTplKey, this.getSearchModule())),
            fieldMessageTpl = app.template.getField(
                this.type,
                'overwrite-confirmation',
                this.model.module),
            messages = [],
            relatedModuleSingular = app.lang.getModuleName(this.def.module);

        _.each(newData, function(value, field) {
            var before = this.model.get(field),
                after = value;

            if (before !== after) {
                var def = this.model.fields[field];
                messages.push(fieldMessageTpl({
                    before: before,
                    after: after,
                    field_label: app.lang.get(def.label || def.vname || field, this.module)
                }));
            }
        }, this);

        app.alert.show('overwrite_confirmation', {
            level: 'confirmation',
            messages: messageTpl({
                values: new Handlebars.SafeString(messages.join(', ')),
                moduleSingularLower: relatedModuleSingular.toLowerCase()
            }),
            onConfirm: function() {
                // if we have a currency_id, set it first to trigger the currency conversion before setting
                // the values to the model, this prevents double conversion from happening
                if (!_.isUndefined(newData.currency_id)) {
                    self.model.set({currency_id: newData.currency_id});
                    delete newData.currency_id;
                }
                self.model.set(newData);
            }
        });
    },
    setValue: async function(models) {
        if (!models) {
            return;
        }
        var main_model = this.model;
        var seft = this;
        await  app.api.call("create", App.api.buildURL('products/getProductLineItem'), {id:models.id}, {
            success: function (data) {
                if(seft.context != null)
                var context = seft.context.parent;
                if(data.length == 0) {
                    var isErased = false;
                    var updateRelatedFields = true,
                        values = {};
                    if (_.isArray(models)) {
                        // Does not make sense to update related fields if we selected
                        // multiple models
                        updateRelatedFields = false;
                    } else {
                        models = [models];
                    }

                    values[seft.def.id_name] = [];
                    values[seft.def.name] = [];
                    if (seft.fieldDefs.link) {
                        values[seft.fieldDefs.link] = [];
                    }

                    _.each(models, _.bind(function (model) {
                        values[seft.def.id_name].push(model.id);
                        //FIXME SC-4196 will fix the fallback to `formatNameLocale` for person type models.
                        values[seft.def.name].push(model[seft.getRelatedModuleField()] ||
                            app.utils.formatNameLocale(model) || model.value);
                        if (seft.fieldDefs.link) {
                            values[seft.fieldDefs.link].push(model);
                        } else {
                            isErased = app.utils.isNameErased(app.data.createBean(model._module, model));
                        }
                    }, seft));

                    // If it's not a multiselect relate, we get rid of the array.
                    if (!seft.def.isMultiSelect) {
                        values[seft.def.id_name] = values[seft.def.id_name][0];
                        values[seft.def.name] = values[seft.def.name][0];
                        if (seft.fieldDefs.link) {
                            values[seft.fieldDefs.link] = values[seft.fieldDefs.link][0];
                        } else {
                            seft._nameIsErased = isErased;
                        }
                    }

                    //In case of selecting an erased value twice, we need to force a re-render to show the erased placeolder.
                    var forceUpdate = _.isEmpty(seft.model.get(seft.def.name)) && _.isEmpty(values[seft.def.name]);

                    seft.model.set(values);

                    if (updateRelatedFields) {
                        //Force an update to the link field as well so that DotbLogic and other listeners can react
                        if (seft.fieldDefs.link && _.isEmpty(values[seft.fieldDefs.link]) && forceUpdate) {
                            seft.model.trigger('change:' + seft.fieldDefs.link);
                        }
                        seft.updateRelatedFields(models[0]);
                    }

                    if (forceUpdate) {
                        seft._updateField();
                    }
                }
                else{
                    var quoteModel = seft.options.view.context.get('parentModel');
                    data.forEach(function (product) {
                        var relatedModel = app.data.createRelatedBean(seft.options.view.model, null, 'products');
                        var maxPositionModel = _.max(seft.options.view.collection.models, function(model) {
                            return +model.get('position');
                        });

                        // get the position of the highest model's position and add one to it
                        var position = +maxPositionModel.get('position') + 1;
                        var modelData = _.extend({
                            _module:'Products',
                            _link: 'products',
                            position: position,
                            currency_id: quoteModel.get('currency_id'),
                            base_rate: quoteModel.get('base_rate'),
                            quote_id: quoteModel.get('id')
                        }, {});
                        relatedModel.attributes.code = product.code;
                        relatedModel.attributes.discount_amount = product.discount_amount;
                        relatedModel.attributes.discount_price = product.discount_price;
                        relatedModel.attributes.discount_select = product.discount_select;
                        relatedModel.attributes.quantity = product.quantity;
                        relatedModel.attributes.unit = product.unit;
                        relatedModel.setDefault({
                            'product_template_id': product.product_template_id,
                            'product_template_name': product.name,
                            'name':product.name,
                            'unit_id':product.unit_id,
                            'unit_name':product.unit
                        });
                        relatedModel.product_template_id = product.product_template_id;
                        relatedModel.product_template_name = product.name;
                        relatedModel.unit_id = product.unit_id;
                        relatedModel.unit_name = product.unit;
                        relatedModel.module = 'Products';
                        relatedModel.name = product.name;

                        // set a few items on the model
                        relatedModel.set(modelData);

                        // tell the currency field, not to set the default currency
                        relatedModel.ignoreUserPrefCurrency = true;

                        // this model's fields should be set to render
                        relatedModel.modelView = 'edit';
                        seft.options.view.toggledModels[relatedModel.cid] = relatedModel;
                        seft.options.view.collection.add(relatedModel);
                    })
                    seft.options.view.collection.remove(main_model);

                }
            },
            error: function (data) {
            }
        });
    },
});
