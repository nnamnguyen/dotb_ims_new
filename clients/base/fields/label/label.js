({
    bindDataChange: $.noop,
    bindDomChange: $.noop,
    unbindDom: $.noop,
    format: function(value) {
        if (this.def.formatted_value) {
            value = this.def.formatted_value;
        } else {
            value = app.lang.get(this.def.default_value, this.module);
        }
        return value;
    },
    _isErasedField: function() {
        return false;
    }
})
