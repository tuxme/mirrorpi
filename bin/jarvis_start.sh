#!/bin/bash

#if [[ ! -f /tmp/pulseOK ]]

#        then
 #               if [[ -z `ps axf| grep pulseaudio| grep -v grep ` ]]
   #                     then
  #                             pulseaudio -D
   #             fi
#fi
#touch /tmp/pulseOK




if [[ "$1" == 'NOW' ]]
	then
		echo "now"
	else
		sleep 10
fi

if [[ -z `ps axf| grep ZICMIRROR | grep -v grep` ]] && [[ ! -f /tmp/lock_screen_ZICMIRROR ]]
	then
		/usr/bin/screen -d -m -S ZICMIRROR "/home/pi/bin/start_zic.sh"
		sleep 5
fi



if [[ -z `ps axf| grep MAGICMIRROR | grep -v grep` ]] && [[ ! -f /tmp/lock_screen_MAGICMIRROR ]]
	then
		/usr/bin/screen -d -m -S MAGICMIRROR "/home/pi/bin/start_mirror.sh"
		sleep 5
fi
if [[ -z `ps axf| grep EMOTECHANGE | grep -v grep` ]] && [[ ! -f /tmp/lock_screen_EMOTECHANGE ]] 
	then
		/usr/bin/screen -d -m -S EMOTECHANGE "/home/pi/bin/emote_change.sh"
		sleep 5
fi

if [[ -z `ps axf| grep RESTART_SERV | grep -v grep` ]] && [[ ! -f /tmp/lock_screen_RESTART_SERV ]]
	then
		/usr/bin/screen -d -m -S RESTART_SERV "/home/pi/bin/restart_serv.sh"
		sleep 5
fi
if [[ -z `ps axf| grep KEEP_NETW | grep -v grep` ]] && [[ ! -f /tmp/lock_screen_KEEP_NETW ]]
	then
		/usr/bin/screen -d -m -S KEEP_NETW "/home/pi/bin/keep_network.sh"
		sleep 5
fi
if [[ -z `ps axf| grep KEEP_NEWS_RSS | grep -v grep` ]] && [[ ! -f /tmp/lock_screen_KEEP_NEWS_RSS ]]
	then
		/usr/bin/screen -d -m -S KEEP_NEWS_RSS "/home/pi/bin/news_generate.sh"
		sleep 5
fi
#sudo wpa_supplicant -B -D wext -i wlan0 -c /etc/wpa_supplicant/wpa_supplicant.conf
#sudo dhclient wlan0

if [[ -z `ps axf| grep JARVIS| grep -v grep` ]]  && [[ ! -f /tmp/lock_screen_JARVIS ]]
	then
		/usr/bin/screen -d -m -S JARVIS "/home/pi/bin/screen_jarvis_start.sh"
		sleep 3
		if [[ "$1" == 'NOW' ]]
			then
				echo "now"
			else
				sleep 10
		fi


fi

