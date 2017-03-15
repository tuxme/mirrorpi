#!/bin/bash


while true 
	do


		if [[ -f /tmp/news_feed.tmp ]]
			then
				rm /tmp/news_feed.tmp
		fi


		LISTE="http://fr.ubergizmo.com/feed|Ubergizmo
		http://www.linternaute.com/cinema/rss/|l\'internaute_cinema
		http://www.linternaute.com/actualite/rss/|l\'internaute_Actu
		http://www.linternaute.com/hightech/rss/|l\'internaute_hightech
		feeds2.feedburner.com/LeJournalduGeek|JDG"

		for DATA in $LISTE

			do

				URL=`echo $DATA| cut -d"|" -f1`
				SITE=`echo $DATA| cut -d"|" -f2 | sed "s#_# #g"`
				rsstail -i3 -u $URL | sed "s#Title: #<font color='white'><p style='font-size:28px'>${SITE}\&nbsp;</p><p style='font-size:20px'>#g" | sed "s#\$#\&nbsp;</p></font>#g" | tee -a /tmp/news_feed.tmp &
				sleep 3
				killall rsstail
			done


		cp /tmp/news_feed.tmp /tmp/news_feed
		sleep 3600
	done

