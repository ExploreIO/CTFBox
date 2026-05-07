-- 创建数据库
CREATE DATABASE IF NOT EXISTS ilove;

-- 使用数据库
USE ilove;

-- 创建UsErS表
CREATE TABLE IF NOT EXISTS UsErS (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    paSsWoRd VARCHAR(50) NOT NULL
);

-- 插入18条模拟数据
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