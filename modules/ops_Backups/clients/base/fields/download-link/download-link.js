({
    events: {
        "click .download" : "download"
    },
    fileUrl : "",
    _render: function() {
        this.model.fileField = this.name;
        app.view.Field.prototype._render.call(this);
        return this;
    },
    format: function(value){
        return value;
    },
    download: function() {
        var url = app.api.buildFileURL({
            module: this.module,
            id: this.model.id,
            field: 'download_link'
        }, {
            htmlJsonFormat: false
        });
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function (request) {
                request.setRequestHeader('OAuth-Token', app.api.getOAuthToken());
            },
        }).then(function(data) {
            window.location = data;
        });
    },
    bindDomChange: function() {
        //Keep empty because you cannot set a value of a type `file` input
        //We don't trigger change event so we don't rerender
    },
    bindDataChange: function() {
        if (this.model) {
            this.model.on("change:" + this.name, function() {
                var isValue = this.$(this.fieldTag).val();
                if (!isValue) {
                    //Rerender only if the input type file is empty
                    this.render();
                }
            }, this);
        }
    }
})
