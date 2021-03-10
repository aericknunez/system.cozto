CREATE TABLE `system_version` (
  `id` int(6) NOT NULL,
  `version` varchar(10) NOT NULL,
  `fecha` varchar(25) NOT NULL,
  `hora` varchar(25) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `time` int(12) NOT NULL,
  `td` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `system_version`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `system_version`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;