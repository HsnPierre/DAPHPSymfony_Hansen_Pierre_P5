
CREATE TABLE user (
                username VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                name VARCHAR(45) NOT NULL,
                surname VARCHAR(45) NOT NULL,
                email VARCHAR(100) NOT NULL,
                role JSON NOT NULL,
                PRIMARY KEY (username)
);


CREATE TABLE post (
                idPost INT AUTO_INCREMENT NOT NULL,
                author VARCHAR(45) NOT NULL,
                content TEXT NOT NULL,
                date DATE NOT NULL,
                title VARCHAR(255) NOT NULL,
                lede VARCHAR(255) NOT NULL,
                username VARCHAR(255) NOT NULL,
                PRIMARY KEY (idPost)
);


CREATE TABLE comment (
                idComment INT AUTO_INCREMENT NOT NULL,
                author VARCHAR(45) NOT NULL,
                content TEXT NOT NULL,
                date DATE NOT NULL,
                valid BOOLEAN,
                username VARCHAR(255) NOT NULL,
                idPost INT NOT NULL,
                PRIMARY KEY (idComment)
);


ALTER TABLE post ADD CONSTRAINT user_post_fk
FOREIGN KEY (username)
REFERENCES user (username)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE comment ADD CONSTRAINT user_comment_fk
FOREIGN KEY (username)
REFERENCES user (username)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE comment ADD CONSTRAINT post_comment_fk
FOREIGN KEY (idPost)
REFERENCES post (idPost)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
