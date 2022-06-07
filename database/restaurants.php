<?php
    session_start();
    require_once('connection.php');
    function getRestaurant($db,$restaurant_id){
        $stmt = $db->prepare('SELECT *
                            FROM Restaurant
                            WHERE idRestaurant=:restaurant_id');
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt;
    }

    function getRestaurants($db){
        $stmt = $db->prepare('SELECT Restaurant.name, Restaurant.address, Restaurant.idRestaurant, RestaurantCategory.name as category
        FROM (Restaurant JOIN RestaurantCategory using (idRestaurantCategory))
        ORDER BY category');
        $stmt->execute();
        $current_category="";
        $restaurants_in_category = array();
        $i=0;
        while($row=$stmt->fetch()){
            if($row["category"]!=$current_category && $current_category!=""){
                $category_restaurants[$current_category]=$restaurants_in_category;
                $restaurants_in_category=array();
                $current_category=$row["category"];
                $i=0;
            }
            else if ($current_category==""){
                $current_category=$row["category"];
                $i=0;
            }
            $restaurant["name"]=$row["name"];
            $restaurant["address"]=$row["address"];
            $restaurant["idRestaurant"]=$row["idRestaurant"];
            $restaurants_in_category[$i]=$restaurant;
            $i++;
        }
        $category_restaurants[$current_category]=$restaurants_in_category;
        return $category_restaurants;
    }


    function getRestaurantCategories($db){
        $stmt = $db->prepare('SELECT name
        FROM RestaurantCategory');
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }



    function addLike($db,$dishId,$userId){
        $stmt = $db->prepare('INSERT INTO DishLikes values(:dishId,:userId)');
        $stmt->bindParam(':dishId',$dishId);
        $stmt->bindParam(':userId',$userId);
        $stmt->execute();
    }


    function removeLike($db,$dishId,$userId){
        $stmt = $db->prepare('DELETE FROM DishLikes
                            WHERE idDish=:dishId AND idUser=:userId');
        $stmt->bindParam(':dishId',$dishId);
        $stmt->bindParam(':userId',$userId);
        $stmt->execute();
    }

    function getRestaurantCategoryId($db,$name){
        $stmt = $db->prepare('SELECT idRestaurantCategory
        FROM RestaurantCategory
        WHERE name=:name');
        $stmt->bindParam(':name',$name);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt["idRestaurantCategory"];

    }


    function add_dish_category($db,$restaurant_id,$category_name){
        $stmt = $db->prepare('INSERT INTO DishCategory(idRestaurant,name) values(:restaurant_id,:category_name)');
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->bindParam(':category_name',$category_name);
        $stmt->execute();
    }


    function edit_restaurant_info($db,$new_name,$new_address,$new_category,$restaurant_id){
        $stmt = $db->prepare('UPDATE Restaurant
                              SET name=:new_name,address=:new_address,idRestaurantCategory=:new_category
                              WHERE idRestaurant=:restaurant_id');
        $stmt->bindParam(':new_name',$new_name);
        $stmt->bindParam(':new_address',$new_address);
        $stmt->bindParam(':new_category',$new_category);
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
    }

    function getRestaurantMenu($db,$restaurant_id){
        $stmt = $db->prepare('SELECT name,price,idDish,category,IFNULL(nrLikes, 0) nrLikes
                            FROM 
                                (SELECT Dish.name, Dish.price, Dish.idDish,DishCategory.name as category
                                FROM (Dish JOIN Restaurant using(idRestaurant))JOIN DishCategory using(idDishCategory)
                                WHERE Restaurant.idRestaurant=:restaurant_id
                                ORDER BY category)
                                LEFT JOIN
                                (SELECT idDish,count(*) as nrLikes
                                FROM DishLikes
                                GROUP BY idDish)
                                USING (idDish)
                                ');
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $current_category="";
        $dishes_in_category = array();
        $i=0;
        while($row=$stmt->fetch()){
            if($row["category"]!=$current_category && $current_category!=""){
                $category_dishes[$current_category]=$dishes_in_category;
                $dishes_in_category=array();
                $current_category=$row["category"];
                $i=0;
            }
            else if ($current_category==""){
                $current_category=$row["category"];
                $i=0;
            }
            $dish["name"]=$row["name"];
            $dish["price"]=$row["price"];
            $dish["idDish"]=$row["idDish"];
            $dish["nrLikes"]=$row["nrLikes"];
            $dishes_in_category[$i]=$dish;
            $i++;
        }
        $category_dishes[$current_category]=$dishes_in_category;

        return $category_dishes;
    }

    function add_restaurant_header($restaurant_id){
        if(isset($_FILES["header"])){
            if (!is_dir("imgs"))
                mkdir("imgs");
            if (!is_dir("imgs/restaurants")){
                mkdir("imgs/restaurants");
            }
            if (!is_dir("imgs/restaurants/$restaurant_id")){
                mkdir("imgs/restaurants/$restaurant_id");
            }
            move_uploaded_file($_FILES["header"]['tmp_name'], 
            "imgs/restaurants/$restaurant_id/header.jpg");
            unset($_FILES["header"]);
        }
    }

    function userLikedDish($db,$idDish,$idUser){
        $stmt = $db->prepare('SELECT count(*) as nrLikes
                            FROM DishLikes
                            WHERE idDish=:idDish AND idUser=:idUser');
        $stmt->bindParam(':idDish',$idDish);
        $stmt->bindParam(':idUser',$idUser);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['nrLikes'];
        return $count==1;
    }

    function getDishCategoryId($db,$category,$restaurant_id){
        $stmt = $db->prepare('SELECT idDishCategory
                              FROM DishCategory
                              WHERE name=:name AND idRestaurant=:idRestaurant');
        $stmt->bindParam(':name',$category);
        $stmt->bindParam(':idRestaurant',$idRestaurant);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt["idDishCategory"];
    }

    function add_dish($db,$name,$price,$restaurant_id,$dishCategoryId){
        $stmt = $db->prepare('INSERT INTO Dish values(NULL,:name,:price,:category_id,:restaurant_id)');
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':price',$price);
        $stmt->bindParam(':category_id',$dishCategoryId);
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();

        $stmt = $db->prepare('SELECT idDish
                             FROM Dish
                             WHERE name=:name AND idRestaurant=:restaurant_id');

        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt["idDish"];
    }


    function edit_dish($db,$name,$price,$idDish,$idDishCategory,$restaurant_id){
        $stmt = $db->prepare('UPDATE Dish
                              SET name=:name,price=:price,idDishCategory=:idDishCategory
                              WHERE idDish=:idDish');
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':price',$price);
        $stmt->bindParam(':idDish',$idDish);
        $stmt->bindParam(':idDishCategory',$idDishCategory);
        $stmt->execute();
    }


    function getDishInfo($db,$dish_id){
        $stmt = $db->prepare('  SELECT *
                                FROM Dish
                                WHERE idDish=:idDish');
        $stmt->bindParam(':idDish',$dish_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt;
    }

    function getImageId($db,$idDish){
        $stmt = $db->prepare('SELECT idImage
                              FROM Image 
                              WHERE idDish=:idDish');

        $stmt->bindParam(':idDish',$idDish);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt["idImage"];
    }

    function dishExists($db,$dish_name,$restaurant_id){
        $stmt = $db->prepare('SELECT count(*) as nrDishes
                            FROM Dish
                            WHERE name=:dish_name AND idRestaurant=:restaurant_id');
        $stmt->bindParam(':dish_name',$dish_name);
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['nrDishes'];
        return $count==1;
    }

    
    function dish_exists($db,$dish_id){
        $stmt = $db->prepare('SELECT count(*) as nrDishes
                              FROM DISH
                              WHERE idDish=:dish_id');

        $stmt->bindParam(':dish_id',$dish_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['nrDishes'];
        return $count==1;   
    } 

    function getDishId($db,$dish_name,$restaurant_id){
        $stmt = $db->prepare('SELECT idDish
                            FROM Dish
                            WHERE name=:dish_name AND idRestaurant=:restaurant_id');
        $stmt->bindParam(':dish_name',$dish_name);
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt['idDish'];
    }
    function getDishName($db,$dish_id){
        $stmt = $db->prepare('SELECT name, price
                            FROM Dish
                            WHERE idDish=:dish_id');
        $stmt->bindParam(':dish_id',$dish_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt;
    }

    function userHasMadeOrders($db,$restaurant_id,$user_id){
        $stmt = $db->prepare('SELECT count(*) as activeRequests
                            FROM (Request JOIN RequestDishes using(idRequest))JOIN Dish using(idDish)
                            WHERE idUser=:idUser AND idRestaurant=:restaurant_id');

        $stmt->bindParam(':idUser',$user_id);
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['activeRequests'];
        return $count>=1;  

    }
    function getReviews($db,$restaurant_id){
        $stmt = $db->prepare('SELECT *
                              FROM Review
                              WHERE restaurant_id=:restaurant_id');

        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }

    function update_image($db,$restaurant_id,$dish_id){
        if(isset($_FILES["new_image"])){
            $image_id = getImageId($db,$dish_id);

            $fileName = "imgs/restaurants/$restaurant_id/$image_id.jpg";
            $tempFileName = $_FILES["new_image"]['tmp_name'];
    
    
            // Crete an image representation of the original image
            $original = imagecreatefromjpeg($tempFileName);
            if (!$original) $original = imagecreatefrompng($tempFileName);
            if (!$original) $original = imagecreatefromgif($tempFileName);
          
            if (!$original) die();
          
            $width = imagesx($original);     // width of the original image
            $height = imagesy($original);    // height of the original image
            $square = min($width, $height);  // size length of the maximum square
          
          
            // Calculate width and height of medium sized image (max width: 400)
            $mediumwidth = $width;
            $mediumheight = $height;
            if ($mediumwidth > 400) {
              $mediumwidth = 400;
              $mediumheight = $mediumheight * ( $mediumwidth / $width );
            }
          
            // Create and save a medium image
            $medium = imagecreatetruecolor($mediumwidth, $mediumheight);

            imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);
            imagejpeg($medium, $fileName);

            unset($_FILES["new_image"]);
        }
    }
  
    function dishHasOrders($db,$dish_id){
        $stmt = $db->prepare("SELECT count(*) as activeRequests
                            FROM RequestDishes JOIN Request using(idRequest)
                            WHERE idDish=:dish_id AND orderState<>'delivered'");

        $stmt->bindParam(':dish_id',$dish_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['activeRequests'];
        return $count>=1;   
    }

    function removeDish($db,$dish_id){
        $stmt = $db->prepare('DELETE FROM Dish
                            WHERE idDish=:dish_id');
        $stmt->bindParam(':dish_id',$dish_id);
        $stmt->execute();
    }

    function add_image($db,$restaurant_id,$dish_id){
        // Insert image data into database
        $stmt = $db->prepare("INSERT INTO Image VALUES(NULL, :dish_id)");
        $stmt->bindParam(':dish_id',$dish_id);
        $stmt->execute();

        // Get image ID
        $image_id = getImageId($db,$dish_id);
        if (!is_dir("imgs"))
            mkdir("imgs");
        if (!is_dir("imgs/restaurants")){
            mkdir("imgs/restaurants");
        }
        if (!is_dir("imgs/restaurants/$restaurant_id")){
            mkdir("imgs/restaurants/$restaurant_id");
        }
      
        // Generate filenames for original, small and medium files

        $fileName = "imgs/restaurants/$restaurant_id/$image_id.jpg";
        $tempFileName = $_FILES["image"]['tmp_name'];


        // Crete an image representation of the original image
        $original = imagecreatefromjpeg($tempFileName);
        if (!$original) $original = imagecreatefrompng($tempFileName);
        if (!$original) $original = imagecreatefromgif($tempFileName);
      
        if (!$original) die();
      
        $width = imagesx($original);     // width of the original image
        $height = imagesy($original);    // height of the original image
        $square = min($width, $height);  // size length of the maximum square
      
      
        // Calculate width and height of medium sized image (max width: 400)
        $mediumwidth = $width;
        $mediumheight = $height;
        if ($mediumwidth > 400) {
          $mediumwidth = 400;
          $mediumheight = $mediumheight * ( $mediumwidth / $width );
        }
      
        // Create and save a medium image
        $medium = imagecreatetruecolor($mediumwidth, $mediumheight);
        imagecopyresized($medium, $original, 0, 0, 0, 0, $mediumwidth, $mediumheight, $width, $height);
        imagejpeg($medium, $fileName);

    }

    function add_review($db,$user_id,$restaurant_id,$score,$description){
        $db->beginTransaction();
        $stmt = $db->prepare('INSERT INTO Review(score, description,published,restaurant_id,user_id)
                            values(:score, :description,:published,:restaurant_id,:user_id)');
        $stmt->bindParam(':user_id',$user_id);
        $stmt->bindParam(':published',time());
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->bindParam(':score',$score);
        $stmt->bindParam(':description',$description);

        $stmt->execute();
        $db->commit();
    }

    function getReviewReplies($db,$idReview){
        $stmt = $db->prepare('SELECT *
                             FROM ReviewReplies
                             WHERE idReview=:idReview');
        $stmt->bindParam(':idReview',$idReview);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }

    function add_reply($db,$owner_id,$idReview,$replyText){
        $db->beginTransaction();
        $stmt = $db->prepare('INSERT INTO ReviewReplies(idReview, replyText,published,owner_id)
                            values(:idReview, :replyText,:published,:owner_id)');
        $stmt->bindParam(':idReview',$idReview);
        $stmt->bindParam(':replyText',$replyText);
        $stmt->bindParam(':published',time());
        $stmt->bindParam(':owner_id',$owner_id);

        $stmt->execute();
        $db->commit();
    }

    function dishCategoryExists($db,$new_dish_category,$restaurant_id){
        $stmt = $db->prepare('SELECT count(*) as nrCategories
                            FROM DishCategory
                            WHERE name=:new_dish_category AND idRestaurant=:restaurant_id');
        $stmt->bindParam(':new_dish_category',$new_dish_category);
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        $count = $stmt['nrCategories'];
        return $count==1;

    }

    function getRestaurantDishes($db, $idRestaurant){
        $stmt = $db->prepare('SELECT Dish.idDish, Dish.name
                            FROM Dish 
                            WHERE Dish.idRestaurant = :idRestaurant'
                            );
        $stmt->bindParam(':idRestaurant', $idRestaurant);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }

    function getDishCategories($db,$idRestaurant){
        $stmt = $db->prepare('SELECT name,idDishCategory
                              FROM DishCategory
                              WHERE idRestaurant=:idRestaurant');
        $stmt->bindParam(':idRestaurant',$idRestaurant);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }
    function createRequestDish($db,$idRequest,$idDish){
        $db->beginTransaction();
        $stmt = $db->prepare('INSERT INTO RequestDishes(idRequest, idDish)
                            values(:idRequest,:idDish)');
        $stmt->bindParam(':idRequest',$idRequest);
        $stmt->bindParam(':idDish',$idDish);
        $stmt->execute();
        $db->commit();
    }
    function createRequest($db, $orderState,  $idUser){
        $db->beginTransaction();
        $stmt = $db->prepare('INSERT INTO Request(orderState,idUser)
                            values(:orderState,:idUser)'); 
        $stmt->bindParam(':orderState',$orderState);
        $stmt->bindParam(':idUser',$idUser);
        $stmt->execute();
        $db->commit();
    }
    function getRequests($db,$user_id){
        $stmt = $db->prepare('SELECT *
                              FROM Request WHERE idUser=:user_id');
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }

    function getRequestDishes($db,$idRequest){
        $stmt = $db->prepare('SELECT idDish
                              FROM RequestDishes WHERE idRequest=:idRequest');
        $stmt->bindParam(':idRequest',$idRequest);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }


    function getRestaurantRequests($db, $idRestaurant){
        $stmt = $db->prepare('SELECT Distinct Request.idRequest, idUser,orderState
                            FROM (Dish JOIN RequestDishes USING (idDish)) JOIN Request USING(idRequest)
                            WHERE idRestaurant=:idRestaurant');    
        $stmt->bindParam(':idRestaurant', $idRestaurant);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }    
    function getStates($db){
        $stmt = $db->prepare('SELECT name
                              FROM OrderState');
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }   
    function updateState($db,$idRequest,$orderState){
        $stmt = $db->prepare('UPDATE Request
        SET orderState=:orderState
        WHERE idRequest=:idRequest');
        $stmt->bindParam(':orderState', $orderState);
        $stmt->bindParam(':idRequest', $idRequest);
        $stmt->execute();
    }            
?>