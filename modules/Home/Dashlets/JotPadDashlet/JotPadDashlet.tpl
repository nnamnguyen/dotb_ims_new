{*

*}


<div id='jotpad_{$id}' ondblclick='JotPad.edit(this, "{$id}")' style='overflow: auto; width: 100%; height: {$height}px; border: 1px #ddd solid'>{$savedText}</div>
<textarea id='jotpad_textarea_{$id}' rows="5" onblur='JotPad.blur(this, "{$id}")' style='display: none; width: 100%; height: {$height}px; overflow: auto'></textarea>