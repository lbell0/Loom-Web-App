CREATE TABLE customers (
    cid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    cUsername VARCHAR(50) NOT NULL UNIQUE,
    cPassword VARCHAR(255) NOT NULL,
    createdAt DATETIME DEFAULT CURRENT_TIMESTAMP
);

/* NOTES:
 * cid -- PK
 * cUN -- for login
 * cPW -- for login
 * cFN -- identifying customer
 * cLN
 */
