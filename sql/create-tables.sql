CREATE TABLE Users
(
UserID INT unsigned not null auto_increment,
PRIMARY KEY(UserID),
Username VARCHAR(18) not null,
Password VARCHAR(32) not null,
PrivEmail VARCHAR(60) not null,
PubEmail VARCHAR(60),
Userinfo TEXT(300),
Usergroup TINYINT(3) not null,
Joindate DATETIME not null
);

CREATE TABLE Thread
(
ThreadID INT unsigned not null auto_increment,
PRIMARY KEY(ThreadID),
Title VARCHAR(40) not null,
Tag1 INT unsigned not null,
Tag2 INT unsigned,
Tag3 INT unsigned,
Tag4 INT unsigned,
Creator INT unsigned not null,
MessageCount INT unsigned not null,
Lastpost DATETIME not null
);

CREATE TABLE Message
(
MessageID INT unsigned not null auto_increment,
PRIMARY KEY(MessageID),
Message TEXT(1000) not null,
Thread INT unsigned not null,
Creator INT unsigned not null,
Deleted TINYINT(1) not null,
Postdate DATETIME not null
);

CREATE TABLE Tag
(
TagID INT unsigned not null auto_increment,
PRIMARY KEY(TagID),
Tagname VARCHAR(20) not null,
Tagdescription VARCHAR(200)
);