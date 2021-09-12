
(function(app) {
    app.events.on('app:init', function() {

        _.mixin({
            /**
             * Move an item to a specific index.
             *
             * @param {Array} initialArray The initial array.
             * @param {number} fromIndex The index of the item to move.
             * @param {number} toIndex The index where the item is moved.
             * @return {Array} The array reordered.
             */
            moveIndex: function(array, fromIndex, toIndex) {
                // Remove the item, and add it back to its new position.
                array.splice(toIndex, 0, _.first(array.splice(fromIndex, 1)));
                return array;
            }
        });

    });
})(DOTB.App);
