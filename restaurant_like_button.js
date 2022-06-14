function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
  }

  async function addRestaurantLike(restaurantId,userId) {
    return fetch('add_restaurant_like.php', {
      method: 'post',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: encodeForAjax({restaurantId:restaurantId,userId:userId})
    })
  }

  function getUserId(){
    return fetch('get_user_id.php')
    .then(res => res.json())
  }

  async function removeRestaurantLike(restaurantId,userId) {
    return fetch('remove_restaurant_like.php', {
      method: 'delete',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: encodeForAjax({restaurantId:restaurantId,userId:userId})
    })
  }
  
  const restaurantLikeButtons = document.getElementsByClassName("likeRestaurant")
  async function addListeners(){
    let userId = await getUserId()
    for(const likeButton of restaurantLikeButtons){
        likeButton.addEventListener('click', async function(event){
        event.target.classList.toggle("like-no");
        event.target.classList.toggle("like-yes");
        const restaurantId = event.target.classList[0]
        const nrLikes = likeButton.nextElementSibling
  
        const previousLikes = parseInt(nrLikes.innerHTML)
  
        if (event.target.classList.contains("like-yes")) {
            console.log("✅💾 Saving Favorite...")
            addRestaurantLike(restaurantId,userId)
            .catch(() => console.error('Network Error'))
            .then(response => response.json())
            .catch(() => console.error('Error parsing JSON'))
            .then(json => console.log(json))
  
            nrLikes.innerHTML=(previousLikes+1)
        } else {
            console.log("❌ Removing Favorite...")
            removeRestaurantLike(restaurantId,userId)
            .catch(() => console.error('Network Error'))
            .then(response => response.json())
            .catch(() => console.error('Error parsing JSON'))
            .then(json => console.log(json))
  
            nrLikes.innerHTML=(previousLikes-1)
        }
      })
    }
  }
  
  addListeners()