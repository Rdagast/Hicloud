#!/bin/bash
apache=`dpkg-query -W -f='${Status}\n' apache2` 
if [ "$apache" = "install ok installed" ];
then
	apt-get upgrade apache2
	php=`dpkg-query -W -f='${Status}\n' php5`
	if [ "php" = "install ok installed" ];
	then
		apt-get upgrade php5
	else
		apt-get install php5
	fi
else
	apt-get install apache2
fi
