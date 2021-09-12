/**
 * Created by sergiu.precup on 6/12/18.
 */


({
    extendsFrom: "FieldsetField",

    initialize: function(options){
        this._super('initialize', [options]);
    },

    /**
     * Gets the child field definitions that are defined in the metadata.
     *
     * @return {Object} Metadata of the child fields.
     * @protected
     */
    _getChildFieldsMeta: function() {

        var parent_name = this.model.get("parent_name");
        var fields = app.utils.deepCopy(this.def.fields);


        if(_.isEmpty(parent_name)){
            fields = _.reject(fields, {name: "parent_name"})
        }
        else {
            fields = _.reject(fields, {name: "related_module_name"})
        }

        return fields;
    },
})