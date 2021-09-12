({
    extendsFrom: "EnumField",

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'enum';
    },

    /**
     * @inheritdoc
     */
    loadEnumOptions: function (fetch, callback) {
        var request;
        var _key = 'request:' + this.module + ':' + this.name;

        if (fetch || !this.items) {
            this.isFetchingOptions = true;

            if (this.context.get(_key)) {
                request = this.context.get(_key);
                request.xhr.done(_.bind(function(o) {
                    callback.call(this);
                }, this));
            } else if (!_.isEmpty(this.model.get("dri_workflow_template_id"))) {
                request = app.api.relationships('read', 'DRI_Workflow_Templates', {
                    id: this.model.get("dri_workflow_template_id"),
                    link: "dri_workflow_task_templates"
                }, {
                    max_num: 1000 // make sure to fetch all activities
                }, {
                    success: _.bind(function (response) {
                        if (this.disposed) {
                            return;
                        }

                        this.items = {};

                        function label(activity) {
                            return activity.stage_template_label + " - " + activity.sort_order + ". " + activity.name;
                        }

                        var records = _.sortBy(response.records, function (activity) {
                            return label(activity);
                        });

                        _.each(records, function (activity) {
                            if (this.model.id !== activity.id) {
                                this.items[activity.id] = label(activity);
                            }
                        }, this);

                        this.context.unset(_key);
                        callback.call(this);
                    }, this)
                });

                this.context.set(_key, request);
            }
        }
    }
})
