
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
        'click [name="add_loyalty"]': 'addLoyalty',
        'click [name="create_sitedeployment"]': 'createSitedeployment',
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

    createSitedeployment:function (evt) {
        var model =this.context.get('parentModel');
        var seft = this;
        this.model.setDefault({
            'quotes_c_sitedeployment_1quotes_ida': model.get('id'),
            'quotes_c_sitedeployment_1_name': model.get('name'),
            'parent_id': model.get('parent_id'),
            'parent_name': model.get('parent_name'),
        });
        this.model.attributes.quotes_c_sitedeployment_1quotes_ida = model.get('id');
        app.drawer.open({
            layout: 'create',
            context: {
                create: true,
                module: this.module,
                model: this.model
            }
        },function () {
            seft.context.parent.trigger('subpanel:reload', {links: ['quotes_c_sitedeployment_1','c_sitedeployment']});
        });
    }
})
