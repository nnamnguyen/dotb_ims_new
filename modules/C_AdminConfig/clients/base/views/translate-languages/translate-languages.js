({
    langTranslate: 'vn_vn',
    langExam: 'en_us',
    events: {
        'change #module_selected': 'changeModuleTranslate',
        'change textarea.lang-value': 'changeTranslateValue',
        'change #type_translate': 'changeTypeTranslate'
    },
    initialize: function (options) {
        this._super('initialize', [options]);
        this.context.on("save", _.bind(this.save, this));
        this.context.on("cancel", _.bind(this.cancel, this));
        this.loadData();
    },

    loadData: function () {
        this.showLoading();
        app.api.call('read', app.api.buildURL('translate_language/get_list_modules'), {}, {
            success: _.bind(function (res) {
                if (res.success) {
                    this.data = res.data;
                    this.module_selected = _.first(_.values(this.data));
                    this.type_translate = 'en_vn';
                    this.render();
                    app.alert.dismiss('loading');
                }
            }, this)
        });
    },

    changeTypeTranslate: function (e) {
        this.type_translate = $(e.currentTarget).val();
        this.render();
    },

    changeTranslateValue: function (e) {
        var $this = $(e.currentTarget);
        this.data[$this.attr('data-module')]['mod_strings'][$this.attr('data-lang')][$this.attr('data-langkey')] = $this.val();
    },

    changeModuleTranslate: function (e) {
        this.module_selected = this.data[$(e.currentTarget).val()];
        this.render();
    },

    showLoading: function () {
        var name = 'loading';
        app.alert.show(name, {
            level: 'process',
            title: 'loading'
        });
    },

    showSuccessAlert: function () {
        app.alert.show('saved', {
            level: 'success',
            messages: app.lang.get('LBL_SUCCESS', 'C_AdminConfig'),
            autoClose: true
        });
    },

    showErrorAlert: function () {
        app.alert.show(errored, {
            level: 'error',
            messages: '',
            autoClose: true
        });
    },

    save: function () {
        this.showLoading();
        app.api.call('create', app.api.buildURL('translate_language/save_langs'), {data: this.data}, {
            success: _.bind(function (res) {
                if (res.success) this.showSuccessAlert();
                else this.showErrorAlert();
                app.alert.dismiss('loading');
            }, this)
        });
    },

    cancel: function () {
        app.router.navigate("/", {trigger: true});
    }
})