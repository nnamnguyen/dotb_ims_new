<?php



class ViewNoaccess extends DotbView
{
	public $type = 'noaccess';
	
	/**
	 * @see DotbView::display()
	 */
	public function display()
	{
		echo '<p class="error">Warning: You do not have permission to access this module.</p>';
 	}
}
