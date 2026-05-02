FROM php:7.4-apache

# 换国内源（加速下载）
RUN sed -i 's/deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list && \
    sed -i 's/security.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list

# 安装 MySQL
RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y \
    default-mysql-server \
    default-mysql-client \
    && rm -rf /var/lib/apt/lists/*

# 安装 mysqli 扩展
RUN docker-php-ext-install mysqli

# 开启错误显示
RUN echo "display_errors = On" >> /usr/local/etc/php/php.ini && \
    echo "error_reporting = E_ALL" >> /usr/local/etc/php/php.ini

WORKDIR /var/www/html

COPY config.php index.php logged-in.php new_user.php flag.php /var/www/html/
COPY init.sql /init.sql
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]