
/**
 * Header section for Subpanel layouts.
 *
 * @class View.Views.Base.PanelTopView
 * @alias DOTB.App.view.views.BasePanelTopView
 * @extends View.View
 */
({
    /**
     * @inheritdoc
     */
    className: 'subpanel-header',

    /**
     * @inheritdoc
     */
    attributes: {
        'data-sortable-subpanel': 'true'
    },

    /**
     * @inheritdoc
     */
    events: {
        'click': 'togglePanel',
        'click a[name=create_button]:not(".disabled")': 'createRelatedClicked',
        'keydown [data-a11y=toggle]': '_handleKeyClick',
        // Added by HP to create/select PT/Demo Schedule in Leads/Student
        'click [name="create_demo_schedule"]': 'createDemoSchedule',
        'click [name="create_pt_schedule"]': 'createPTSchedule',
        'click [name="select_demo_schedule"]': 'selectDemoSchedule',
        'click [name="select_pt_schedule"]': 'selectPTSchedule',

        // Added by HP to create payment/enrollment
        'click [name="student_create_payment"]': 'studentCreatePayment',
        'click [name="student_create_enrollment"]': 'studentCreateEnrollment',
        'click [name="lead_create_payment"]': 'leadCreatePayment',

        // Added by HP to add demo to class
        'click [name="add_demo_to_class"]': 'addDemoToClass',
        'click [name="add_balance_to_site"]': 'addBalance',
    },

    plugins: ['LinkedModel'],

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        // FIXME: SC-3594 will address having child views extending metadata
        // from its parent.
        options.meta = _.extend(
            {},
            app.metadata.getView(null, 'panel-top'),
            app.metadata.getView(options.module, 'panel-top'),
            options.meta
        );
        //Tuan Anh prevent css custom
        if(typeof options.meta.buttons != 'undefined' && options.meta.buttons.length > 0){
            options.meta.buttons[0]['notCustomButton'] = true;
        }
        //End
        this._super('initialize', [options]);

        // This is in place to get the lang strings from the right module. See
        // if there is a better way to do this later.
        this.parentModule = this.context.parent.get('module');

        // Listen to the context for collapsed attribute to change
        // and toggle the aria-expanded attribute on the button element
        this.listenTo(this.context, 'change:collapsed', this._toggleAria);

        // FIXME: Revisit with SC-4775.
        this.on('linked-model:create', function() {
            this.context.set('skipFetch', false);
            this.context.reloadData();
        }, this);
    },

    /**
     * Event handler for the create button.
     *
     * @param {Event} event The click event.
     */
    createRelatedClicked: function(event) {
        this.createRelatedRecord(this.module);
    },

    /**
    * Event handler that toggles the subpanel layout when the SubpanelHeader is
    * clicked.
    *
    * Triggers the `panel:toggle` event to toggle the subpanel.
    *
    * @param {Event} The `click` event.
    */
    togglePanel: function(evt) {
        if (_.isNull(this.$el)) {
            return;
        }

        var $target = this.$(evt.target),
            isLink = $target.closest('a, button').length;

        if (isLink) {
            return;
        }

        this.context.set('collapsed', !this.context.get('collapsed'));
    },

    /**
     * Sets the subpanel header accessibility class 'aria-expanded' to true or false
     * depending on if the subpanel is open or closed.
     *
     * @private
     */
    _toggleAria: function(context, collapsed) {
        this.$('[data-a11y=toggle]')
            .attr('aria-expanded', !collapsed);
    },

    /**
     * Triggers the click event when the data-a11y toggle element has focus
     * and the spacebar or enter keydown event occurs
     *
     * @private
     */
    _handleKeyClick: function(evt) {
        app.accessibility.handleKeyClick(evt, this.$el);
    },

    addBalance:function (evt) {
        var seft = this;
        app.drawer.open({
                layout: 'multi-selection-list',
                context: {
                    module: 'J_Payment',
                    isMultiSelect: true,
                    parent_id:this.context.parent.get('model').get('parent_id'),
                }
            },
            function (data) {
                if (data != null) {
                    app.api.call("create", App.api.buildURL('add/balanceToSite'), {balance:data,site_id:seft.context.parent.get('model').get('id')}, {
                        success: function (data) {
                            if(data.success == 1) {
                                app.router.refresh();
                            }
                        },
                        error: function (data) {
                            app.alert.dismiss('process-id');
                        }
                    });
                }
            })

    }
})
