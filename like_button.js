function encodeForAjax(dishId) {
  return encodeURIComponent('dishId') + '=' + encodeURIComponent(dishId)
}



let likeButtons = document.getElementsByClassName("like");


for(const likeButton of likeButtons){
  likeButton.addEventListener('click', async function(event){
    event.target.classList.toggle("like-no");
    event.target.classList.toggle("like-yes");
    const dishId = event.target.classList[0]
    const request = new XMLHttpRequest()
    if (event.target.classList.contains("like-yes")) {
        console.log("✅💾 Saving Favorite...");
        request.open("post", "add_like.php", true)
        request.setRequestHeader('Content-Type', 
          'application/x-www-form-urlencoded')
        request.send(encodeForAjax(dishId))
    } else {
      console.log("❌ Removing Favorite...");
      request.open("post", "remove_like.php", true)
      request.setRequestHeader('Content-Type', 
        'application/x-www-form-urlencoded')
      request.send(encodeForAjax(dishId))
    }
  })
}