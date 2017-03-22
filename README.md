# IngéQuiz

## Installation ##

```
composer install
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console assets:install

php bin/console fos:user:create admin admin@ingequiz.fr admin
php bin/console fos:user:activate admin
php bin/console fos:user:promote admin ROLE_SUPER_ADMIN
 ```

### Commandes utiles ###

```
php bin/console doctrine:database:drop --force
php bin/console cache:clear [--env=prod]
php bin/console server:start
```

### Configuration host

```
 <VirtualHost *:80>
    ServerName contestmanager.dev
    DocumentRoot C:\wamp\www\contestmanager\web
    SetEnv APPLICATION_ENV "development"
    <Directory C:\wamp\www\contestmanager\web>
        DirectoryIndex app_dev.php
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
</VirtualHost>
```

### .htaccess

Changer app_dev.php par app.php pour passer en production
```
DirectoryIndex app_dev.php
<IfModule mod_rewrite.c>
    RewriteEngine On

    RewriteCond %{REQUEST_URI}::$1 ^(/.+)/(.*)::\2$
    RewriteRule ^(.*) - [E=BASE:%1]

    RewriteCond %{ENV:REDIRECT_STATUS} ^$
    RewriteRule ^app\.php(/(.*)|$) %{ENV:BASE}/$2 [R=301,L]
    RewriteCond %{REQUEST_FILENAME} -f
    RewriteRule .? - [L]

    RewriteRule .? %{ENV:BASE}/app_dev.php [L]
</IfModule>
<IfModule !mod_rewrite.c>
    <IfModule mod_alias.c>
        RedirectMatch 302 ^/$ /app_dev.php/
    </IfModule>
</IfModule>
```
