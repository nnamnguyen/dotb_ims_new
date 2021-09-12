

if (ZEPTO) {
    window.$ = require('exports-loader?$!zepto/src/zepto');
    require('zepto/src/ajax');
    require('zepto/src/detect');
    require('zepto/src/event');
    require('zepto/src/fx');
    require('zepto/src/fx_methods');
    require('zepto/src/selector');
    require('zepto/src/touch');
} else {
    require('script-loader!crosstab');
    require('script-loader!jquery/dist/jquery.min.js');
    require('script-loader!jquery-migrate/dist/jquery-migrate.min.js');
    require('script-loader!jquery.iframe-transport/jquery.iframe-transport.js');
}

require('script-loader!underscore/underscore-min.js');
require('script-loader!backbone');
require('script-loader!handlebars/dist/handlebars.min.js');
window.async = require('async');
require('script-loader!moment/min/moment.min.js');
require('script-loader!store/store.min.js');
require('script-loader!php-js/version_compare.js');
require('script-loader!big.js');

require('./lumia');

require('utils/cookie.js');
require('dotbanalytics/dotbanalytics.js');
require('dotbanalytics/googleanalyticsconnector.js');
require('dotb/dotb.liverelativedate.js');
