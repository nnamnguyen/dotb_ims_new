{*

*}


<!-- BEGIN: main -->
<graphData title="{GRAPHTITLE}">

        <yData defaultAltText="{Y_DEFAULT_ALT_TEXT}">
                <!-- BEGIN: row -->
                <dataRow title="{Y_ROW_TITLE}" endLabel="{Y_ROW_ENDLABEl}">
                        <!-- BEGIN: bar -->
                        <bar id="{Y_BAR_ID}" totalSize="{Y_BAR_SIZE}" altText="{Y_BAR_ALTTEXT}" url="{Y_BAR_URL}"/>
                        <!-- END: bar -->
                </dataRow>
                <!-- END: row -->
        </yData>
        <xData min="{XMIN}" max="{XMAX}" length="{XLENGTH}" kDelim="{XKDELIM}" prefix="{XPREFIX}" suffix="{XSUFFIX}"/>
        <colorLegend status="on">
                <mapping id="'.$outcome.'" name="'.$outcome_translation.'" color="'.$color.'"/>
        </colorLegend>
        <graphInfo><![CDATA[{GRAPH_DATA}]]></graphInfo>
        <chartColors {COLOR_DEFS}/>
</graphData>
<!-- END: main -->
