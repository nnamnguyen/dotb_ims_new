<?php



class ProductsStudioModule extends StudioModule
{
    public function __construct($module)
    {
        parent::__construct($module);
    }

    public function getViews()
    {
        $views = parent::getViews();

        $views = array_merge(array(
            translate("LBL_PRODUCTS_QUOTE_DATA_LIST", "Products") => array(
                'name' => translate("LBL_PRODUCTS_QUOTE_DATA_LIST", "Products"),
                'type' => 'quote-data-group-list',
                'image' => 'quote-data-group-list',
            ),
        ), $views);

        return $views;
    }

    public function getLayouts()
    {
        $layouts = parent::getLayouts();
        unset($layouts[translate("LBL_PRODUCTS_QUOTE_DATA_LIST", "Products")]);

        return $layouts;
    }
}
