
/**
 * This View allows the user to provide Feedback about DotBCRM platform to a
 * GoogleDoc spreadsheet.
 *
 * The view can stay visible while the user is navigating and will use the
 * current URL when the user clicks submit. Other fields are mapped into the
 * spreadsheet and might become metadata driven in the future.
 *
 * @class View.Views.Base.Feedbacks.FeedbackView
 * @alias DOTB.App.view.views.BaseFeedbacksFeedbackView
 * @extends View.View
 */
({
    plugins: ['ErrorDecoration'],

    events: {
        'click [data-action=submit]': 'submit',
        'click [data-action=close]': 'close'
    },

    /**
     * @inheritdoc
     *
     * During initialize we listen to model validation and if it is valid we
     * {@link #send} the Feedback.
     */
    initialize: function(options) {
        options.model = app.data.createBean('Feedbacks');
        var fieldsMeta = _.flatten(_.pluck(options.meta.panels, 'fields'));
        options.model.fields = {};
        _.each(fieldsMeta, function(field) {
            options.model.fields[field.name] = field;
        });
        this._super('initialize', [options]);
        this.context.set('skipFetch', true);

        this.model.on('validation:start', function() {
            app.alert.dismiss('send_feedback');
        });

        this.model.on('error:validation', function() {
            app.alert.show('send_feedback', {
                level: 'error',
                messages: app.lang.get('LBL_FEEDBACK_SEND_ERROR', this.module)
            });
            this.$('[data-action=submit]').removeAttr('disabled');
        }, this);

        this.model.on('validation:success', this.send, this);

        // TODO Once the view renders the button, this is no longer needed
        this.button = $(options.button);

        /**
         * The internal state of this view.
         * By default this view is closed ({@link #toggle} will call render).
         *
         * FIXME TY-1798/TY-1800 This is needed due to the bad popover plugin.
         *
         * @type {boolean}
         * @private
         */
        this._isOpen = false;
        
        var learnMoreUrl = 'http://www.dotbcrm.com/crm/product_doc.php?' + $.param({
            edition: app.metadata.getServerInfo().flavor,
            version: app.metadata.getServerInfo().version,
            lang: app.lang.getLanguage(),
            module: this.module,
            route: 'list'
        });
        /**
         * Aside text with all the translated links and strings to easily show
         * it in the view.
         * @type {String}
         */
        this.aside = new Handlebars.SafeString(app.lang.get('TPL_FEEDBACK_ASIDE', this.module, {
            learnMoreLink: new Handlebars.SafeString('<a href="' + learnMoreUrl + '" target="_blank">' + Handlebars.Utils.escapeExpression(
                app.lang.get('LBL_FEEDBACK_ASIDE_CLICK_MORE', this.module)
            ) + '</a>'),
            contactSupportLink: new Handlebars.SafeString('<a href="http://support.dotbcrm.com" target="_blank">' + Handlebars.Utils.escapeExpression(
                app.lang.get('LBL_FEEDBACK_ASIDE_CONTACT_SUPPORT', this.module)
            ) + '</a>')
        }));
    },

    /**
     * Initializes the popover plugin for the button given.
     *
     * @param {jQuery} button the jQuery button;
     * @private
     */
    _initPopover: function(button) {
        button.popover({
            title: app.lang.get('LBL_FEEDBACK', this.module),
            content: _.bind(function() { return this.$el; }, this),
            html: true,
            placement: 'top',
            trigger: 'manual',
            template: '<div class="popover feedback"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
        });

        // Reposition the modal so all of its contents are within the window.
        button.on('shown.bs.popover', _.bind(this._positionPopover, this));
    },

    /**
     * Sets the horizontal position of the modal.
     *
     * @private
     */
    _positionPopover: function() {
        var $popoverContainer = this.button.data()['bs.popover'].tip();
        var left;
        if (app.lang.direction === 'rtl') {
            // Leave 16px of space between lhs edge of popover and the screen.
            left = 16;
        } else {
            // Leave 16px of space between rhs edge of popover and the screen.
            left = $(window).width() - $popoverContainer.width() - 16;
        }
        $popoverContainer.css('left', left);
    },

    /**
     * Close button on the feedback view is pressed.
     *
     * @param {Event} evt The `click` event.
     */
    close: function() {
        this.toggle(false);
    },

    /**
     * Toggle this view (by re-rendering) and allow force option.
     *
     * @param {boolean} [show] `true` to show, `false` to hide, `undefined`
     *   toggles the current state.
     */
    toggle: function(show) {

        if (_.isUndefined(show)) {
            this._isOpen = !this._isOpen;
        } else {
            this._isOpen = show;
        }

        this.button.popover('destroy');


        if (this._isOpen) {
            this.render();
            this._initPopover(this.button);
            this.button.popover('show');
        }

        this.trigger(this._isOpen ? 'show' : 'hide', this, this._isOpen);
    },

    /**
     * @inheritdoc
     * During dispose destroy the popover.
     */
    _dispose: function() {
        if (this.button) {
            this.button.popover('destroy');
        }
        this._super('_dispose');
    },

    /**
     * Submit the form
     */
    submit: function(e) {

        var $btn = this.$(e.currentTarget);
        if ($btn.attr('disabled')) {
            return;
        }
        $btn.attr('disabled', 'disabled');

        this.model.doValidate();
    },

    /**
     * Sends the Feedback to google doc page.
     *
     * Populate the rest of the data into the model from different sources of
     * the app.
     */
    send: function() {

        this.model.set({
            timezone: app.user.getPreference('timezone'),
            account_type: app.user.get('type'),
            role: app.user.get('roles').join(', ') || 'n/a',
            user_name: app.user.get('user_name'),
            full_name: app.user.get('full_name'),
            phone_mobile: app.user.get('phone_mobile'),
            email1: app.utils.getPrimaryEmailAddress(app.user),
            feedback_app_path: window.location.href,
            feedback_user_browser: navigator.userAgent + ' (' + navigator.language + ')',
            feedback_user_os: navigator.platform,
            feedback_product_name: _.toArray(_.pick(app.metadata.getServerInfo(), 'product_name', 'version')).join(' '),
            company: app.config.systemName
        });
        var post_url = 'https://docs.google.com/forms/d/1xhFoZbGdVwpl8oZwrg3nYhCePtQ-aRzyKSy1Vl4_Y8Y/formResponse';

        $.ajax({
            url: post_url,
            type: 'POST',
            data: {
                'entry.15101558': this.model.get('full_name'),
                'entry.1589166154': this.model.get('user_name'),
                'entry.591328848': this.model.get('phone_mobile'),
                'entry.952467981': this.model.get('email1'),
                'entry.2099612132': this.model.get('account_type'),
                'entry.1815106036': this.model.get('timezone'),
                'entry.827367037': this.model.get('role'),
                'entry.559352220': this.model.get('feedback_text'),
                'entry.577058905': this.model.get('feedback_app_path'),
                'entry.561778483': this.model.get('feedback_user_browser'),
                'entry.1375805563': this.model.get('feedback_user_os'),
                'entry.889161023': this.model.get('feedback_csat'),
                'entry.1631739638': this.model.get('feedback_product_name'),
                'entry.176219889': this.model.get('company')
            },
            dataType: 'xml',
            crossDomain: true,
            cache: false,
            context: this,
            timeout: 10000,
            success: this._handleSuccess,
            error: function(xhr) {
                if (xhr.status === 0) {
                    // the status might be 0 which is still a success from a
                    // cross domain request using xml as dataType
                    this._handleSuccess();
                    return;
                }

                app.alert.show('send_feedback', {
                    level: 'error',
                    messages: app.lang.get('LBL_FEEDBACK_NOT_SENT', this.module)
                });
            }
        });
    },

    /**
     * Handles the success of Feedback submission.
     *
     * Show the success message on top (alert), clears the model and hides the
     * view. This will allow the user to be ready for yet another feedback.
     *
     * @private
     */
    _handleSuccess: function() {
        app.alert.show('send_feedback', {
            level: 'success',
            messages: app.lang.get('LBL_FEEDBACK_SENT', this.module),
            autoClose: true
        });
        this.model.clear();
        this.toggle(false);
    }
})
