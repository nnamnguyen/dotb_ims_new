
/**
 * @class View.Views.Base.MobileActionView
 * @alias DOTB.App.view.views.BaseMobileActionView
 * @extends View.View
 */
({
    tagName: 'span',
    events: {
        'click [data-action=mobile]': 'navigateToMobile'
    },
    navigateToMobile: function () {
        if (document.cookie.indexOf('dotb_mobile=') !== -1) {
            // kill dotb_mobile=0 cookie
            document.cookie = 'dotb_mobile=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }
        // navigate to the same route of mobile site
        window.location = app.utils.buildUrl('mobile/') + window.location.hash;
    }
})
