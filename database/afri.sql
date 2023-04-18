DROP DATABASE IF EXISTS afriask;

CREATE DATABASE afriask;
grant all on afriask.* to "mena"@"localhost" identified by "onetwothree";
USE afriask;


CREATE TABLE User(
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    `password` VARCHAR(300) NOT NULL,
    phone_number varchar(50) NOT NULL,
    date_of_birth DATETIME NOT NULL,
    unversity varchar(300) NOT NULL,
    field_of_study varchar(300) NOT NULL,
    token VARCHAR(200)
);


CREATE TABLE Chat(
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_1 INT NOT NULL, -- chat initiator
    user_2 INT NOT NULL,

    FOREIGN KEY (user_1) REFERENCES User(id),
    FOREIGN KEY (user_2) REFERENCES User(id)
);

CREATE TABLE `Message`(
    id INT AUTO_INCREMENT,
    chat_id INT NOT NULL,
    sender_id INT NOT NULL,
    time_stamp DATETIME NOT NULL DEFAULT NOW(),

    content_type ENUM('TEXT', 'FILE', 'EVENT') default 'TEXT',
    content VARCHAR(4000) NOT NULL,

    FOREIGN KEY (chat_id) REFERENCES Chat(id),
    FOREIGN KEY (sender_id) REFERENCES User(id),
    PRIMARY KEY (id, chat_id)    
);
create TABLE questions(
	question_id INT primary KEY AUTO_INCREMENT,
    question varchar(1000) NOT NULL,
    user_id int NOT NULL,
	
    
    FOREIGN KEY (user_id) REFERENCES User(id)

);

create TABLE answers(
	id Int PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    ansId  int  NOT NULL,
    ques_id INT NOT NULL,
	answer varchar(20000) NOT NULL,
    
    FOREIGN KEY (ques_id) REFERENCES questions(question_id),
    FOREIGN KEY (user_id) REFERENCES user(id)
    
);