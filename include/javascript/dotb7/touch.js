
/* Needed so that on iPad, when dismissing the keyboard
 * by clicking out of the input, the fixed elements
 * will not be in the center of the screen
 */
var _inputFocused = null;
if (Modernizr.touch) {
    $(document).on('blur', 'input, textarea', function() {
        _inputFocused = setTimeout(function() {
            window.scrollTo(document.body.scrollLeft, document.body.scrollTop);
        }, 0);
    });
    $(document).on('focus', 'input, textarea', function() {
        clearTimeout(_inputFocused);
    });
}
