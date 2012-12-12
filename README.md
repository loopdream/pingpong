pingpong
========

 
Add local domain to your hosts/hosts.sc files

<code>192.168.56.123	local.makeday.com</code>


Add following to /etc/apache2/sites-available

<code>
<VirtualHost *:80>
	ServerAdmin david@setr.co.uk
	ServerName local.makeday.com
	DocumentRoot /home/totoro/htdocs/pingpong/public
	<Directory /home/totoro/htdocs/pingpong/pulic>
		Options Indexes FollowSymLinks MultiViews
		AllowOverride All
		Allow from all
	</Directory>
	ErrorLog /home/totoro/logs/pingpong.error.log
	LogLevel warn
	CustomLog /home/totoro/logs/pinpong.access.log combined
</VirtualHost>
</code>