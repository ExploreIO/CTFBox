# --- 阶段一：构建阶段 ---
FROM alpine:latest AS builder
COPY start.sh /start.sh
RUN chmod +x /start.sh

# --- 阶段二：最终镜像 ---
FROM php:7.4-apache

# --- 1. 环境变量 ---
ENV DB_HOST=127.0.0.1
ENV DB_USER=root
ENV DB_PASSWORD=rootroot
ENV DB_NAME=ilove

# --- 2. 替换阿里云源 ---
RUN sed -i 's/deb.debian.org/mirrors.aliyun.com/g' /etc/apt/sources.list && \
    sed -i 's/security.debian.org/mirrors.aliyun.com\/debian-security/g' /etc/apt/sources.list && \
    apt-get update \
    && apt-get install -y --no-install-recommends \
       mariadb-server \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# --- 3. 复制PHP文件到Web目录 ---
WORKDIR /var/www/html
COPY admin.php check.php config.php index.php logs.php ./
COPY reset_password.php show_logs.php show_users.php ./

# --- 4. logs.txt放到Web目录外 ---
COPY logs.txt /var/www/logs.txt

# --- 5. 复制启动脚本 ---
COPY --from=builder /start.sh /usr/local/bin/start.sh
RUN chmod 700 /usr/local/bin/start.sh

# --- 6. 配置权限 ---
RUN mkdir -p /var/run/mysqld && \
    chown -R mysql:mysql /var/run/mysqld && \
    chown -R www-data:www-data /var/www/html /var/www/logs.txt

RUN a2enmod rewrite

EXPOSE 80
CMD ["sh", "/usr/local/bin/start.sh"]