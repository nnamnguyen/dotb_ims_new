
var CloseListItem = function (options) {
    ListItem.call(this, options);
    CloseListItem.prototype.init.call(this, options);
};

CloseListItem.prototype = new ListItem();

CloseListItem.prototype.init = function (options) {
    this.setText(function () {
        var dv = document.createElement("div"),
            icon = document.createElement("span");
        dv.className = 'close-list-item';
        icon.className = 'icon-remove';
        dv.appendChild(icon);
        return dv;
    });
};

CloseListItem.prototype.createHTML = function () {
    ListItem.prototype.createHTML.call(this);
    $(this.html).css('background-color','#A0A0A0');
    return this.html;
};

