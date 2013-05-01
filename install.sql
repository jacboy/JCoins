CREATE TABLE  `wcf1_statement_entrys` (
`entryID` INT NOT NULL ,
`userID` INT NOT NULL ,
`executedUserID` INT NOT NULL ,
`time` INT( 9 ) NOT NULL ,
`reason` VARCHAR( 255 ) NOT NULL ,
`sum` INT NOT NULL
) ENGINE = INNODB ;

ALTER TABLE  `wcf1_user` ADD  `jCoinsBalance` INT NOT NULL DEFAULT  '0';

CREATE TABLE  `wcf1_user_group_premium` (
`premiumGroupID` INT NOT NULL AUTO_INCREMENT ,
`groupID` INT NOT NULL ,
`jCoins` INT NOT NULL ,
`period` INT NOT NULL ,
`isDisabled` BOOL NOT NULL ,
`description` TEXT NOT NULL ,
PRIMARY KEY (  `premiumGroupID` )
) ENGINE = INNODB ;

CREATE TABLE  `wcf1_user_to_group_premium` (
`userID` INT NOT NULL ,
`premiumGroupID` INT NOT NULL ,
`until` INT NOT NULL
) ENGINE = INNODB ;