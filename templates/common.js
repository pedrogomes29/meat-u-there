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


const searchInput = document.querySelector("[data-search]")
let restaurants = document.getElementsByClassName('restaurants')
const listOfRestaurants = [];
for (let i = 0; i < restaurants.length; i++){
    listOfRestaurants.push(restaurants[i].outerText)
}


searchInput.addEventListener("input", e => {
    const value = e.target.value.toLowerCase()
    listOfRestaurants.forEach(restaurant => {
        const isVisible = restaurant.toLowerCase().includes(value)
        if(!isVisible) {        
            let restaurantToHide = document.getElementsByClassName(restaurant)
            if (!restaurantToHide[0].classList.contains("hide")) restaurantToHide[0].classList.toggle("hide")
        } 
        if (isVisible){
            let restaurantToHide = document.getElementsByClassName(restaurant)
            if (restaurantToHide[0].classList.contains("hide")) restaurantToHide[0].classList.toggle("hide")
        }
    })
})


document.querySelector("#add_cart").onclick = function(){
    this.firstChild.classList.toggle('hiden')
    this.lastChild.classList.toggle('hiden')
    setTimeout(function () {
        this.firstChild.toggle('hiden')
        this.lastChild.toggle('hiden')
    }, 2000);
}
