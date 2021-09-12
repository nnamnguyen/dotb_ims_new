
({
    /**
     * @inheritdoc
     *
     * Prevent render if transfer activities action is not move.
     */
    _render: function() {
        var transferActivitiesAction = app.metadata.getConfig().leadConvActivityOpt;
        if (transferActivitiesAction === 'move') {
            this.model.setDefault('transfer_activities', true);
            this._super('_render');
        }
    }
})
