<!--

/*********************************************************************************
 * Header: /cvsroot/dotbcrm/dotbcrm/modules/Products/ListView.html,v 1.4 2004/07/02 07:02:27 dotbclint Exp {APP.LBL_LIST_CURRENCY_SYM}
 ********************************************************************************/
-->

<body style="margin: 0px;">
<?php
global $theme, $mod_strings;

insert_popup_header($theme);

$dotbteam = array( 'Julian Ostrow', 'Lam Huynh', 'Majed Itani', 'Joey Parsons', 'Ajay Gupta', 'Jason Nassi', 'Andy Dreisch', 'Roger Smith', 'Liliya Bederov', 'Sadek Baroudi', 'Franklin Liu', 'Jennifer Yim', 'Sujata Pamidi', 'Eddy Ramirez', 'Jenny Gonsalves', 'Collin Lee', 'David Wheeler', 'John Mertic', 'Ran Zhou', 'Shine Ye','Emily Gan','Randy Lee','Eric Yang','Oliver Yang','Andreas Sandberg');
switch($_REQUEST['style']){
	case 'rev':
			$dotbteam = array_map('strrev', $dotbteam);
			break;
	case 'rand':
			shuffle($dotbteam);
			break;
	case 'dec':
			$dotbteam = array_reverse($dotbteam);
			break;
	case 'sort':
			 sort($dotbteam);
			 break;
	case 'rsort':
			 rsort($dotbteam);
			 break;
			 
}

$founders = array("<b>" . $mod_strings['LBL_FOUNDERS'] . ":</b>", 'John Roberts', 'Clint Oram', 'Jacob Taylor');

$body =  implode('<br>', $founders) . "<br><br><b>" . $mod_strings['LBL_DEVELOPERS'] . ":</b><br>" . implode('<br>', $dotbteam);
?>
<script>
	var user_notices = new Array();
	var delay = 25000
	var index = 0;
	var lastIndex = 0;
	var scrollerHeight=200
	var bodyHeight = ''
	var scrollSpeed = 1;
	var curTeam = 'all';
	var scrolling = true;


	


	function stopNotice(){
			scrolling = false;
	}
	function startNotice(){
			scrolling = true;
	}
	function scrollNotice(){

		if(scrolling){
		
		var body = document.getElementById('NOTICEBODY')
		var daddy = document.getElementById('daddydiv')

		if(parseInt(body.style.top) > bodyHeight *-1 ){

			body.style.top = (parseInt(body.style.top) - scrollSpeed) + 'px';

		}else{
			
			body.style.top =scrollerHeight + "px"
		}
		}

		setTimeout("scrollNotice()", 50);

	}
	function nextNotice(){



		body = document.getElementById('NOTICEBODY');
		if(scrolling){
				body.style.top = scrollerHeight/2 +'px'
				bodyHeight= parseInt(body.offsetHeight);
		}
				

		}
	


</script>
<div style="width: 300px; height: 400px; text-align: center; border:0; padding: 5px;">
<div id='daddydiv' style="position:relative;width=100%;height:350px;overflow:hidden">
<div id='NOTICEBODY' style="position:absolute;left:0px;top:0px;width:100%;z-index: 1; text-align: left;">
<?php echo $body; ?>
</div>
</div>
<script>
if(window.addEventListener){
	window.addEventListener("load", nextNotice, false);
	window.addEventListener("load", scrollNotice, false);
}else{
	window.attachEvent("onload", nextNotice);
	window.attachEvent("onload", scrollNotice);
}
</script>


