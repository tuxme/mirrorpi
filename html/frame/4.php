 <head>
    <meta http-equiv="refresh" content="60"> <!-- See the difference? -->
  </head>
    <style type="text/css">
@font-face { font-family: Delicious; src: url('../font.otf'); } @font-face { font-family: Delicious; font-weight: bold; src: url('../font.otf'); }
body {
  font-family: 'Delicious', serif;
  font-size: 18px;
}
</style> </head>

<div align='left'>
<table width='100%'>
	<tr>
		<th align='left' >
		<font color="white">
		<h1>TOULON</h1>
		<?php
		$last_line = system('curl -sq -A "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.112 Safari/534.30" "http://wttr.in/toulon" |head -n305| grep -v "Weather for City"', $retval);
		print "$last_line";
		?>
		</font>
		</th>

		<th align='left'>
		<font color="white">
		<br><h1>AIX en PCE</h1> 
		<?php
		$last_line = system('curl -sq -A "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.112 Safari/534.30" "http://wttr.in/aix-en-provence" |head -n305| grep -v "Weather for City"', $retval);
		print "$last_line";
		?>
		</font>
		</th>
	</tr>
</table>

