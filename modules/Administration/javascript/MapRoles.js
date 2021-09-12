
(function($) {
    var $selects = $("#map-roles select");
    $selects.change(function() {
        var $this = $(this),
            value = $this.val(),
            $parent = $this.closest("tr"),
            matches = [],
            packageRoleId,
            packageRoleName,
            instanceRoleName;

        if (value) {
            $selects.not(this).each(function() {
                var $this = $(this);
                if ($this.val() == value) {
                    $this.val("").trigger("change");
                }
            });

            packageRoleId = $(".package-role-id .value", $parent).text();
            if (value == packageRoleId) {
                matches.push("LBL_ID");
            }

            packageRoleName = $(".package-role-name", $parent).text();
            instanceRoleName = $("option:selected", $this).text();
            if (instanceRoleName == packageRoleName) {
                matches.push("LBL_NAME");
            }
        }

        var text = "";
        if (matches.length > 0) {
            var app = parent.DOTB.App;
            text = app.utils.formatString(app.lang.getModString("LBL_UW_ROLE_MATCHES_BY", "Administration"), [
                matches.map(function(label) {
                    return app.lang.getAppString(label);
                }).join(app.lang.getModString("LBL_UW_ROLE_MATCHES_BY_DELIMITER", "Administration"))
            ]);
        }
        $(".role-matches", $parent).text(text);
    }).trigger("change");
})(jQuery);
