<?php
//ini_set('display_errors',1);
//ini_set('display_startup_errors',0);
//error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);


if (!defined('dotbEntry')) define('dotbEntry', true);
if (!file_exists('cache')) mkdir('cache');
if (!file_exists('upload')) mkdir('upload');
if (!file_exists('.htaccess')) {
    file_put_contents('.htaccess', '# BEGIN DOTBCRM RESTRICTIONS
        # Fix mimetype for logo.svg (SP-1395)
        AddType     image/svg+xml     .svg
        AddType     application/json  .json
        AddType     application/javascript  .js

        <IfModule mod_rewrite.c>
            Options +FollowSymLinks
            RewriteEngine On
            RewriteBase /
            RewriteRule (?i)\.git - [F]
            RewriteRule (?i)\.log$ - [F]
            RewriteRule (?i)^bin/ - [F]
            RewriteRule (?i)^cache/diagnostic/ - [F]
            RewriteRule (?i)^composer\.(json|lock)$ - [F]
            RewriteRule (?i)^cron\.php$ - [F]
            RewriteRule (?i)^custom/blowfish/ - [F]
            RewriteRule (?i)^dist/ - [F]
            RewriteRule (?i)^emailmandelivery\.php$ - [F]
            RewriteRule (?i)^files\.md5$ - [F]
            RewriteRule (?i)^src/ - [F]
            # RewriteRule (?i)^upload/ - [F]
            RewriteRule (?i)^vendor/(?!ytree.*\.(css|gif|js|png)$) - [F]
            RewriteRule (?i)^(cache|clients|data|examples|include|jssource|log4php|metadata|ModuleInstall|modules|soap|xtemplate)/.*\.(php|tpl)$ - [F]

            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^rest/(.*)$ api/rest.php?__dotb_url=$1 [L,QSA]
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^cache/api/metadata/lang_(.._..)_(.*)_public(_ordered)?\.json$ rest/v10/lang/public/$1?platform=$2&ordered=$3 [N,QSA,DPI]

            RewriteRule ^cache/api/metadata/lang_(.._..)_([^_]*)(_ordered)?\.json$ rest/v10/lang/$1?platform=$2&ordered=$3 [N,QSA,DPI]
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^cache/Expressions/functions_cache(_debug)?.js$ rest/v10/ExpressionEngine/functions?debug=$1 [N,QSA,DPI]
            RewriteRule ^cache/jsLanguage/(.._..).js$ index.php?entryPoint=jslang&module=app_strings&lang=$1 [L,QSA,DPI]
            RewriteRule ^cache/jsLanguage/(\w*)/(.._..).js$ index.php?entryPoint=jslang&module=$1&lang=$2 [L,QSA,DPI]
            RewriteRule ^portal/(.*)$ portal2/$1 [L,QSA]
            RewriteRule ^portal$ portal/? [R=301,L]
        </IfModule>

        <IfModule mod_mime.c>
            AddType application/x-font-woff .woff
        </IfModule>
        <FilesMatch "\.(jpg|png|gif|js|css|ico|woff|svg)$">
                <IfModule mod_headers.c>
                        Header set ETag ""
                        Header set Cache-Control "max-age=2592000"
                        Header set Expires "01 Jan 2112 00:00:00 GMT"
                </IfModule>
        </FilesMatch>
        <IfModule mod_expires.c>
                ExpiresByType text/css "access plus 1 month"
                ExpiresByType text/javascript "access plus 1 month"
                ExpiresByType application/x-javascript "access plus 1 month"
                ExpiresByType image/gif "access plus 1 month"
                ExpiresByType image/jpg "access plus 1 month"
                ExpiresByType image/png "access plus 1 month"
                ExpiresByType application/x-font-woff "access plus 1 month"
                ExpiresByType image/svg "access plus 1 month"
        </IfModule>
        # END DOTBCRM RESTRICTIONS');
}
define('ENTRY_POINT_TYPE', 'gui');
include('include/MVC/preDispatch.php');
$startTime = microtime(true);
require_once('include/entryPoint.php');
ob_start();
DotbAutoLoader::requireWithCustom('include/MVC/DotbApplication.php');
$appClass = DotbAutoLoader::customClass('DotbApplication');
$app = new $appClass();
$app->execute();
