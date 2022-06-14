let checks = document.querySelectorAll(".check");

const searchInput = document.getElementById("searchbar")

for(const check of checks){
    check.addEventListener('click',async function(e){
        let checkedValues = document.querySelectorAll(".check:checked");
        if(e.target.checked && checkedValues.length >=3){
            e.target.checked=false
        }
        else{
            if(checkValues.length<2){
                const response = await fetch('api_restaurants.php?search='+searchInput.value)
                const restaurants = await response.json()
                generateRestaurantsHTML(restaurants)
            }
            else{
                const response = await fetch('api_restaurants.php?search='+searchInput.value+ '&min=' + checkedValues[0].classList[1]
                 +'&max='+checkedValues[1].classList[1])
                const restaurants = await response.json()
                generateRestaurantsHTML(restaurants)
            }
        }
    })
}















function generateRestaurantsHTML(restaurants){
    const listOfCategoryRestaurants = document.querySelector('#restaurants')
    listOfCategoryRestaurants.innerHTML = ''
    for (const category of Object.keys(restaurants).filter(x=>(x !== null && x !== undefined && x!==""))) {
        const restaurantCategory = document.createElement('div')
        restaurantCategory.classList.add("Category")

        const categoryName = document.createElement('h1')
        categoryName.innerHTML = "Category: " + category
        restaurantCategory.appendChild(categoryName)

        const categoryRestaurants = document.createElement('ul')
        for(const restaurantInfo of restaurants[category]){
            const img = document.createElement('img')
            img.src = 'imgs/restaurants/'+restaurantInfo.idRestaurant+'/header.jpg'
            img.alt = 'restaurant_image'
            const restaurant = document.createElement('li')
            const nameAndAddress = document.createElement('p')
            nameAndAddress.innerHTML=restaurantInfo.name+"<br>"+"Address: "+restaurantInfo.address
            const link = document.createElement('a')
            link.href = 'restaurant.php?id=' + restaurantInfo.idRestaurant
            link.appendChild(img)
            link.appendChild(nameAndAddress)
            
            restaurant.appendChild(link)
            categoryRestaurants.appendChild(restaurant)
        }
        restaurantCategory.appendChild(categoryRestaurants)
        listOfCategoryRestaurants.appendChild(restaurantCategory)
    }
}


if(searchInput){
    searchInput.addEventListener("input", async function() {
        const response = await fetch('api_restaurants.php?search=' + this.value)
        const restaurants = await response.json()
        generateRestaurantsHTML(restaurants)
    })
}


window.addEventListener('load', async function(){
    const response = await fetch('api_restaurants.php')
    const restaurants = await response.json()
    generateRestaurantsHTML(restaurants)
});