/**
 * Handlebars helpers.
 *
 * These functions are to be used in handlebars templates.
 * @class View.Handlebars.helpers
 * @singleton
 */
(function (app) {
    app.events.on("app:init", function () {

        /**
         * Gets the letters used for the icons shown in various headers for
         * each module, based on the translated singular module name.
         *
         * This does not always match the name of the module in the model,
         * e.g. "Product" maps to "Quoted Line Item".
         *
         * If the module has an icon string defined, use it, otherwise
         * fallback to the module's translated name.
         *
         * If there are spaces in the name, (e.g. Revenue Line Items or
         * Product Catalog), it takes the initials from the first two words,
         * instead of the first two letters (e.g. RL and PC, instead of Re
         * and Pr).
         *
         * @param {string} module Module to which the icon belongs.
         */
        Handlebars.registerHelper('moduleIconLabel', function (module) {
            return app.lang.getModuleIconLabel(module);
        });

        /**
         * Handlebar helper to get the Tooltip used for the icons shown in various headers for each module, based on the
         * translated singular module name.  This does not always match the name of the module in the model,
         * i. e. Product == Revenue Line Item
         * @param {String} module to which the icon belongs
         */
        Handlebars.registerHelper('moduleIconToolTip', function (module) {
            return app.lang.getModuleName(module);
        });

        /**
         * Handlebar helper to translate any dropdown values to have the appropriate labels
         * @param {String} value The value to be translated.
         * @param {String} key The dropdown list name.
         */
        Handlebars.registerHelper('getDDLabel', function (value, key) {
            return app.lang.getAppListStrings(key)[value] || value;
        });

        /**
         * Handlebar helper to retrieve a view template as a sub template
         * @param {String} key Key for the template to retrieve.
         * @param {Object} data Data to pass into the compiled template
         * @param {Object} options (optional) Optional parameters
         * @return {String} String Template
         */
        Handlebars.registerHelper('subViewTemplate', function (key, data, options) {
            var frame, template;

            template = app.template.getView(key, options.hash.module);

            // merge the hash variables into the frame so they can be added as
            // private @variables via the data option below
            frame = _.extend(Handlebars.createFrame(options.data || {}), options.hash);

            return template ? template(data, {data: frame}) : '';
        });

        /**
         * Handlebar helper to retrieve a field template as a sub template
         * @param {String} fieldName determines which field to use.
         * @param {String} view determines which template within the field to use.
         * @param {Object} data Data to pass into the compiled template
         * @param {Object} options (optional) Optional parameters
         * @return {String} String Template
         */
        Handlebars.registerHelper('subFieldTemplate', function (fieldName, view, data, options) {
            var frame, template;

            template = app.template.getField(fieldName, view, options.hash.module);

            // merge the hash variables into the frame so they can be added as
            // private @variables via the data option below
            frame = _.extend(Handlebars.createFrame(options.data || {}), options.hash);

            return template ? template(data, {data: frame}) : '';
        });

        /**
         * Handlebar helper to retrieve a layout template as a sub template
         * @param {String} key Key for the template to retrieve.
         * @param {Object} data Data to pass into the compiled template
         * @param {Object} options (optional) Optional parameters
         * @return {String} String Template
         */
        Handlebars.registerHelper('subLayoutTemplate', function (key, data, options) {
            var frame, template;

            template = app.template.getLayout(key, options.hash.module);

            // merge the hash variables into the frame so they can be added as
            // private @variables via the data option below
            frame = _.extend(Handlebars.createFrame(options.data || {}), options.hash);

            return template ? template(data, {data: frame}) : '';
        });

        /**
         * @method buildUrl
         * Builds an URL based on hashes sent on handlebars helper.
         *
         * Example:
         * <pre><code>
         * {{buildUrl url="path/to/my-static-file.svg"}}
         * </code></pre>
         *
         * @see Utils.Utils#buildUrl to know how we are building the url.
         *
         * @param {Object} options
         *   The hashes being sent by handlebars helper. Currently requires
         *   `options.hash.url` until we extend this to be used for image
         *   fields.
         * @return {String}
         *   The safely built url.
         */
        Handlebars.registerHelper('buildUrl', function (options) {
            return new Handlebars.SafeString(app.utils.buildUrl(options.hash.url));
        });

        /**
         * @method loading
         * Display animated loading message.
         *
         * To display loading message with default markup:
         *
         *     {{loading 'LBL_ALERT_TITLE_LOADING' }}
         *
         * You can also apply specific css classes:
         *
         *     // this will add the class `someCssClass` to `div.loading`.
         *     {{loading 'LBL_ALERT_TITLE_LOADING' cssClass='someCssClass'}}
         *
         * @param {Object} [options] Optional params.
         * @param {Object} [options.hash] The hash of the optional params.
         * @param {string} [options.hash.cssClass] A space-separated list of
         *   classes to apply to `div.loading`.
         */
        Handlebars.registerHelper('loading', function (str, options) {
            str = app.lang.get(str);
            var cssClass = ['loading'];
            if (_.isString(options.hash.cssClass)) {
                cssClass = _.unique(cssClass.concat(
                    Handlebars.Utils.escapeExpression(options.hash.cssClass).split(' ')
                ));
            }
            return new Handlebars.SafeString(
                '<div class="' + cssClass.join(' ') + '">'
                + Handlebars.Utils.escapeExpression(str)
                + '<i class="l1">&#46;</i><i class="l2">&#46;</i><i class="l3">&#46;</i>'
                + '</div>'
            );
        });

        /**
         * Add by TKT
         */
        Handlebars.registerHelper('generateSelectHtml', function (key, options, name) {
            var result = '<select name="' + name + '">';
            _.each(options, function (val, keya) {
                if (keya == key) result += '<option selected value="' + keya + '">' + val + '</option>';
                else result += '<option value="' + keya + '">' + val + '</option>';
            });
            result += '</select>';
            return new Handlebars.SafeString(result);
        });

        /**
         * Added by HP
         * To register helper equal string
         */
        Handlebars.registerHelper('ifEquals', function (arg1, arg2, options) {
            return (arg1 == arg2) ? options.fn(this) : options.inverse(this);
        });
        /** Add by Tuan Anh
         * To handle equal string with 4 arg
         */
        Handlebars.registerHelper('orEquals', function (obj1, string1, obj2, string2, options) {
            if(obj1 == string1 || obj2 == string2) {
                return options.fn(this);
            }else {
                return options.inverse(this);
            }
        });
        /** Add by Tuan Anh
         * To handle not equal string with 4 arg
         */
        Handlebars.registerHelper('andNotEquals', function (obj1, string1, obj2, string2, options) {
            if(obj1 != string1 && obj2 != string2) {
                return options.fn(this);
            }else {
                return options.inverse(this);
            }
        });
        /**
         * add by TKT
         */
        Handlebars.registerHelper('getValueOf', function (object, key) {
            if (typeof object[key] != "undefined") return object[key];
        });

        Handlebars.registerHelper("rtSBrelativeTime", function(datetime, options) {
            var date = new moment(datetime);
            var temp = moment.localeData()._relativeTime;
            var newformat = {
                future: 'in %s',
                past: '%s ago',
                s: '%ds',
                m: '%dm',
                mm: '%dm',
                h: '%dh',
                hh: '%dh',
                d: '%dd',
                dd: '%dd',
                M: '%dM',
                MM: '%dM',
                y: '%dY',
                yy: '%dY'
            };
            moment.localeData()._relativeTime = newformat;
            var attrs, html;

            options.hash.title = options.hash.title || date.formatUser(options.hash.dateOnly);

            attrs = _.map(options.hash, function(attr, key) {
                return key + '="' + Handlebars.Utils.escapeExpression(attr) + '"';
            }).join(' ');

            html = '<time datetime="' + date.format() + '" ' + attrs + '>' + date.fromNow() + '</time>';
            moment.localeData()._relativeTime = temp;

            return new Handlebars.SafeString(html);
        });

        Handlebars.registerHelper("rt_initialsMaker", function(name, opts) {
            var splitArr = name.split(" ");
            return (splitArr[1]) ? splitArr[0][0] + splitArr[1][0] : splitArr[0][0];
        });

        Handlebars.registerHelper("rt_attValue", function(obj, field, opts) {
            let temp = '';
            if (typeof field === 'object') {
                temp = opts.prefix;
                field.forEach(function(f) {
                    let v = getAttribute(obj, f, opts, true);
                    if (v) {
                        let fix = f + '_prefix';
                        if (opts[fix]) {
                            temp += opts[fix];
                        }
                        temp += v;
                        fix = f + '_postfix';
                        if (opts[fix]) {
                            temp += opts[fix];
                        }
                    }
                });
                temp += opts.postfix;
            } else {
                temp = getAttribute(obj, field, opts);
            }
            return temp;
        });

        Handlebars.registerHelper("rt_hasValue", function(obj, field, opts) {
            let hasValue = false;
            if (typeof field === 'object') {
                $.each(field, function(i, f) {
                    if (getValue(obj, f, opts.type)) {
                        hasValue = true;
                        return false;
                    }
                });
            } else {
                hasValue = (getValue(obj, field, opts.type)) ? 1 : 0;
            }
            return hasValue;
        });

        Handlebars.registerHelper("rt_limitChars", function(value, opts) {
            var lim = 20;
            if (value.length > lim) {
                value = value.substring(0, lim) + '...';
            }
            return value;
        });

        Handlebars.registerHelper("rt_fullName", function(atts, opts) {

            if (opts.firstNameAllowed) {
                return atts['last_name'];
            } else {
                return atts['first_name'] + ' ' + atts['last_name'];
            }

        });

        Handlebars.registerHelper("rt_getPicture", function(id, opts) {
            return app.api.buildFileURL({
                module: "Users",
                id: id,
                field: "picture"
            }, {
                cleanCache: true
            });
        });

        Handlebars.registerHelper("rt_colorLabel", function(atts, opts) {
            if (opts.module) {
                return opts.metaColorLabelList[atts[opts.metaColorLabelField]];
            }
            return null;
        });

        Handlebars.registerHelper("rt_fLabel", function(obj, field, opts) {
            if (opts.module) {
                return app.lang.get(obj[field].vname, opts.module);
            }
            return null;
        });

        Handlebars.registerHelper("rt_setIndex", function(value, opts) {
            opts.index = value;
        });

        Handlebars.registerHelper("rt_setStatus", function(value, opts,) {
            opts.status = value;
        });

        var getValue = function(obj, field, type) {
            let val = obj[field];
            if (type && type === 'date') {
                val = moment(val).format('MM/DD/YYYY h:mma');
            }
            return val;
        };

        var getAttribute = function(obj, field, opts, nofixes) {
            let temp = '';
            if (opts.type) {
                temp = getValue(obj, field, opts.type);
            } else {
                temp = getValue(obj, field);
            }
            if (temp && !nofixes) {
                if (opts.prefix) {
                    temp = opts.prefix + temp;
                }
                if (opts.postfix) {
                    temp += opts.postfix;
                }
            }
            return temp;
        };
        // by - TDT
        Handlebars.registerHelper('gtAndEq', function (arg1, arg2, options) {
            return (parseFloat(arg1) >= parseFloat(arg2)) ? options.fn(this) : options.inverse(this);
        });
        Handlebars.registerHelper('gt', function (arg1, arg2, options) {
            return (parseFloat(arg1) > parseFloat(arg2)) ? options.fn(this) : options.inverse(this);
        });
        Handlebars.registerHelper('ltAndEq', function (arg1, arg2, options) {
            return (parseFloat(arg1) <= parseFloat(arg2)) ? options.fn(this) : options.inverse(this);
        });
        Handlebars.registerHelper('lt', function (arg1, arg2, options) {
            return (parseFloat(arg1) < parseFloat(arg2)) ? options.fn(this) : options.inverse(this);
        });
        Handlebars.registerHelper('cr_fm', function (options ,arg1,arg2) {
            return app.utils.formatNumber(options,arg1,arg2,',','.')
        });
    });
})(DOTB.App);
