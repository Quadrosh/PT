#user 'psihotera' virtual host 'psihotera.ru' configuration file
<VirtualHost 82.146.47.91:80>
	ServerName psihotera.ru
	AddDefaultCharset off
	AssignUserID psihotera psihotera
	DocumentRoot /var/www/psihotera/data/www/psihotera.ru/yapp/frontend/web
	<Directory /var/www/psihotera/data/www/psihotera.ru/yapp/frontend/web>
		<IfModule php5_module>
			php_admin_flag engine on
		</IfModule>
		<IfModule php7_module>
			php_admin_flag engine on
		</IfModule>
		Options +Includes +ExecCGI
		RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
        DirectoryIndex index.php
	</Directory>

	ServerAdmin webmaster@psihotera.ru
	ServerAlias www.psihotera.ru
	DirectoryIndex index.html index.php
	ScriptAlias /cgi-bin/ /var/www/psihotera/data/www/psihotera.ru/cgi-bin/
	<FilesMatch "\.ph(p[3-5]?|tml)$">
		SetHandler application/x-httpd-php
	</FilesMatch>
	<FilesMatch "\.phps$">
		SetHandler application/x-httpd-php-source
	</FilesMatch>
	<IfModule php5_module>
		php_admin_value sendmail_path "/usr/sbin/sendmail -t -i -f webmaster@psihotera.ru"
		php_admin_value upload_tmp_dir "/var/www/psihotera/data/mod-tmp"
		php_admin_value session.save_path "/var/www/psihotera/data/mod-tmp"
		php_admin_value open_basedir "/var/www/psihotera/data:."
	</IfModule>
	<IfModule php7_module>
		php_admin_value sendmail_path "/usr/sbin/sendmail -t -i -f webmaster@psihotera.ru"
		php_admin_value upload_tmp_dir "/var/www/psihotera/data/mod-tmp"
		php_admin_value session.save_path "/var/www/psihotera/data/mod-tmp"
		php_admin_value open_basedir "/var/www/psihotera/data:."
	</IfModule>
	CustomLog /var/www/httpd-logs/psihotera.ru.access.log combined
	ErrorLog /var/www/httpd-logs/psihotera.ru.error.log
</VirtualHost>

