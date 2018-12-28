# Src_Code 个人MVC框架
## 1、框架结构
    apps       web应用目录
    classlib   第三方类库
    config     配置文件目录
    public     框架入口及公共资源目录
    resources  临时资源目录
    routes     路由配置
    system     框架核心目录
    vendor     composer扩展目录

## 2、Apache配置
Apache配置

    <VirtualHost *:80>
        ServerAdmin test.srcode.com
        DocumentRoot "/WebServer/htdocs/Src_Code/public/"
        ServerName test.srcode.com
        ErrorLog "/WebServer/htdocs/Src_Code/public/error.com-error_log"
        CustomLog "/WebServer/htdocs/Src_Code/public/Custom.com-access_log" common
        <IfModule mod_rewrite.c>
             RewriteEngine On
             RewriteCond %{DOCUMENT_ROOT}%{REQUEST_FILENAME} !-f
             RewriteCond %{REQUEST_FILENAME} !-d
             RewriteRule ^(.*)$ /index.php [PT,L]
        </IfModule>
       <Directory "/WebServer/htdocs/Src_Code/public/">
           Options FollowSymLinks ExecCGI
           AllowOverride All
           Order allow,deny
           Allow from all
           Require all granted
       </Directory>
    </VirtualHost>


## 3、Nginx配置
Nginx配置

    server {
        listen       80;
        server_name  test.srcode.cn;

        #charset koi8-r;
        #nginx 日志存放目录

        location / {
            root   /WebServer/htdocs/Src_Code/public/;
            index  index.html index.htm index.php;
            if (!-e $request_filename)
            {
                rewrite ^(.*)$ /index.php/$1 last;
            }
        }

        # 错误状态码重定义到 错误显示页
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   /WebServer/htdocs/Src_Code/public//;
        }

        location ~ \.php$ {
            root           /WebServer/htdocs/Src_Code/public/;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  /$document_root$fastcgi_script_name;
            include        fastcgi_params;
        }
    }
