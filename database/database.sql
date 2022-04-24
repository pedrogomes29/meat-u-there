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
    owner_id INTEGER REFERENCES User --check if owner_id corresponds to the owner of the restaurant of the review
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

DROP TABLE IF EXISTS Request;
CREATE TABLE Request(
    idRequest INTEGER PRIMARY KEY,
    idRequestState INTEGER REFERENCES RequestState
);

DROP TABLE IF EXISTS RequestState;
CREATE TABLE RequestState(
    idRequestState INTEGER PRIMARY KEY,
    state VARCHAR,
    idUser REFERENCES User,
    idRestaurant REFERENCES Restaurant
);


DROP TABLE IF EXISTS RequestDishes;
CREATE TABLE RequestDishes(
    idRequest REFERENCES Request,
    idDish REFERENCES Dish,
    PRIMARY KEY(idRequest,idDish)
);

INSERT INTO User values(0,'rui-exe','28a248aa64140479850878d8181bd7941a9357b6','Rua de Lousada',937721321);