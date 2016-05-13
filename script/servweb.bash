#!/bin/bash

testcurl=`curl -sL -w "%{http_code}\\n" "54.144.23.166" -o /dev/null`
if [ "$testcurl" = "200" ];
then
	echo $?
	echo OK
	/usr/bin/php curl.php
	rm result.json
	rm curl.php
else
	echo connexion failed
	/bin/bash servweb.bash
	rm curl.php
fi
