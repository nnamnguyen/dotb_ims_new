({
    extendsFrom:'BaseeditmodalView',
    fallbackFieldTemplate: 'detail',
    events:{
        'click [name="cancel_button"]':'cancelButton',
        'click [name="save_button"]':'saveButton',
        'change [name="loy_loyalty_points"]':'setLoyalty',
    },
    student:{},
    initialize: function(options) {
        app.view.View.prototype.initialize.call(this, options);
        var parent = this.context.parent.get('model');
        if(parent != undefined || parent != null){
            this.student['name'] = parent.get('parent_name');
            this.student['point'] = parent.get('loyalty').points;
            this.student['rate'] = parent.get('loyalty_rate').value;
            this.student['id_rate'] = parent.get('loyalty_rate').id;

        }
        if (this.layout) {
            this.layout.on('app:view:choice-loyalty', function() {
                this.render();
                this.$('.modal').modal({
                    backdrop: 'static'
                });
                this.$('.modal').modal('show');
                $('.datepicker').css('z-index','20000');
                app.$contentEl.attr('aria-hidden', true);
                $('.modal-backdrop').insertAfter($('.modal'));

                /**If any validation error occurs, system will throw error and we need to enable the buttons back*/
                this.context.get('model').on('error:validation', function() {
                    this.disableButtons(false);
                }, this);
            }, this);
        }
        this.bindDataChange();
    },

    /**Overriding the base saveButton method*/
    saveButton: function() {
       this.setLoyalty();
        var detail = [];
        var loyalty = {};
        var total = Number(this.context.parent.get('model').get('new_sub'));
        var percent =(this.student['use_amount']/total)*100
        loyalty['loyalty_point'] = this.student['use_point'];
        loyalty['loyalty_amount'] = this.student['use_amount'];
        loyalty['loyalty_percent'] = percent;
        loyalty['rate_id'] = this.student['id_rate']
        detail.push(loyalty);
            this.context.parent.get('model').set({
            'order_loyalty_amount':this.student['use_amount'],
            'order_loyalty_percent':percent,
            'loyalty_detail':detail,
        });
        this._disposeView();
    },
    /**Overriding the base cancelButton method*/
    cancelButton: function() {
        app.$contentEl.removeAttr('aria-hidden');
        this._disposeView();
    },
    /**Overriding the base saveComplete method*/
    saveComplete: function() {
        this._super('saveComplete');
        app.$contentEl.removeAttr('aria-hidden');
        this._disposeView();
    },
    /**Custom method to dispose the view*/
    _disposeView:function(){
        /**Find the index of the view in the components list of the layout*/
        var index = _.indexOf(this.layout._components,_.findWhere(this.layout._components,{name:'choice-loyalty'}));
        if(index > -1){
            /** dispose the view so that the evnets, context elements etc created by it will be released*/
            this.layout._components[index].dispose();
            /**remove the view from the components list**/
            this.layout._components.splice(index, 1);
        }
    },

    setLoyalty:function (evt) {
        var point = Number(this.$el.find('[name="loy_loyalty_points"]').val());
        if(point > Number(this.student['point'])){
            this.$el.find('[name="loy_loyalty_points"]').val(0);
            this.student['use_point'] = 0;
            this.student['point_input'] = 0;
            this.student['use_amount'] = 0;
            $('.total_amount').text(app.utils.formatNumber(this.student['use_amount'],0,0,',','.'));
        }
        else{
            this.student['use_point'] = point;
            this.student['point_input'] = point;
            this.student['use_amount'] = point*Number(this.student['rate']);
            $('.loy_total_points').text(point);
            $('.total_amount').text(app.utils.formatNumber(this.student['use_amount'],0,0,',','.'));
        }
        this.bindDataChange();
    }
})