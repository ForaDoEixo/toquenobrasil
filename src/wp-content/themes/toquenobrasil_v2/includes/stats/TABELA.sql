
CREATE TABLE `tnb2`.`wp_tnb_stats` (
`ID` INT NOT NULL AUTO_INCREMENT,
`day` DATE NOT NULL ,
`count` INT NOT NULL DEFAULT '0',
`type` TEXT NOT NULL ,
`object_id` INT NOT NULL ,
PRIMARY KEY ( `ID` )
) ENGINE = MYISAM ;