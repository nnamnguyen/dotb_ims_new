
({
    extendsFrom: 'EnumField',

    loadEnumOptions: function(fetch, callback) {
        this._super('loadEnumOptions', [fetch, callback]);

        var startYear = this.options.def.startYear;

        _.each(this.items, function(value, key, list) {
            list[key] = list[key].replace("{{year}}", startYear++);
        }, this);
    }
})
