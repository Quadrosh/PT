#user 'psihotera' virtual host 'cp.psihotera.ru' configuration file
<VirtualHost 82.146.47.91:80>
	ServerName cp.psihotera.ru
	AddDefaultCharset UTF-8
	AssignUserID psihotera psihotera
	DocumentRoot /var/www/psihotera/data/www/psihotera.ru/yapp/backend/web

	<Directory /var/www/psihotera/data/www/psihotera.ru/yapp/backend/web>
		Options +Includes -ExecCGI
		<IfModule php5_module>
			php_admin_flag engine on
		</IfModule>
		<IfModule php7_module>
			php_admin_flag engine on
		</IfModule>
 		RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php
        DirectoryIndex index.php
	</Directory>

	ServerAdmin quadrosh@gmail.com
	CustomLog /var/www/httpd-logs/cp.psihotera.ru.access.log combined
	ErrorLog /var/www/httpd-logs/cp.psihotera.ru.error.log
	ServerAlias www.cp.psihotera.ru
	DirectoryIndex index.html index.php
	<FilesMatch "\.ph(p[3-5]?|tml)$">
		SetHandler application/x-httpd-php
	</FilesMatch>
	<FilesMatch "\.phps$">
		SetHandler application/x-httpd-php-source
	</FilesMatch>
	<IfModule php5_module>
		php_admin_value sendmail_path "/usr/sbin/sendmail -t -i -f webmaster@cp.psihotera.ru"
		php_admin_value upload_tmp_dir "/var/www/psihotera/data/mod-tmp"
		php_admin_value session.save_path "/var/www/psihotera/data/mod-tmp"
		php_admin_value open_basedir "/var/www/psihotera/data:."
	</IfModule>
	<IfModule php7_module>
		php_admin_value sendmail_path "/usr/sbin/sendmail -t -i -f webmaster@cp.psihotera.ru"
		php_admin_value upload_tmp_dir "/var/www/psihotera/data/mod-tmp"
		php_admin_value session.save_path "/var/www/psihotera/data/mod-tmp"
		php_admin_value open_basedir "/var/www/psihotera/data:."
	</IfModule>
</VirtualHost>

