PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Restaurant;
CREATE TABLE Restaurant(
    idRestaurant INTEGER PRIMARY KEY,
    name VARCHAR,
    address VARCHAR,
    category INTEGER REFERENCES Category,
    owner INTEGER REFERENCES User
);  

DROP TABLE IF EXISTS Review;
CREATE TABLE Review (
    idReview INTEGER PRIMARY KEY,
    score INTEGER, 
    description VARCHAR,
    restaurant_id INTEGER REFERENCES Restaurant,
    user_id INTEGER REFERENCES User
);


DROP TABLE IF EXISTS ReviewReplies;
CREATE TABLE ReviewReplies (
    idReviewReply INTEGER PRIMARY KEY,
    idReview INTEGER REFERENCES Review,
    replyText VARCHAR,
    owner_id INTEGER REFERENCES User #check if owner_id corresponds to the owner of the restaurant of the review
);
    
DROP TABLE IF EXISTS User;
CREATE TABLE User(
    idUser INTEGER PRIMARY KEY,
    username VARCHAR,
    password VARCHAR,
    address VARCHAR,
    phoneNumber NUMBER
);

DROP TABLE IF EXISTS Dish;
CREATE TABLE Dish(
    idDish INTEGER PRIMARY KEY,
    name VARCHAR,
    price INTEGER,
    photos BLOB,
    menu_id INTEGER REFERENCES Menu
);

DROP TABLE IF EXISTS Menu;
CREATE TABLE Menu(
    idMenu INTEGER PRIMARY KEY
);

DROP TABLE IF EXISTS Category;
CREATE TABLE Category(
    idCategory INTEGER PRIMARY KEY,
    name VARCHAR
);

DROP TABLE IF EXISTS Order;
CREATE TABLE Order(
    idOrder INTEGER PRIMARY KEY,
    idOrderState INTEGER REFERENCES OrderState
);

DROP TABLE IF EXISTS OrderState;
CREATE TABLE OrderState(
    idOrderState INTEGER PRIMARY KEY,
    state VARCHAR,
    idUser REFERENCES User,
    idRestaurant REFERENCES Restaurant
);


DROP TABLE IF EXISTS OrderDishes;
CREATE TABLE OrderDishes(
    idOrder REFERENCES Order,
    idDish REFERENCES Dish,
    PRIMARY KEY(idOrder,idDish)
);

