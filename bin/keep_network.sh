#!/bin/bash

while true
	do
		echo "GET /DATA/ HTTP/1.1" |netcat tuxme.net 80
		if [[ "$?" != "0" ]]
			then
				sudo dhclient wlan0
		fi
		sleep 60
	done
