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
    idRestaurant INTEGER REFERENCES Restaurant,
    userId INTEGER REFERENCES User
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
    phoneNumber NUMBER
);

DROP TABLE IF EXISTS Dish;
CREATE TABLE Dish(
    idDish INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR,
    price REAL,
    idDishCategory INTEGER REFERENCES DishCategory,
    idRestaurant INTEGER REFERENCES Restaurant
);

DROP TABLE IF EXISTS DishLikes;
CREATE TABLE DishLikes(
    idDish INTEGER REFERENCES Dish ON DELETE CASCADE,
    idUser INTEGER REFERENCES User ON DELETE CASCADE,
    PRIMARY KEY(idUser,idDish)
);

DROP TABLE IF EXISTS RestaurantLikes;
CREATE TABLE RestaurantLikes(
    idRestaurant INTEGER REFERENCES Restaurant ON DELETE CASCADE,
    idUser INTEGER REFERENCES User ON DELETE CASCADE,
    PRIMARY KEY(idUser,idRestaurant)
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

INSERT INTO User values(0,'rui-exe','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Rua de Lousada',937721321);
INSERT INTO User values(1, 'joao-exe','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Rua de Porto', 938446710);
INSERT INTO User values(2, 'pedro-exe','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Rua de Valongo', 938446710);
INSERT INTO User values(3, 'default','40bd001563085fc35165329ea1ff5c5ecbdbbeef','Rua Dr. Roberto Frias', 938446710);
INSERT INTO RestaurantCategory values(0,'Fast-Food');
INSERT INTO RestaurantCategory values(1,'Italian');
INSERT INTO RestaurantCategory values(2,'Vegan');
INSERT INTO RestaurantCategory values(3,'Indian');
INSERT INTO RestaurantCategory values(4,'Japanase');
INSERT INTO RestaurantCategory values(5,'Mediterranean');
INSERT INTO OrderState values(0, 'Received');
INSERT INTO OrderState values(1, 'Preparing');
INSERT INTO OrderState values(2, 'Ready');
INSERT INTO OrderState values(3, 'Delivered');
INSERT INTO Restaurant values(0,'McDonald''s','Estadio do Dragao',0,0);
INSERT INTO Restaurant values(1,'BK','H.S.J',0,2);
INSERT INTO Restaurant values(2,'KFC','Alameda',0,1);
INSERT INTO Restaurant values(3,'Pizzaiolo','Algarve',1,0);
INSERT INTO Restaurant values(4,'Capa Negra II','Lisboa',5,0);
INSERT INTO Restaurant values(5,'Seen','Sintra',5,1);
INSERT INTO Restaurant values(6,'Yakuza','Aveiro',4,2);
INSERT INTO Restaurant values(7,'Guilty','Porto',5,0);
INSERT INTO Restaurant values(8,'Pizzaria Meidin','Boavista',1,2);
INSERT INTO Restaurant values(9,'Indian Paradise','Ermesinde',3,2);
INSERT INTO Restaurant values(10,'Distinto','Lousada',5,0);
INSERT INTO Restaurant values(11,'DaTerra','Alentejo',2,2);
INSERT INTO Restaurant values(12,'SushiBar','Canidelo',4,1);
INSERT INTO Restaurant values(13,'Popeyes','EDP445',0,0);
INSERT INTO Restaurant values(14,'Mother India','Pedrouços',3,2);
INSERT INTO Restaurant values(15,'Recantos de Harmonia','Bragança',2,2);
INSERT INTO Restaurant values(16,'Pizzaria Ricardo','Penafiel',1,2);
