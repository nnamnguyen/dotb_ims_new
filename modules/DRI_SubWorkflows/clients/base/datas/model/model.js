/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
({
    initialize: function (options) {
        app.Bean.prototype.initialize.apply(this, arguments);
        this.on("change:sort_order", this.setLabel, this);
        this.on("change:name", this.setLabel, this);
    },

    setLabel: function () {
        var order = this.get("sort_order");
        order = order.toString().length === 1 ? "0" + order : order;
        this.set("label", order + ". " + this.get("name"));
    }
})
