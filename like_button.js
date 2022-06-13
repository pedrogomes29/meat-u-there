function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&')
}

async function addLike(dishId,userId) {
  return fetch('add_like.php', {
    method: 'post',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: encodeForAjax({dishId:dishId,userId:userId})
  })
}

function getUserId(){
  return fetch('get_user_id.php')
  .then(res => res.json())
}
async function removeLike(dishId,userId) {
  return fetch('remove_like.php', {
    method: 'delete',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: encodeForAjax({dishId:dishId,userId:userId})
  })
}



const likeButtons = document.getElementsByClassName("like")


async function addListeners(){
  let userId = await getUserId()
  for(const likeButton of likeButtons){
      likeButton.addEventListener('click', async function(event){
      event.target.classList.toggle("like-no");
      event.target.classList.toggle("like-yes");
      const dishId = event.target.classList[0]
      const nrLikes = likeButton.nextElementSibling

      const previousLikes = parseInt(nrLikes.innerHTML)

      if (event.target.classList.contains("like-yes")) {
          console.log("✅💾 Saving Favorite...")
          addLike(dishId,userId)
          .catch(() => console.error('Network Error'))
          .then(response => response.json())
          .catch(() => console.error('Error parsing JSON'))
          .then(json => console.log(json))

          nrLikes.innerHTML=(previousLikes+1)
      } else {
          console.log("❌ Removing Favorite...")
          removeLike(dishId,userId)
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