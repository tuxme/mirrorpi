#!/bin/bash


touch /tmp/pid_MAGICMIRROR

export DISPLAY=:0
mirrormidori -e Fullscreen -a http://localhost
