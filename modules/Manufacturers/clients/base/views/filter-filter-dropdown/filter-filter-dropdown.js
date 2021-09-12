

({
    extendsFrom: 'FilterFilterDropdownView',

    /**
     * @inheritdoc
     */
    getFilterList: function() {
        var list = this._super('getFilterList').filter(function(obj) {
            if (obj.id == 'favorites') {
                return false;
            }

            return true;
        });

        return list;
    }
})
