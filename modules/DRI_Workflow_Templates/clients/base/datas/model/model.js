/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
({
    copy: function (parent) {
        app.Bean.prototype.copy.apply(this, arguments);
        this.set("copied_template_id", parent.get("id"));
        this.set("copied_template_name", parent.get("name"));
    }
})
