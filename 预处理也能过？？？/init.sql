CREATE DATABASE IF NOT EXISTS `user` DEFAULT CHARACTER SET utf8mb4;
USE `user`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(400) NOT NULL,
    `password` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` (`username`, `password`) VALUES
('admin',    '4dmI-n123'),
('test',     'teSt123'),
('user1',    'dasdf1'),
('guest',    'guEssst'),
('man',  'dumbo'),
('what',     'Dumb'),
('can', 'aaaaaa'),
('I',    'qunid'),
('say',   'leuluelue'),
('gugugaga',   'stupidity'),
('daodundaodun', 'genious'),
('when',   'what'),
('flag',     'flag{a7b2c9d4-e5f6-1123-890a-bcdef1234567}');