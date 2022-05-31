    PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Restaurant;
CREATE TABLE Restaurant(
    idRestaurant INTEGER PRIMARY KEY,
    name VARCHAR,
    address VARCHAR,
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
    phoneNumber NUMBER,
    isOwner NUMBER(1) DEFAULT 0
);

DROP TABLE IF EXISTS Dish;
CREATE TABLE Dish(
    idDish INTEGER PRIMARY KEY,
    name VARCHAR,
    price INTEGER,
    idCategory INTEGER REFERENCES Category,
    idRestaurant INTEGER REFERENCES Restaurant
);


DROP TABLE IF EXISTS Category;
CREATE TABLE Category(
    idCategory INTEGER PRIMARY KEY,
    name VARCHAR
);

DROP TABLE IF EXISTS Request;
CREATE TABLE Request(
    idRequest INTEGER PRIMARY KEY,
    orderState VARCHAR,
    idUser REFERENCES User
);

DROP TABLE IF EXISTS Image;
CREATE TABLE Image(
    idImage INTEGER PRIMARY KEY,
    idRestaurant REFERENCES Restaurant,
    title VARCHAR NOT NULL REFERENCES Dish(Name) ON UPDATE CASCADE
);


DROP TABLE IF EXISTS RequestDishes;
CREATE TABLE RequestDishes(
    idRequest INTEGER REFERENCES Request,
    idDish INTEGER REFERENCES Dish ON DELET,
    PRIMARY KEY(idRequest,idDish)
);

INSERT INTO User values(0,'rui-exe','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Rua de Lousada',937721321,0);
INSERT INTO Category values(0,'fast-food');
INSERT INTO Category values(1,'italian');
INSERT INTO Category values(2,'vegan');
INSERT INTO Category values(3,'indian');
INSERT INTO Category values(4,'chinese');
INSERT INTO Category values(5,'mediterranean');
INSERT INTO Restaurant values(0,'McDonald','Estadio do Dragao',0);
INSERT INTO Restaurant values(1,'BK','H.S.J',0);