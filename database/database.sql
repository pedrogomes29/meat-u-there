    PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Restaurant;
CREATE TABLE Restaurant(
    idRestaurant INTEGER PRIMARY KEY,
    name VARCHAR,
    address VARCHAR,
    idRestaurantCategory INTEGER REFERENCES RestaurantCategory,
    owner INTEGER REFERENCES User
);  

DROP TABLE IF EXISTS Review;
CREATE TABLE Review (
    idReview INTEGER PRIMARY KEY,
    score INTEGER, 
    description VARCHAR,
    published INTEGER,
    restaurant_id INTEGER REFERENCES Restaurant,
    user_id INTEGER REFERENCES User
);


DROP TABLE IF EXISTS ReviewReplies;
CREATE TABLE ReviewReplies (
    idReviewReply INTEGER PRIMARY KEY,
    idReview INTEGER REFERENCES Review,
    replyText VARCHAR,
    published INTEGER,
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
    idDish INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR,
    price INTEGER,
    idDishCategory INTEGER REFERENCES DishCategory,
    idRestaurant INTEGER REFERENCES Restaurant
);

DROP TABLE IF EXISTS DishLikes;
CREATE TABLE DishLikes(
    idDish INTEGER REFERENCES Dish ON DELETE CASCADE,
    idUser INTEGER REFERENCES User ON DELETE CASCADE,
    PRIMARY KEY(idUser,idDish)
);


DROP TABLE IF EXISTS RestaurantCategory;
CREATE TABLE RestaurantCategory(
    idRestaurantCategory INTEGER PRIMARY KEY,
    name VARCHAR
);

DROP TABLE IF EXISTS DishCategory;
CREATE TABLE DishCategory(
    idDishCategory INTEGER PRIMARY KEY,
    idRestaurant REFERENCES Restaurant,
    name VARCHAR
);

DROP TABLE IF EXISTS OrderState;
CREATE TABLE OrderState(
    id OrderState INTEGER PRIMARY KEY,
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
    idDish INTEGER REFERENCES Dish ON DELETE CASCADE
);


DROP TABLE IF EXISTS RequestDishes;
CREATE TABLE RequestDishes(
    idRequestDish INTEGER,
    idRequest INTEGER REFERENCES Request ON DELETE CASCADE,
    idDish INTEGER REFERENCES Dish ON DELETE CASCADE,
    PRIMARY KEY(idRequestDish)
);

INSERT INTO User values(0,'rui-exe','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Rua de Lousada',937721321,0);
INSERT INTO RestaurantCategory values(0,'fast-food');
INSERT INTO RestaurantCategory values(1,'italian');
INSERT INTO RestaurantCategory values(2,'vegan');
INSERT INTO RestaurantCategory values(3,'indian');
INSERT INTO RestaurantCategory values(4,'chinese');
INSERT INTO RestaurantCategory values(5,'mediterranean');
INSERT INTO OrderState values(0, 'received');
INSERT INTO OrderState values(1, 'preparing');
INSERT INTO OrderState values(2, 'ready');
INSERT INTO OrderState values(3, 'delivered');
INSERT INTO Restaurant values(0,'McDonald','Estadio do Dragao',0,0);
INSERT INTO Restaurant values(1,'BK','H.S.J',0,0);