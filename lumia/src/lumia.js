

var DOTB = require('imports-loader?DOTB=>window.DOTB!exports-loader?DOTB!app.js');
window.DOTB = DOTB;

DOTB.Api = require('@dotbcrm/ventana');
require('utils/utils.js');
require('utils/date.js');
require('utils/math.js');
require('utils/currency.js');

require('core/before-event.js');
require('core/cache.js');
require('core/events.js');
require('core/error.js');

require('view/template.js');

require('core/context.js');
require('core/controller.js');
require('core/router.js');
require('core/routing.js');
require('core/language.js');
require('core/metadata-manager.js');
require('core/acl.js');
require('core/user.js');
require('core/plugin-manager.js');

require('utils/logger.js');

require('data/bean.js');
require('data/bean-collection.js');
require('data/mixed-bean-collection.js');
require('data/data-manager.js');
require('data/validation.js');

require('view/hbs-helpers.js');
require('view/view-manager.js');
require('view/component.js');
require('view/view.js');
require('view/field.js');
require('view/layout.js');
require('view/alert.js');

require('utils/underscore-mixins.js');
