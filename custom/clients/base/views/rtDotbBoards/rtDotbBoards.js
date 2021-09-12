({
    className: 'rtDotbBoards',
    plugins: ['Pagination', 'RelativeTime'],
    events: {
        'click .rtSbPreviewButton': 'recordPreview',
        'click .rtSbActivityButton': 'createActivity',
        'click .edit-drawer': 'editDrawer',
        'sortreceive .rtDotbBoardColumn': 'changeValueOnDrop',
        'sortreceive .successButton': 'changeValueOnDrop',
        'sortreceive .failureButton': 'changeValueOnDrop',
        'click .rtSbFavouriteButton': 'toggleFavourite',

    },
    kbRecords: {},
    groupingsList: {},
    u_ids: [],
    initialize: function (options) {
        if (app.user.get('type') == 'admin') {
            this.isAdmin = true;
        }
        this._super('initialize', [options]);

        this.opt = options;
        this.u_ids = [];
        this.readMeta();
        this.validate;
        this.displayBoard = true;
        this.enableColumnSummary;
        this.columnSummaryField;
        this.currencySymbol = app.currency.getCurrencySymbol(app.currency.getBaseCurrencyId());
        this.groupingsList[this.module] = new Array();
        this.tabStateKey = app.user.lastState.buildKey('last-tab', 'rtDotbBoards', this.module);
        //Checks if last stored state exists in meta
        if (_.invert(this.viewMeta.groupBy)[app.user.lastState.get(this.tabStateKey)]) {
            this.currentGroupField = app.user.lastState.get(this.tabStateKey) || this.currentGroupField;
        }
        this.changeGroupingAndRender(this.currentGroupField);
        this.verifyLicense();
    },

    verifyLicense: function () {

        var verifyURL = app.api.buildURL('rtDotbBoards/verify/', null, null, {
            oauth_token: app.api.getOAuthToken()
        });
        app.api.call('GET', verifyURL, null, {
            success: _.bind(function (result) {
                    this.validate = result;
                    var rtSbSettings = this.layout.getComponent('rtSbSettings');
                    rtSbSettings.validationCompleted();
                    this.render();
                },
                this),
            error: _.bind(function (e) {
                console.error(e);
            }, this)
        });
    },


    /**
     * Read meta of the data to be shown on the columns and cards of the view
     */
    readMeta: function () {
        this.viewMeta = app.metadata.getView(this.module, 'rtDotbBoards');
        //Updating Context: This makes sure that fields we require for the view are fetched in this.collection
        var self = this;

        //Checking ACL for TitleField
        if (this.viewMeta.titleField == 'full_name') {
            if (!App.acl.hasAccess('view', self.module, {
                field: 'first_name',
                recordAcls: App.user.getAcls()[self.module]
            })) {
                this.firstNameAllowed = true;
            } else {
                this.firstNameAllowed = false;
            }
        } else {
            if (!App.acl.hasAccess('view', self.module, {
                field: this.viewMeta.titleField,
                recordAcls: App.user.getAcls()[self.module]
            })) {
                this.viewMeta.titleField = undefined;
            }
        }
        //Checking ACL for assigned user
        if (App.acl.hasAccess('view', self.module, {
            field: 'assigned_user_name',
            recordAcls: App.user.getAcls()[self.module]
        })) {
            this.asgUserAllowed = true;
        } else {
            this.asgUserAllowed = false;
        }

        //Checking ACL for modified user
        if (App.acl.hasAccess('view', self.module, {
            field: 'modified_by_name',
            recordAcls: App.user.getAcls()[self.module]
        })) {
            this.modUserAllowed = true;
        } else {
            this.modUserAllowed = false;
        }

        //Checking ACL for modified user
        if (App.acl.hasAccess('view', self.module, {
            field: 'my_favorite',
            recordAcls: App.user.getAcls()[self.module]
        })) {
            this.favAllowed = true;
        } else {
            this.favAllowed = false;
        }

        //Checking ACL for editAccess
        if (App.acl.hasAccess('edit', self.module)) {
            this.editAllowed = true;
        } else {
            this.editAllowed = false;
        }


        //Checking ACL for Color Labels
        if (!App.acl.hasAccess('view', self.module, {
            field: this.viewMeta.colorLabelField.field,
            recordAcls: App.user.getAcls()[self.module]
        })) {
            this.viewMeta.colorLabelField = new Array();
        }


        //Checking ACL for BasicFields
        var basicAccessList = _.flatten(_.pluck(this.viewMeta.basicFields, 'name'));
        basicAccessList = _.filter(basicAccessList, function (fie) {
            return App.acl.hasAccess('view', self.module, {
                field: fie,
                recordAcls: App.user.getAcls()[self.module]
            })
        });
        this.viewMeta.basicFields = _.filter(this.viewMeta.basicFields, function (arr) {
            if (_.isArray(arr.name)) {
                var tF = true;
                _.each(arr.name, function (fld) {
                    tF = tF && _.contains(basicAccessList, fld);
                })
                return tF;
            } else {
                return _.contains(basicAccessList, arr.name)
            }
        });

        //Checking ACL for SecondaryFields
        this.viewMeta.secondaryFields = _.filter(this.viewMeta.secondaryFields, function (fie) {
            return App.acl.hasAccess('view', self.module, {
                field: fie,
                recordAcls: App.user.getAcls()[self.module]
            })
        });

        this.context.attributes.fields = _.union(
            _.without(
                this.viewMeta.groupBy.concat(
                    _.pluck(this.viewMeta.basicFields, 'name')).concat(
                    this.viewMeta.secondaryFields).concat(
                    this.viewMeta.colorLabelField.field).concat(
                    ['modified_by_name', 'modified_user_id', 'favorite_link']), undefined), this.context.attributes.fields);

        if (this.viewMeta.columnSummary) {
            if (this.viewMeta.columnSummary.field) {
                this.enableColumnSummary = 'true';
                this.context.attributes.fields = this.context.attributes.fields.concat([this.viewMeta.columnSummary.field]);
            }
        }

        if (this.viewMeta.colorLabelField) {
            if (this.viewMeta.colorLabelField.field) {
                this.metaColorLabelField = this.viewMeta.colorLabelField.field;
            }
            if (this.viewMeta.colorLabelField.colorList) {
                this.metaColorLabelList = app.lang.getAppListStrings(this.viewMeta.colorLabelField.colorList);
            }
        }
        this.metaTitle = this.viewMeta.titleField;
        this.metaBasicFields = this.viewMeta.basicFields;
        this.metaSecondaryFields = this.viewMeta.secondaryFields;
        this.metaActivityButtons = this.viewMeta.activityButtons;
        this.metaActivityButtons = new Array();
        _.each(this.viewMeta.activityButtons, function (arr) {
            if (App.acl.hasAccess('create', arr.name)) {
                this.metaActivityButtons.push(arr);
            }
        }, this);

        var thisVar = this;
        this.currentGroupField = this.viewMeta.groupBy[0];
        this.getUsersMeta();
    },

    /**
     * Read meta of the view and define list containing values for group by column
     */
    makeGroupingsList: function (groupName) {
        var thisVar = this;
        if (groupName == 'assigned_user_name') {
            this.assignedUserIds = new Array();
            var reqCollection = app.data.createBeanCollection('Employees');
            reqCollection.fetch({
                fields: ['name'],
                success: _.bind(function (data) {
                    if (reqCollection.models.length > 0) {
                        thisVar.groupingsList[thisVar.module][groupName] = new Array();
                        var userList = _.pluck(_.pluck(reqCollection.models, 'attributes'), 'name');
                        thisVar.groupingsList[thisVar.module][groupName] = _.object(userList, userList);
                        thisVar.assignedUserIds = _.object(userList, _.pluck(_.pluck(reqCollection.models, 'attributes'), 'id'));
                        thisVar.loadData();
                    }
                })
            });
        } else if (groupName) {
            var modMeta = app.metadata.getModule(this.module);
            this.groupingsList[this.module][groupName] = new Array();
            this.groupingsList[this.module][groupName] = app.lang.getAppListStrings(modMeta.fields[groupName].options);
            delete this.groupingsList[this.module][groupName][""];
            this.loadData();
        }
    },

    changeGroupingAndRender: function (groupName) {

        this.currentGroupField = groupName;
        if (!this.groupingsList[this.module][this.currentGroupField]) {
            this.makeGroupingsList(groupName);
        } else {
            this.loadData();
        }
    },

    /**
     * Opens a detail preview of a record in the sidepanel on event 'click .kbButton'
     */
    recordPreview: function (event) {
        app.events.trigger("preview:render", this.kbRecords[event.currentTarget.dataset.status][event.currentTarget.dataset.index], this.collection, true);
    },

    /**
     * Opens a create activity form in drawer with linked record pre-populated
     */
    createActivity: function (event) {
        var activityMod = event.currentTarget.dataset.activity;
        var prefill = app.data.createBean(activityMod);
        var currModel = this.kbRecords[event.currentTarget.dataset.status][event.currentTarget.dataset.index].attributes;
        var displayName = '';
        if (this.metaTitle == 'full_name') {
            displayName = currModel.first_name + ' ' + currModel.last_name;
        } else if (this.metaTitle == 'name') {
            displayName = currModel.name
        }
        activityAttributes = {
            'parent_type': currModel._module,
            'parent_id': currModel.id,
            'parent_name': displayName,
        };
        let layout = 'create';
        if (activityMod === 'Emails') {
            layout = 'compose';
        }
        prefill.set(activityAttributes);
        app.drawer.open({
            layout: layout,
            context: {
                forceNew: true,
                create: true,
                model: prefill,
                module: activityMod,
            }
        });

    },


    /**
     * Sets the vaule of the field to column id on card drop to an another column on the board
     */
    changeValueOnDrop: function (event, ui) {
        this.changeColumnSummary(event, ui);

        //Lead Conversion
        if (this.module == "Leads" & event.currentTarget.id == "Converted") {
            var model = app.data.createBean("Leads");
            model.set(app.utils.deepCopy(this.kbRecords[ui.item[0].dataset.status][ui.item[0].dataset.index].attributes));
            app.drawer.open({
                layout: 'convert',
                context: {
                    forceNew: true,
                    skipFetch: true,
                    module: this.model.module,
                    leadsModel: model
                }
            });
        } else {

            var bean = app.data.createBean(this.collection.models[0].attributes._module, {
                id: ui.item[0].id
            });
            bean.fetch({
                error: _.bind(function (err) {
                    console.error(err);
                }, this),
                success: _.bind(function (model) {
                    if (this.currentGroupField == 'assigned_user_name') {
                        model.set('assigned_user_id', this.assignedUserIds[event.currentTarget.id]);
                    } else {
                        model.set(this.currentGroupField, _.invert(this.groupingsList[this.module][this.currentGroupField])[event.currentTarget.id]);
                    }
                    app.alert.show('rtDotbBoards', {
                        level: 'process',
                        title: app.lang.get('LBL_SB_UPDATING')
                    });
                    model.save().xhr.success(_.bind(function (data) {
                        app.alert.show('rtDotbBoards', {
                            autoClose: true,
                            level: 'success',
                            messages: this.buildSuccessMessage(data, true),
                            onLinkClick: function () {
                                app.alert.dismiss('rtDotbBoards');
                            }
                        });
                    }, this)).error(function (e) {
                        app.alert.show('rtDotbBoards', {
                            level: 'error',
                            title: app.lang.get('LBL_SB_DRAGANDDROPERROR'),
                            messages: e.responseJSON.error_message,
                        });
                        console.error('Kanban Error: ', e);
                    });
                }, this)
            });
        }
    },

    /**
     * This method is like the create.js buildSuccessMessage and it has been customized to show Kanban custom labels.
     *
     * @method {buildSuccessMessage}
     * @param {Object} model
     * @param {Boolean} attrs
     * @return {String}
     */
    buildSuccessMessage: function (model, attrs) {
        var modelAttributes,
            successLabel = 'LBL_SB_UPDATED',
            successMessageContext;

        //if we have model attributes, use them to build the message, otherwise use a generic message
        if (model && attrs) {
            modelAttributes = model;
        } else {
            modelAttributes = {};
            successLabel = 'LBL_SB_RECORD_UPDATED';
        }

        //use the model attributes combined with data from the view to build the success message context
        successMessageContext = _.extend({
            module: this.module,
            moduleSingularLower: app.lang.getModuleName(this.module).toLowerCase()
        }, modelAttributes);

        return app.lang.get(successLabel, '', successMessageContext);
    },

    /**
     * Changes column(s) summary when the card is dragged and dropped to another column
     */
    changeColumnSummary: function (event, ui) {
        if (this.enableColumnSummary) {
            var oldColVal = parseInt($("[id='" + ui.sender[0].id + "'] .columnSummary .value").text().replace(/,/g, ''), 10);
            var newColVal = parseInt($("[id='" + event.currentTarget.id + "'] .columnSummary .value").text().replace(/,/g, ''), 10);

            var cardValue = parseInt(ui.item["0"].attributes["data-columnsummaryfield"].nodeValue || 0, 10);

            this.changeValueAnimation("[id='" + ui.sender[0].id + "'] .columnSummary .value", oldColVal, oldColVal - cardValue);
            if (event.currentTarget.className !== "successButton ui-sortable" && event.currentTarget.className !== "failureButton ui-sortable") {
                this.changeValueAnimation("[id='" + event.currentTarget.id + "'] .columnSummary .value", newColVal, newColVal + cardValue);
            }
        }
    },

    /**
     * Defines column summary for each column before rendering
     */
    defineColumnSummary: function () {
        var colSummary = {};
        var kbRecords = this.kbRecords;
        if (this.enableColumnSummary) {

            var field = this.viewMeta.columnSummary.field;
            $.each(kbRecords, function (index, value) {
                colSummary[index] = Math.round(_.reduce(_.without(_.pluck(_.pluck(value, 'attributes'), field), ""), function (memo, num) {
                    return memo + parseFloat(num);
                }, 0)).toLocaleString() || 0;
            });
            this.columnSummary = colSummary;
            this.columnSummaryField = this.viewMeta.columnSummary.field;
            this.showCurrency = this.viewMeta.columnSummary.currency;
            this.colSumLabel = app.lang.get(app.metadata.getModule(this.module).fields[this.columnSummaryField].vname, this.module);

        }
    },

    /**
     * Animates the value change of column summary
     */
    changeValueAnimation: function (selector, oldVal, newVal) {
        $({
            someValue: oldVal
        }).animate({
            someValue: newVal
        }, {
            duration: 500,
            easing: 'swing',
            step: function () { // called on every step
                // Update the element's text with rounded-up value:
                $(selector).text((Math.round(this.someValue)).toLocaleString());
            },
            complete: function () {
                $(selector).text(newVal.toLocaleString());
            }
        });


    },

    /**
     *  This functions re-renders the page when collections is reset or updated on filtering
     **/
    bindDataChange: function () {
        if (this.collection) {
            this.collection.on("reset", this.loadData, this);
            this.collection.on("update", this.loadData, this);
        }
    },

    /**
     * Sort models of the current module by columns
     */
    loadData: function (options) {
        var kanbanRecords = {};
        var thisVar = this;
        var gList = this.groupingsList[this.module][this.currentGroupField];
        if (gList) {
            $.each(gList, function (index, value) {
                kanbanRecords[value] = new Array();
            });

            var unassignedLabel = app.lang.getAppString('LBL_RT_UNASSIGNED');
            $.each(this.collection.models, function (key, record) {
                if (record.attributes[thisVar.currentGroupField] && _.isArray(kanbanRecords[gList[record.attributes[thisVar.currentGroupField]]])) {
                    kanbanRecords[gList[record.attributes[thisVar.currentGroupField]]].push(record);
                } else if (kanbanRecords[unassignedLabel]) {
                    kanbanRecords[unassignedLabel].push(record);
                } else {
                    var temp = {};
                    temp[unassignedLabel] = new Array();
                    temp[unassignedLabel].push(record);
                    kanbanRecords = jQuery.extend(temp, kanbanRecords);
                }
            });
        }
        this.kbRecords = this.configSuccessFailureStages(kanbanRecords);
        this.defineColumnSummary();
        this.render();
    },


    /**
     * Defines Success/Failure Drop areas where configured
     */
    configSuccessFailureStages: function (kanbanRecords) {
        var gList = this.groupingsList[this.module][this.currentGroupField];

        if (this.viewMeta.successFailureStage) {
            if (this.viewMeta.successFailureStage[this.currentGroupField] && _.findKey(gList, this.viewMeta.successFailureStage[this.currentGroupField]['success']) !== -1 && _.findKey(gList, this.viewMeta.successFailureStage[this.currentGroupField]['failure']) !== -1) {
                delete kanbanRecords[gList[this.viewMeta.successFailureStage[this.currentGroupField]['success']]];
                delete kanbanRecords[gList[this.viewMeta.successFailureStage[this.currentGroupField]['failure']]];

                this.successColumn = gList[this.viewMeta.successFailureStage[this.currentGroupField]['success']];
                this.failureColumn = gList[this.viewMeta.successFailureStage[this.currentGroupField]['failure']];

                var tab = app.lang.get(app.metadata.getModule(this.module, 'fields')[this.currentGroupField].vname, this.module);
                var reqCollection = app.data.createBeanCollection('RT_DotbBoards');
                var thisVar = this;
                reqCollection.fetch({
                    fields: ['boardModule', 'groupBy', 'successStage', 'failureStage'],
                    success: _.bind(function (data) {
                        var collAtts = _.pluck(reqCollection.models, "attributes");
                        var rec = _.findWhere(collAtts, {
                            boardModule: thisVar.module,
                            groupBy: thisVar.currentGroupField
                        });
                        if (rec) {
                            if (rec.successStage) {
                                thisVar.successColumn = rec.successStage;
                            }
                            if (rec.failureStage) {
                                thisVar.failureColumn = rec.failureStage;
                            }
                        }
                        thisVar.render();
                    })
                })


                return kanbanRecords;
            }
        }
        return kanbanRecords;
    },

    /**
     * Renders view with script
     */
    render: function () {

        if ($('button.btn.active[data-view="rtDotbBoards"]').length > 0) {
            if (!this.toggledUp && $('button.sidebar-toggle i.fa.fa-angle-double-right').length > 0) {
                $('button.sidebar-toggle').click();
                this.toggledUp = true;
            }
        } else {
            this.toggledUp = false;
            return;
        }
        this._super('render');

        if (this.displayBoard) {
            $(".rtDotbBoard").show();
        } else {
            $(".rtDotbBoard").hide();
        }


        $(".rtDotbBoardColumn").sortable({
            items: "> .rtDotbBoardCard",
            connectWith: ".rtDotbBoardColumn",
        }).disableSelection();

        if (this.viewMeta.successFailureStage) {
            if (this.viewMeta.successFailureStage[this.currentGroupField] && _.findKey(this.groupingsList[this.module][this.currentGroupField], this.viewMeta.successFailureStage[this.currentGroupField]['success']) !== -1 && _.findKey(this.groupingsList[this.module][this.currentGroupField], this.viewMeta.successFailureStage[this.currentGroupField]['failure']) !== -1) {
                $(".rtDotbBoardColumn, .successButton, .failureButton").sortable({
                    items: "> .rtDotbBoardCard",
                    connectWith: ".rtDotbBoardColumn, .successButton, .failureButton",
                }).disableSelection();

                $(".successButton, .failureButton").on("sortover", function (event, ui) {
                    $("[id='" + event.target.id + "']").addClass("dashedLine");
                    $("[id='" + event.target.id + "']").addClass("dashedLine");
                });

                $(".successButton, .failureButton").on("sortout", function (event, ui) {
                    $(".successButton, .failureButton").removeClass("dashedLine");
                    $(".successButton, .failureButton").removeClass("dashedLine");
                });

                $(".rtDotbBoardColumn").on("sortactivate", function (event, ui) {
                    $(".successButton").show();
                    $(".failureButton").show();
                });

                $(".rtDotbBoardColumn").on("sortdeactivate", function (event, ui) {
                    $(".successButton").hide();
                    $(".failureButton").hide();
                });
            }
        }

        $(".rtDotbBoardCard").click(function (event) {
            /* Ignore the font awesome icons and anchor tag clicks */
            if (event.target.className.search("fa-") == -1 && event.target.nodeName !== 'A' && event.target.nodeName !== 'IMG') {
                $('.secondaryDivrtDotbBoard:has( > .record-cell)').toggle('slow', function () {
                });
            }
        });

        $(".colorLabel").mouseover(function () {
            $(this).addClass("popLabel");
            $(this).children().first().show();
        });

        $(".colorLabel").mouseout(function () {
            $(this).removeClass("popLabel");
            $(this).children().first().hide();
        });

        this.adjustContentHeight();
        var that = this;
        $(window).resize(function () {
            that.adjustContentHeight();
        })
    },

    /**
     * This eventHandler is registered with the Edit button in the Card.
     *
     * It will retain the selected card's attributes w.r.t. the board, and open up a drawer for editing the model.
     * @param event
     * @return Void
     */
    editDrawer: function (event) {
        let model = this.kbRecords[event.currentTarget.dataset.status][event.currentTarget.dataset.index].attributes;
        var bean = app.data.createBean(model._module);
        bean.set(model);
        app.drawer.open({
            layout: 'create',
            context: {
                create: true,
                model: bean,
                module: model._module,
            }
        });
    },

    /**
     * This method will adjust the height of the DotbBoards content and make it scrollable.
     *
     * @method {adjustContentHeight}
     * @private
     */
    adjustContentHeight: function () {
        var sMainEl = $('.main-pane').height();
        var sFilterEl = $(".search-filter").height();
        var sGridHeight = sMainEl - sFilterEl;
        $('.rtDotbBoards').parents('.main-content').css('height', sGridHeight + 'px');
        $('.rtDotbBoards').parents('.main-content').css('overflow', 'auto');
        $('.rtDotbBoards').parents('.main-pane').css('overflow', 'hidden');
    },

    /**
     * Toggles and save favourite icon on card on click
     * @method {toggleFavourite}
     * @private
     */

    toggleFavourite: function (event, ui) {

        $(event.currentTarget).children('i').toggleClass("fa-favorite fa-star");

        this.kbRecords[event.currentTarget.dataset.status][event.currentTarget.dataset.index];

        if ($(event.currentTarget).children('i').hasClass("fa-star")) {
            app.api.favorite(this.collection.models[0].attributes._module, event.currentTarget.offsetParent.id, 'favorite', null, null);
        } else {
            app.api.favorite(this.collection.models[0].attributes._module, event.currentTarget.offsetParent.id, null, null, null);
        }
    },

    /**
     * This method will fetch the users' with profile images uploaded.
     *
     * @method {getUsersMeta}
     * @param {Integer} offset
     * @return {Void}
     */
    getUsersMeta: function (offset) {
        let queryParams = 'fields=id&filter[0][picture][$not_null]&max_num=50';
        if (offset) {
            queryParams += '&offset=' + offset;
        }
        app.api.call('GET', App.api.buildURL('Users?' + queryParams), null, {
            error: _.bind(function (err) {
                console.error(err);
            }, this),
            success: _.bind(function (_collection) {
                if (_collection.records && _collection.records.length > 0) {
                    _.forEach(_collection.records, function (user) {
                        this.u_ids.push(user.id);
                    }, this);
                    if (_collection.next_offset !== -1) {
                        this.getUsersMeta(_collection.next_offset);
                    }
                }
            }, this)
        });
    }

})