#!/bin/bash

# 启动MariaDB
mysqld_safe &

# 等待MySQL完全启动
echo "等待数据库启动..."
for i in $(seq 1 20); do
    if mysqladmin ping -u root --silent 2>/dev/null; then
        echo "数据库已启动"
        break
    fi
    sleep 2
done

# 直接执行SQL创建表和数据
mysql -u root <<SQL
ALTER USER 'root'@'localhost' IDENTIFIED BY 'rootroot';
FLUSH PRIVILEGES;
CREATE DATABASE IF NOT EXISTS ilove;
USE ilove;

CREATE TABLE IF NOT EXISTS UsErS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    paSsWoRd VARCHAR(50) NOT NULL
);

INSERT INTO UsErS (username, paSsWoRd) VALUES
('john_smith', 'js199203'),
('sarah_jones', 'sj@2021'),
('emily_davis', 'ed880512'),
('michael_brown', 'mb#6688'),
('jessica_wilson', 'jw2023'),
('david_miller', 'dm198701'),
('ashley_moore', 'am@12345'),
('james_taylor', 'jt7709'),
('daniel_anderson', 'da2022'),
('admin', '47829Edks67'),
('olivia_thomas', 'ot#9988'),
('matthew_jackson', 'mj199506'),
('sophia_white', 'sw@2020'),
('christopher_harris', 'ch8812'),
('emma_martin', 'em2021'),
('andrew_garcia', 'ag#5566'),
('joshua_martinez', 'jm199308'),
('hack', 'iloveyou');
SQL

echo "数据库初始化完成！"

# 启动Apache
exec apache2-foreground