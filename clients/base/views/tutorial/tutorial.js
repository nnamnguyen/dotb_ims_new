
/**
 * @class View.Fields.Base.TutorialView
 * @alias DOTB.App.view.views.BaseTutorialView
 * @extends View.TutorialView
 */
({
    /**
     * extendsFrom: This needs to be app.view.TutorialView since it's extending a Lumia specific view class.  This is a
     * special case, as the normal method is for it to be a string.
     */
    extendsFrom: app.view.TutorialView,

    className: '', //override default class

    initialize: function(options) {
        this.resizeCallback = _.debounce(_.bind(function(){
            this.highlightItem(this.index);
        }, this), 400);
        $(window).on('resize', this.resizeCallback);
        this.keyupCallback = _.bind(this.processKeyCode, this);
        $(document).on('keyup', this.keyupCallback);
        app.view.TutorialView.prototype.initialize.call(this, options);
        app.events.on("cache:clean", function(callback) {
            callback(["tutorialPrefs"]);
        });
    },
    processKeyCode: function(e) {
        switch(e.which) {
            case 37: // left
                this.back(e);
                break;

            case 39: // right
            case 13: // Enter
                this.next(e);
                break;

            case 27: // exit
                this.hide(e);
                break;

            default: return; // exit this handler for other keys
        }
        e.preventDefault();
    },

    /**
     * removes the tour
     */
    remove: function() {
        $(window).off('resize', this.resizeCallback);
        $(document).off('keyup', this.keyupCallback);
        app.view.TutorialView.prototype.remove.call(this);
        var prefs = app.cache.get('tutorialPrefs') || {};
        if (prefs.showTooltip) {
            this.showTooltip();
            this.removeTooltip(3000);
        }
    },

    /**
     * shows tooltip on tour button
     */
    showTooltip: function() {
        $('[data-action=tour]')
            .tooltip({
                container: 'body',
                trigger: 'manual'
            })
            .tooltip('show');
    },

    /**
     * removes tooltip from tour button
     * @param {int} delayTime milliseconds.
     */
    removeTooltip: function(delayTime) {
        if (!delayTime) {
            $('[data-action=tour]').tooltip('hide');
        } else {
            _.delay(function() { $('[data-action=tour]').tooltip('hide'); }, delayTime);
        }
    }
})
