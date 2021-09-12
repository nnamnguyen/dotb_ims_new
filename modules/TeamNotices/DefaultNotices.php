<?php



$notices = array(
);


foreach($notices as $notice){
	$teamNotice = BeanFactory::newBean('TeamNotices');
	$teamNotice->name = $notice['name'];
	$teamNotice->description = $notice['description'];
	if(!empty($notice['url'])){
		$teamNotice->url = $notice['url'];
		$teamNotice->url_title = 'View '.$notice['name'];
	}
	$teamNotice->date_start = $timedate->nowDate();
	$teamNotice->date_end = $timedate->asUserDate($timedate->getNow()->get('+1 week'));
	$teamNotice->status = 'Visible';
	$teamNotice->save(false);
}

?>
