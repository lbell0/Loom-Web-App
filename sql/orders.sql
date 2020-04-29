CREATE TABLE orders(
  oid INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100),
  quantity INT NOT NULL,
  price DECIMAL(6, 2) NOT NULL,
  mid INT UNIQUE,
  cid INT UNIQUE,
  FOREIGN KEY(mid) REFERENCES menu(mid),
  FOREIGN KEY(cid) REFERENCES customers(cid)
);
