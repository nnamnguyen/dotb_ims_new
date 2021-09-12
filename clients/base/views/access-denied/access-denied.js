
/**
 * @class View.Views.Base.AccessDeniedView
 * @alias DOTB.App.view.views.BaseAccessDeniedView
 * @extends View.View
 */
({
    className: 'error-page',

    cubeOptions: {spin: false},

    events: {
        'click .dotb-cube': 'spinCube'
    },

    spinCube: function() {
        this.cubeOptions.spin = !this.cubeOptions.spin;
        this.render();
    }
})
