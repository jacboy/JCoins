DROP TABLE wcf1_statement_entrys;
CREATE TABLE wcf1_statement_entrys (
	entryID			INT(10) 		NOT NULL AUTO_INCREMENT PRIMARY KEY,
	userID 			INT(10),
	executedUserID		INT(10),
	time 			INT(10)			NOT NULL DEFAULT 0,
	reason 			VARCHAR(255)		NOT NULL DEFAULT '',
	link			VARCHAR(255)		NOT NULL DEFAULT '',
	sum 			INT(10) 		NOT NULL DEFAULT 0, 
	isTrashed		BOOLEAN			NOT NULL DEFAULT 0,
	isModTransfer		BOOLEAN			NOT NULL DEFAULT 0,
	KEY user (userID),
	KEY executedUser (executedUserID)
);

DROP TABLE wcf1_user_group_premium;
CREATE TABLE wcf1_user_group_premium (
	premiumGroupID		INT(10)			NOT NULL AUTO_INCREMENT PRIMARY KEY,
	groupID 		INT(10),
	jCoins 			INT(10) 		NOT NULL DEFAULT 0,
	period 			INT(10) 		NOT NULL DEFAULT 0,
	isDisabled 		TINYINT(1) 		NOT NULL DEFAULT 0,
	description		MEDIUMTEXT		NOT NULL,
	KEY userGroup (groupID)
);

ALTER TABLE  wcf1_user ADD  jCoinsBalance INT(11) NOT NULL DEFAULT '0';

-- foreign keys
ALTER TABLE wcf1_statement_entrys ADD FOREIGN KEY (executedUserID) REFERENCES wcf1_user (userID) ON DELETE SET NULL;
ALTER TABLE wcf1_statement_entrys ADD FOREIGN KEY (userID) REFERENCES wcf1_user (userID) ON DELETE CASCADE;

ALTER TABLE wcf1_user_group_premium ADD FOREIGN KEY (groupID) REFERENCES wcf1_user_group (groupID) ON DELETE CASCADE;