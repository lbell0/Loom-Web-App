CREATE TABLE menu (
    mid   INT   PRIMARY KEY   AUTO_INCREMENT,
    name  VARCHAR(50)  NOT NULL,
    price INT NOT NULL,
    descr VARCHAR(100),
    rid INT,
    FOREIGN KEY(rid) REFERENCES restaurants(rid)
);
