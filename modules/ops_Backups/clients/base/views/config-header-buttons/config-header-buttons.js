({
    extendsFrom: 'ConfigHeaderButtonsView',

    saveConfig: function() {
        var invalidEmails = false;
        var emails = this.model.get('notification_emails');
        var $emails = $(".existingAddress");
        var c = 0;
        _.each(emails, function(email){
            if (!app.utils.isValidEmailAddress(email.email_address)){
                $($emails[c]).addClass('error');
                invalidEmails = true;
            }else{
                $($emails[c]).removeClass('error');
            }
            c++;
        }, this);
        if (invalidEmails){
            app.alert.show("InvalidEmail",{level: 'error', autoClose: true,messages: "Invalid email address configured for Notifications."});
            return false;
        }
        this._super('saveConfig');
    }

})