<?php



class QuotesStudioModule extends StudioModule
{
    public function __construct($module)
    {
        parent::__construct($module);
    }

    public function getViews()
    {
        $views = parent::getViews();

        $views = array_merge(array(
            translate("LBL_QUOTE_DATA_GRAND_TOTALS_HEADER", "Quotes") => array(
                'name' => translate("LBL_QUOTE_DATA_GRAND_TOTALS_HEADER", "Quotes"),
                'type' => 'quote-data-grand-totals-header',
                'image' => 'quote-data-grand-totals-header',
            ),
            translate("LBL_QUOTE_DATA_GRAND_TOTALS_FOOTER", "Quotes") => array(
                'name' => translate("LBL_QUOTE_DATA_GRAND_TOTALS_FOOTER", "Quotes"),
                'type' => 'quote-data-grand-totals-footer',
                'image' => 'quote-data-grand-totals-footer',
            ),
        ), $views);

        return $views;
    }

    public function getLayouts()
    {
        $layouts = parent::getLayouts();

        unset($layouts[translate("LBL_QUOTE_DATA_GRAND_TOTALS_HEADER", "Quotes")]);
        unset($layouts[translate("LBL_QUOTE_DATA_GRAND_TOTALS_FOOTER", "Quotes")]);

        return $layouts;
    }
}
