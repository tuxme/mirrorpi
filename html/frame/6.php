<!doctype html>
<html lang="en">



 <head>
    <meta http-equiv="refresh" content="300"> <!-- See the difference? -->
  </head>
    <style type="text/css">
@font-face { font-family: Delicious; src: url('../fontnews.otf'); } @font-face { font-family: Delicious; font-weight: bold; src: url('../fontnews.otf'); }
body {
  font-family: 'Delicious', serif;
  font-size: 60px;
}



.example1 {
 height: 50px;	
 overflow: hi	dden;
 position: relative;
}
.example1 h3 {
 font-size: 3em;
 color: limegreen;
 position: absolute;
 width: 100%;
 height: 100%;
 margin: 0;
 line-height: 50px;
 text-align: center;
 /* Starting position */
 -moz-transform:translateX(100%);
 -webkit-transform:translateX(100%);	
 transform:translateX(100%);
 /* Apply animation to this element */	
 -moz-animation: example1 15s linear infinite;
 -webkit-animation: example1 15s linear infinite;
 animation: example1 15s linear infinite;
}
/* Move it (define the animation) */
@-moz-keyframes example1 {
 0%   { -moz-transform: translateX(100%); }
 100% { -moz-transform: translateX(-100%); }
}
@-webkit-keyframes example1 {
 0%   { -webkit-transform: translateX(100%); }
 100% { -webkit-transform: translateX(-100%); }
}
@keyframes example1 {
 0%   { 
 -moz-transform: translateX(100%); /* Firefox bug fix */
 -webkit-transform: translateX(100%); /* Firefox bug fix */
 transform: translateX(100%); 		
 }
 100% { 
 -moz-transform: translateX(-100%); /* Firefox bug fix */
 -webkit-transform: translateX(-100%); /* Firefox bug fix */
 transform: translateX(-100%); 
 }
}


</style> </head>

  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="author" content="">
  </head>
  <body>

<div align='left'>
                <font color="white">
<?php

function iCalDecoder($file) {
        $ical = file_get_contents($file);
        preg_match_all('/(BEGIN:VEVENT.*?END:VEVENT)/si', $ical, $result, PREG_PATTERN_ORDER);
        for ($i = 0; $i < count($result[0]); $i++) {
            $tmpbyline = explode("rn", $result[0][$i]);

            foreach ($tmpbyline as $item) {
                $tmpholderarray = explode(":",$item);
                if (count($tmpholderarray) >1) {
                    $majorarray[$tmpholderarray[0]] = $tmpholderarray[1];
                }
            }

            if (preg_match('/SUMMARY:(.*)?TRANSP/si', $result[0][$i], $regs)) {
                $majorarray['DESCRIPTION'] = str_replace("  ", " ", str_replace("\r\n", "", $regs[1]));
                $majorarray['DESCRIPTION'] = str_replace("  ", " ", str_replace("TRANSP", "", $majorarray['DESCRIPTION']));
                $majorarray['DESCRIPTION'] = str_replace("  ", " ", str_replace(":", "", $majorarray['DESCRIPTION']));

            }
		if (preg_match('/DTSTART(.*)DTEND/si', $result[0][$i], $regs)) {
                $majorarray['MDATE'] = str_replace("  ", " ", str_replace("\r\n", "", $regs[1]));
                $majorarray['MDATE'] = str_replace("  ", " ", str_replace(":", "", $majorarray['MDATE']));
                $majorarray['MDATE'] = str_replace("  ", " ", str_replace(";VALUE=DATE", "", $majorarray['MDATE']));
            }
            $icalarray[] = $majorarray;
            unset($majorarray);

        }
        return $icalarray;
}

$max=9;

echo "<marquee behavior='scroll' direction='left' scrollamount='15'>";

$events = iCalDecoder("https://calendar.google.com/calendar/ical/XXXXXXXX%40gmail.com/private-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/basic.ics");
foreach($events as $event){


    $date = $event['MDATE'];//get date from ical
    $date = str_replace('T', '', $date);//remove T
    $date = str_replace('Z', '', $date);//remove Z
    $d    = date('d', strtotime($date));//get date day
    $m    = date('m', strtotime($date));//get date month
    $y    = date('Y', strtotime($date));//get date year
    $now = date('Y-m-d');//current date and time
    $eventdate = date('Y-m-d G:i:s', strtotime($date));//user friendly date



    if($eventdate > $now){
	if ($max != 0) {
        	echo "[$eventdate] : "  .$event['DESCRIPTION']. " -|- ";
		$max=$max-1;
	}
    }
}
echo "</marquee>";

?>



</div>
