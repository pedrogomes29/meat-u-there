const carts = document.getElementsByClassName("add_cart")

async function add_to_cart(dishId) {
    return fetch('action_add_to_cart.php', {
      method: 'post',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: encodeForAjax({dishId:dishId})
    })
  }


for(const cart of carts){
    cart.addEventListener('click',function(event){
        const dishId = cart.classList[0]
        const paragraph = document.createElement("p")  
        console.log("✅💾 Adding Dish to cart...")
        add_to_cart(dishId)
        .catch(() => console.error('Network Error'))
        .then(response => response.json())
        .catch(() => console.error('Error parsing JSON'))
        .then(json =>{  paragraph.textContent = json
                        paragraph.classList.add("add_to_cart_response")
                        if(json=="Success!")
                            paragraph.classList.add("success")
                        else
                            paragraph.classList.add("error")
                        document.body.appendChild(paragraph)
                        setTimeout(function(){
                                     document.body.removeChild(paragraph)
                                    },3000
                        )
                     })
        
    })
}