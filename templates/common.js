function dropDownProfile() {
    document.getElementById("hidden_dropdown").classList.toggle("show");
}

window.onclick = function(event){
    if (!event.target.matches(".dropdown_button")){
        let dropdowns = document.getElementsByClassName("dropdown_content");
        let i;
        for (i = 0; i < dropdowns.length; i++){
            let openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')){
                openDropdown.classList.remove('show');
            }
        }
    }
}

const searchBar = document.getElementById("hidden_searchbar")

function dropDownSearch() {
    searchBar.classList.toggle("show")
}

window.onclick = function(event){
    if (!event.target.matches("#searchbar")){
        if (searchBar.classList.contains('show'))
        searchBar.classList.remove('show')
    }
}


window.onscroll = function(event){
    let dropdowns = document.getElementsByClassName("dropdown_content");
    let search_bar_dropdowns = document.getElementsByClassName("search_bar_content");
    let i;
    for (i = 0; i < dropdowns.length; i++){
        let openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')){
            openDropdown.classList.remove('show');
        }
    }
    for (i = 0; i < search_bar_dropdowns.length; i++){
        let openDropdown = search_bar_dropdowns[i];
        if (openDropdown.classList.contains('show')){
            openDropdown.classList.remove('show');
        }
    }
}

function unDropDownSearch(){
    if (searchBar.classList.contains('show'))
        searchBar.classList.remove('show')
}


const searchInput = document.querySelector("[data-search]")
let restaurants = document.getElementsByClassName('restaurants')
const listOfRestaurants = [];
for (let i = 0; i < restaurants.length; i++){
    listOfRestaurants.push(restaurants[i].outerText)
}

if(searchInput){
    searchInput.addEventListener("input", async function() {
        const response = await fetch('../api/api_restaurants.php?search=' + this.value)
        const restaurants = await response.json()
    
        const section = document.querySelector('#restaurants')
        section.innerHTML = ''
        const listOfCategoryRestaurants = document.createElement('ul')
        for (const category of restaurants.keys()) {
            const restaurantCategory = document.createElement('h1')
            restaurantCategory.innerHTML = "Category: " + category
            const categoryRestaurants = document.createElement('ul')
            categoryRestaurants.classList.add("Category")
            categoryRestaurants.appendChild(restaurantCategory)
            for(const restaurantInfo of restaurants[category]){
                const restaurant = document.createElement('li')
                const nameAndAddress = document.createElement('p')
                nameAndAddress.innerHTML=restaurantInfo.name+"<br>"+"Address: "+restaurantInfo.address

                const img = document.createElement('img')
                img.src = 'imgs/restaurants/$restaurantInfo.id/header.jpg'
                img.alt = 'restaurant_image'
                const link = document.createElement('a')
                link.href = 'restaurant.php?id=' + restaurant.id
                link.appendChild(nameAndAddress)
                link.appendChild(img)
                
                restaurant.appendChild(link)
                categoryRestaurants.appendChild(restaurant)
            }
            listOfCategoryRestaurants.appendChild(categoryRestaurants)
        }
    })
}
