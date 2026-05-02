#!/bin/bash

# 创建 MySQL 需要的目录
mkdir -p /run/mysqld
chown mysql:mysql /run/mysqld

# 启动 MySQL
mysqld --user=root &

# 等待 MySQL 就绪
until mysqladmin ping -h localhost --silent; do
    sleep 1
done

# 初始化数据库
mysql -u root < /init.sql

# 设置 root 密码
mysql -u root -e "SET PASSWORD FOR 'root'@'localhost' = PASSWORD('rootroot'); FLUSH PRIVILEGES;"

# 启动 Apache
exec apache2-foreground