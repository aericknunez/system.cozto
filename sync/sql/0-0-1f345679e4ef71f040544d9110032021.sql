  CREATE TABLE `login_version` (
  `id` int(6) NOT NULL,
  `version` varchar(10) NOT NULL,
  `fecha` varchar(25) NOT NULL,
  `hora` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `login_version` (`id`, `version`, `fecha`, `hora`) VALUES
(1, 1.0, '10-03-2021', '13:59:45');

ALTER TABLE `login_version`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `login_version`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
