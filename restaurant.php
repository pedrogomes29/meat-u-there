<?php
    session_start();
    require_once("templates/common.php");
    require_once("database/connection.php");
    require_once("database/users.php");
    require_once("database/restaurants.php");
    output_header("restaurant");
    $db=getDatabaseConnection();
    $restaurant_info = getRestaurant($db,$_GET['id']);
    $dish_categories = getRestaurantMenu($db,$_GET['id']);
    $reviews = getReviews($db,$_GET['id']);
    date_default_timezone_set('Europe/Lisbon');
?>
<div id="restaurant_header">
    <a href="edit_restaurant.php?restaurant_id=<?=$_GET['id']?>">
        <?php
        if(file_exists("imgs/restaurants/".$_GET['id']."/header.jpg")){?>
                <img id="header_image" src="imgs/restaurants/<?=$_GET['id']?>/header.jpg"
                 alt="restaurant_image">
        <?php } else{?>
                <img id="header_image" src="imgs/default_header.jpg" alt="header">
        <?php } ?>
    </a>
    <h1 class="restaurant_name"><?=$restaurant_info["name"]?></h1>
    <p>📍Location: <?=$restaurant_info["address"]?></p> 
</div>
<menu>
<h2>Menu</h2>
    <ul>
    <?php foreach(array_keys($dish_categories) as $dish_category){ ?>
            <ul id="Category"><h1><?=$dish_category?></h1>
                <?php foreach($dish_categories[$dish_category] as $dish){?>
                <li>
                    <a href="edit_dish.php?dish_id=<?=$dish['idDish']?>&restaurant_id=<?=$_GET['id']?>">
                    <?php $imageId = getImageId($db,$dish['idDish']);
                        if(file_exists("imgs/restaurants/".$_GET['id']."/".$imageId.".jpg")){?>
                            <img src="imgs/restaurants/<?=$_GET['id']?>/<?=$imageId?>.jpg" alt="<?=$dish['name']?>">
                    <?php } else{?>
                            <img src="imgs/default_image.jpg" alt="<?=$dish['name']?>">
                    <?php } ?>  
                    </a>
                    <p><?=$dish['name']."--".$dish['price']."€"?></p>
                    <form action="action_add_to_cart.php" method="post">
                        <input type="hidden" value=<?=$dish['idDish']?> name="dish_id">
                        <input type="hidden" value=<?=$restaurant_info['idRestaurant']?> name="restaurant_id">
                        <button  id="add_cart" type="submit"> 
                            <img  src="imgs/add_to_cart.png" alt="plus sign">
                        </button>
                    </form>
                </li>
                <?php } ?>
            <ul>
        <?php } ?>
    </ul>
    <?php if (getUserInfo($db)['idUser'] == $restaurant_info['owner']){?>
        <a class="add_dish" href="add_dish.php?restaurant_id=<?=$_GET['id']?>">
        Add dish to <br> your restaurant.</a>
        <a class="edit_order" href="edit_orders_state.php?restaurant_id=<?=$_GET['id']?>">
        Edit orders <br> of your restaurant.</a>
    <?php } ?>
</menu>
        <section id="reviews">
            <?php if(sizeof($reviews)==1){ ?>
                <h1><?=sizeof($reviews)?> Review</h1>
            <?php }
            else{ ?>
            <h1><?=sizeof($reviews)?> Reviews</h1>
            <?php }
                foreach($reviews as $review){
                    $date = date('g:ia - F j o', $review['published']);
                    $replies = getReviewReplies($db,$review['idReview']);

            ?>
                    <article class="review">
                        <span class="user"><?=getUsername($db,$review['user_id'])?></span>
                        <span class="score"><?=$review['score']?></span>
                        <span class="date"><?=$date?></span>
                        <p><?=$review['description']?></p>
                        <?php if(sizeof($replies)==1){ ?>
                                <h1><?=sizeof($replies)?> Owner Reply</h1>
                             <?php }
                              else{ ?>
                                <h1><?=sizeof($replies)?> Owner Replies</h1>
                             <?php }
                            foreach($replies as $reply){
                                $reply_date = date('g:ia - F j o', $reply['published']); ?>
                                <article class="reviewReply">
                                    <span class="replyUser"><?=getUsername($db,$reply['owner_id'])?></span>
                                    <span class="date"><?=$date?></span>
                                    <span class="replyText"><?=$reply['replyText']?></span>
                                </article>
                        <?php }
                            if(getUserInfo($db)['idUser'] == $restaurant_info['owner']){ ?>
                                <form action="action_reply.php" method="post">
                                    <h2>Reply</h2>
                                        <input type="hidden" value=<?=$restaurant_info['owner']?> name="owner_id">
                                        <input type="hidden" value=<?=$review['idReview']?> name="idReview">
                                        <input type="hidden" value=<?=$_GET['id']?> name="restaurant_id">
                                        <label>Text
                                            <textarea name="replyText"></textarea>            
                                        </label>
                                        <button name="replyButton" type="submit">Reply</button>
                                </form>
                        <?php }
                        ?>
                    </article>
                    <br>
            <?php }
            if(isset($_SESSION['username'])){
                $user_id = getUserInfo($db)["idUser"];
                if(userHasMadeOrders($db,$_GET['id'],$user_id)){
                ?>
                    <form action="action_make_review.php" method="post">
                        <h2>Write a review</h2>
                            <input type="hidden" value=<?=$user_id?> name="user_id">
                            <input type="hidden" value=<?=$_GET['id']?> name="restaurant_id">
                            <label>Score 
                                <input type="number" name="score">
                            </label>
                            <label>Description
                              <textarea name="description"></textarea>            
                            </label>
                            <button name="button" type="submit">Write a review</button>
                    </form>
                <?php } 
            } ?>
        </section>
             


<?php
    output_footer();
?>
