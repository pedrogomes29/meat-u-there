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


    function getMenuId($db,$restaurant_id){
        $stmt = $db->prepare('SELECT idMenu
        FROM Menu JOIN Restaurant USING(idRestaurant)
        WHERE idRestaurant=:restaurant_id');
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt;
    }

    function getRestaurantMenu($db,$restaurant_id){
        $stmt = $db->prepare('SELECT Dish.name, Dish.price
        FROM Restaurant,Menu,Dish
        WHERE Menu.idRestaurant=Restaurant.idRestaurant AND Menu.idMenu = Dish.idMenu AND Restaurant.idRestaurant=:restaurant_id');
        $stmt->bindParam(':restaurant_id',$restaurant_id);
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        return $stmt;
    }

    function add_dish($db,$name,$price,$menu_id){
        $stmt = $db->prepare('INSERT INTO Dish values(NULL,:name,:price,:menu_id)');
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':price',$price);
        $stmt->bindParam(':menu_id',$menu_id);
        $stmt->execute();
    }


    function getImageId($db,$image_name,$idMenu){
        $stmt = $db->prepare('SELECT idImage
                              FROM Image 
                              WHERE title=:image_name AND idMenu=:idMenu');

        $stmt->bindParam(':image_name',$image_name);
        $stmt->bindParam(':idMenu',$idMenu);
        $stmt->execute();
        $stmt = $stmt->fetch();
        return $stmt["idImage"];
    }

    function add_image($db,$restaurant_id,$image_name,$menu_id){
        // Insert image data into database
        $stmt = $db->prepare("INSERT INTO Image VALUES(NULL, :name, :menu_id)");
        $stmt->bindParam(':name',$image_name);
        $stmt->bindParam(':menu_id',$menu_id);
        $stmt->execute();

        // Get image ID
        $image_id = getImageId($db,$image_name,$menu_id);
        if (!is_dir("imgs"))
            mkdir("imgs");
        if (!is_dir("imgs/restaurants")){
            mkdir("imgs/restaurants");
        }
        if (!is_dir("imgs/restaurants/$restaurant_id")){
            mkdir("imgs/restaurants/$restaurant_id");
        }
        if (!is_dir("imgs/restaurants/$restaurant_id/original")){
            mkdir("imgs/restaurants/$restaurant_id/original");
        }
        if (!is_dir("imgs/restaurants/$restaurant_id/thumbs_small")){
            mkdir("imgs/restaurants/$restaurant_id/thumbs_small");
        }
        if (!is_dir("imgs/restaurants/$restaurant_id/thumbs_medium")){
            mkdir("imgs/restaurants/$restaurant_id/thumbs_medium");
        }
      
        // Generate filenames for original, small and medium files

        $originalFileName = "imgs/restaurants/$restaurant_id/original/$image_id.jpg";
        $smallFileName = "imgs/restaurants/$restaurant_id/thumbs_small/$image_id.jpg";
        $mediumFileName = "imgs/restaurants/$restaurant_id/thumbs_medium/$image_id.jpg";
        

        // Move the uploaded file to its final destination
        move_uploaded_file($_FILES["image"]['tmp_name'], $originalFileName);


        // Crete an image representation of the original image
        $original = imagecreatefromjpeg($originalFileName);
        if (!$original) $original = imagecreatefrompng($originalFileName);
        if (!$original) $original = imagecreatefromgif($originalFileName);
      
        if (!$original) die();
      
        $width = imagesx($original);     // width of the original image
        $height = imagesy($original);    // height of the original image
        $square = min($width, $height);  // size length of the maximum square
      
        // Create and save a small square thumbnail
        $small = imagecreatetruecolor(200, 200);
        imagecopyresized($small, $original, 0, 0, ($width>$square)?($width-$square)/2:0, ($height>$square)?($height-$square)/2:0, 200, 200, $square, $square);
        imagejpeg($small, $smallFileName);
      
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
        imagejpeg($medium, $mediumFileName);
      
    }
?>