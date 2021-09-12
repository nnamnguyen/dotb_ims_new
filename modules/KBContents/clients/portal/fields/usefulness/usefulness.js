

({
    extendsFrom: 'BaseKBContentsUsefulnessField',

    initialize: function(options) {
        this._super('initialize', [options]);

        //RS-1445 - Need to wait for model to be loaded to get value of usefulness_user_vote
        this.model.on('data:sync:complete', function() {
            if (!this.disposed) {
                this.render();
            }
        }, this);
    }
})
