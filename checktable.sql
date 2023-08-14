CREATE TABLE users (
    id serial PRIMARY KEY,
    username VARCHAR ( 50 ) UNIQUE NOT NULL,
    password VARCHAR ( 50 ) NOT NULL
);

CREATE TABLE personal_info (
    id serial PRIMARY KEY,
    user_id INT references users(id),
    name VARCHAR ( 100 ),
    mobile VARCHAR ( 10 ),
    address TEXT,
    gender CHAR ( 1 ),
    occupation VARCHAR ( 100 )
);
