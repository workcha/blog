create database blog;
use blog;
create table blog_category(
	categoryId int primary key auto_increment,
	name varchar(20) not null,
	isNav tinyint(1),
	total int default 0,
	sort tinyint(4)
)engine=myisam,charset='utf8';

create table blog_article(
	articleId int(11) primary key auto_increment,
	Title varchar(40) not null,
	Description varchar(100) not null,
	Image varchar(128) not null,
	Hits int(11) default 0,
	createAt int(11) not null,
	updateAt int(11) not null,
	Status tinyint(1),
	Sort int,
	Content text not null,
	categoryId int
)engine=myisam,charset='utf8';

create table blog_comment(
	commentId int primary key auto_increment,
	nickname varchar(20) not null,
	createAt int(11) not null,
	createIp varchar(15) not null,
	content text not null,
	articleId int
)engine=myisam,charset='utf8';
# 管理员表可以修改得更好点
create table blog_admin(
	adminId int,
	username varchar(20),
	password char(32),
	createAt int,
	loginAt int,
	loginIp int varchar(15) not null
)engine=myisam,charset='utf8';

create table blog_link(
	linkId int primary key auto_increment,
	name varchar(20) not null,
	link varchar(100) not null,
	status tinyint(1),
	sort int
)engine=myisam,charset='utf8';

insert into blog_admin values('1', 'chaohui', 'f1c5ad344d44a617ccc2126877805953',1536886800,0,0);