
/**
 * @class View.Views.Base.MasslinkProgressView
 * @alias DOTB.App.view.views.BaseMasslinkProgressView
 * @extends View.Views.Base.MassupdateProgressView
 */
({
    extendsFrom: 'MassupdateProgressView',

    /**
     * Set of labels.
     */
    _labelSet: {
        'update': {
            PROGRESS_STATUS: 'TPL_MASSLINK_PROGRESS_STATUS',
            DURATION_FORMAT: 'TPL_MASSLINK_DURATION_FORMAT',
            FAIL_TO_ATTEMPT: 'TPL_MASSLINK_FAIL_TO_ATTEMPT',
            WARNING_CLOSE: 'TPL_MASSLINK_WARNING_CLOSE',
            WARNING_INCOMPLETE: 'TPL_MASSLINK_WARNING_INCOMPLETE',
            SUCCESS: 'TPL_MASSLINK_SUCCESS',
            TITLE: 'TPL_MASSLINK_TITLE'
        }
    }

})
