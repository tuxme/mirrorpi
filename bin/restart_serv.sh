#!/bin/bash

while true 
	do
		sleep 30
		JARVIS=`ps axf| grep -E "JARVIS"| grep -v grep | wc -l`
		HAL=`ps axf| grep -E "HAL"| grep -v grep | wc -l`
		RES=$((HAL+JARVIS))
		if [[ "$RES" != "2" ]]
			then
				/home/pi/bin/jarvis_start.sh NOW
		fi

	done
