<?php



class ReportsDotbpdfDetail_and_total extends ReportsDotbpdfReports
{
    function display(){
        global $report_modules, $app_list_strings;
        global $mod_strings, $locale;
        $this->bean->run_query();
        
        //Create new page
        $this->AddPage();
            
        $item = array();
        $header_row = $this->bean->get_header_row('display_columns', false, true, true);
        $count = 0;
    
        while($row = $this->bean->get_next_row('result', 'display_columns', false, true)) {
            for($i= 0 ; $i < sizeof($header_row); $i++) {
                $label = $header_row[$i];
                $value = '';
                if (isset($row['cells'][$i])) {
                  $value = $row['cells'][$i];
                }
                $item[$count][$label] = $value;
            }
            $count++;
        }
        $this->writeCellTable($item, $this->options);
        $this->Ln1();
        
        $this->bean->clear_results();
        
        $this->bean->run_total_query();
        $total_header_row = $this->bean->get_total_header_row();
    
        $total_row = $this->bean->get_summary_total_row();
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


