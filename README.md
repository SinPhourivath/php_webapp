#Database used

CREATE TABLE account (__
    id INT AUTO_INCREMENT PRIMARY KEY,__
    email VARCHAR(50),__
    password VARCHAR(255)__
);__

CREATE TABLE note (__
    id INT AUTO_INCREMENT PRIMARY KEY,__
    title VARCHAR(45),__
    content VARCHAR(255),__
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,__
    account_id INT,__
    FOREIGN KEY (account_id) REFERENCES account(id)__
);__
