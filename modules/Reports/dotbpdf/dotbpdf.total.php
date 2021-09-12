<?php



class ReportsDotbpdfTotal extends ReportsDotbpdfReports
{
    function display(){
        global $locale;
    
        //Create new page
        $this->AddPage();
        
        $this->bean->clear_results();
        $this->bean->run_total_query();
    
        $total_header_row = $this->bean->get_total_header_row(true);
        $total_row = $this->bean->get_summary_total_row(true);
    
        $item = array();
        $count = 0;
        for($j=0; $j < sizeof($total_header_row); $j++) {
          $label = $total_header_row[$j];
          $value = $total_row['cells'][$j];
          $item[$count][$label] = $value;
        }
        
        $this->writeCellTable($item, $this->options);
    }
}


