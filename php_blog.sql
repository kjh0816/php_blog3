DROP DATABASE IF EXISTS php_blog;

CREATE DATABASE php_blog;

USE php_blog;


CREATE TABLE `member`(
	id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	delStatus INT(1) UNSIGNED NOT NULL,
	regDate DATETIME NOT NULL,
	updateDate DATETIME NOT NULL,
	loginId CHAR(20) NOT NULL,
	loginPw CHAR(100) NOT NULL,
	`name` CHAR(20) NOT NULL,
	nickname CHAR(20) NOT NULL,
	cellphoneNo CHAR(20) NOT NULL,
	email CHAR(100) NOT NULL
);

CREATE TABLE board(
    id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    regDate DATETIME NOT NULL,
    updateDate DATETIME NOT NULL,
    memberId INT(10) UNSIGNED NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `code` VARCHAR(100) NOT NULL
);



CREATE TABLE article(
	id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	regDate DATETIME NOT NULL,
	updateDate DATETIME NOT NULL,
	memberId INT(10) UNSIGNED NOT NULL,
	boardId INT(10) UNSIGNED NOT NULL,
	title VARCHAR(100) NOT NULL,
	`body` TEXT NOT NULL
);


CREATE TABLE reply(
	id INT(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	regDate DATETIME NOT NULL,
	updateDate DATETIME NOT NULL,
	memberId INT(10) UNSIGNED NOT NULL,
	relTypeCode VARCHAR(100) NOT NULL,   # relTypeCode = 'article' 고정
	relId INT(10) UNSIGNED NOT NULL,     # relId = 게시물 id 
	`body` TEXT NOT NULL
);


INSERT INTO `member`
SET regDate = NOW(),
updateDate = NOW(),
delStatus = 0,
loginId = 'user1',
loginpw = 'user1',
`name` = '홍길동',
nickname = '길동',
cellphoneNo = '010-1234-1234',
email = 'test1@test.com';

INSERT INTO `member`
SET regDate = NOW(),
updateDate = NOW(),
delStatus = 0,
loginId = 'user2',
loginpw = 'user2',
`name` = '지후',
nickname = 'jh',
cellphoneNo = '010-1234-1234',
email = 'test1@test.com';




INSERT INTO board
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
`name` = '공지',
`code` = 'notice';

INSERT INTO board
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
`name` = '자유',
`code` = 'free';


INSERT INTO article
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
boardId = 1,
title = '제목1',
`body`= '내용1';

INSERT INTO article
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
boardId = 1,
title = '제목2',
`body`= '내용2';

INSERT INTO article
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
boardId = 1,
title = '제목3',
`body`= '내용3';

INSERT INTO article
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
boardId = 1,
title = '제목4',
`body`= '내용4';



INSERT INTO reply
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
relTypeCode = 'article',
relId = 1,
`body` = '댓글입니당1';

INSERT INTO reply
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
relTypeCode = 'article',
relId = 1,
`body` = '댓글입니당2';

INSERT INTO reply
SET regDate = NOW(),
updateDate = NOW(),
memberId = 1,
relTypeCode = 'article',
relId = 1,
`body` = '댓글입니당3';



SELECT * FROM `member`;
SELECT * FROM board;
SELECT * FROM article;


