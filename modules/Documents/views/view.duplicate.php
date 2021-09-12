<?php


/*
    We need the display function code from ViewEdit in Duplicate mode as well so
    extend the class to bring in that function without redefining all the code.
*/

class DocumentsViewDuplicate extends DocumentsViewEdit
{
    /**
     * Re-declare view type to pass ACL.
     * @var string
     */
    public $type = 'duplicate';

    /**
     * @see DotbView::process()
     */
    public function process($params = array())
    {
        //Return view type to edit to render EditView page.
        $this->type = 'edit';
        parent::process($params);
    }

    /**
     * Get DuplicateView object
     * @return DuplicateView
     */
    protected function getEditView()
    {
        return new DuplicateView();
    }
}
