#!/bin/bash

touch /tmp/pid_EMOTECHANGE


red (){
	DATA=`diff /var/www/html/img/MOCHI_BLINK1_3.gif /var/www/html/img/change.gif`
	[[ ! -z $DATA ]] && cp /var/www/html/img/MOCHI_BLINK1_3.gif /var/www/html/img/change.gif
}
green (){
	DATA=`diff /var/www/html/img/MOCHI_SPEAKING1_3.gif /var/www/html/img/change.gif`
	[[ ! -z $DATA ]] && cp /var/www/html/img/MOCHI_SPEAKING1_3.gif /var/www/html/img/change.gif
}
blue (){
	DATA=`diff /var/www/html/img/MOCHI_THINKING1_3.gif /var/www/html/img/change.gif`
	[[ ! -z $DATA ]] && cp /var/www/html/img/MOCHI_THINKING1_3.gif /var/www/html/img/change.gif
}






while true 
	do
		DATA=`tail  -n2 /tmp/log_jarvis_discuss | head -n1 | sed "s,\x1B\[[0-9;]*[a-zA-Z],,g"`

		if [[ ! -z "`echo ${DATA} | grep 'Waiting to hear'`" ]]
			then
				red 
			else

				NDATA=`tail  -n1 /tmp/log_jarvis_discuss | sed "s,\x1B\[[0-9;]*[a-zA-Z],,g"`
				if [[ ! -z `echo $NDATA | grep "^esteban"` ]]
					then
						blue &
					else
						green &
				fi
				
 
		fi
		sleep 0.2
				

done
		
