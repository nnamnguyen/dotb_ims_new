/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * This file is part of the 'Goto data' module.
 * Author: Olivier Nepomiachty DotBCRM - DotbLabs
 */
({
    plugins: ['Dashlet'],

    initDashlet: function() {
        this.account = {};
        this.contact = {};
    },

    loadData: function(options) {
        if (_.isUndefined(this.model)) {
            return;
        }

        var self = this;
        app.api.call('GET', app.api.buildURL('Contacts?filter=[{"$and":[{"first_name":"Alexa"},{"last_name":"Holiday"}]}]'), null,
        { 
            success: function (data) {
                if (self.disposed) {
                    return;
                }
                self.contact.name = data.records[0].name;
                self.contact.id = data.records[0].id;
                self.contact.picture = data.records[0].picture;
                self.account.name = data.records[0].account_name;
                self.account.id = data.records[0].accounts.id;
                self.render();
                self.get_count('Contacts', self.contact.id, 'calls', 'contact', 'nbcalls');
                self.get_count('Contacts', self.contact.id, 'meetings', 'contact', 'nbmeetings');
                self.get_count('Contacts', self.contact.id, 'tasks', 'contact', 'nbtasks');
                self.get_count('Accounts', self.account.id, 'opportunities', 'account', 'nbopportunities');
                self.get_count('Accounts', self.account.id, 'cases', 'account', 'nbcases');
                                   
            },
            error: function(result) {
                console.log('Error getting go to data');
            }
        });

    },
    
    get_count: function(module, id, link, hbsvar1, hbsvar2) {
        var self = this;
        var url = module + '/' + id + '/link/' + link + '/count';
        app.api.call('GET', app.api.buildURL(url), null,
        { 
            success: function (data) {
                if (self.disposed) {
                    return;
                }
                self[hbsvar1][hbsvar2] = data.record_count;
                self.render();                                  
            },
            error: function(result) {
                console.log('Error getting ' + url);
            }
        });
	}
})

