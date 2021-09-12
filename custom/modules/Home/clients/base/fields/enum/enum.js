/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


({

    extendsFrom: 'EnumField',
    initialize: function (opts) {
        this._super('initialize', [opts]);
        this._initEvents();
        opts.context.set("currentFilterId", "survey-records");
        this.changeSurveyQueHandler();
    },

    _initEvents: function () {
        this._changeSurveyQuestions();
    },

    _changeSurveyQuestions: function () {
        this.model.on("change:saved_report", this.changeSurveyQueHandler, this);
    },

    changeSurveyQueHandler: function () {
        var survey_id = this.model.attributes.saved_report_id;
        var self = this;
        // Load Survey Questions of a selected survey
        var url = App.api.buildURL("bc_survey", "survey_question_list", "", {survey_id: survey_id});

        app.api.call('GET', url, null, {
            success: function (newOptions) {
                if (typeof newOptions != 'object') {
                    newOptions = JSON.parse(newOptions);
                }

                if (self.name === 'saved_report_question') {
                    self.items = newOptions;
                }
                self._render();
            }
        });

    },
    /**
     * @override
     * @protected
     * @chainable
     */
    _render: function () {
        this._super('_render');
    },
})