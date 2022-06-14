const searchInput = document.getElementById("searchbar")


searchInput.placeholder = "Search for Dishes"


function updatePage(dishes){
    const allDishes = document.getElementsByClassName("dish")
    console.log(allDishes)
    for(const dish of allDishes){
        if(!dishes.includes(dish.classList[1])){
            if(!dish.classList.contains("hidden"))
                dish.classList.add("hidden")
        }
        else{
            if(dish.classList.contains("hidden"))
                dish.classList.remove("hidden")
        }
    }
}

if(searchInput){
    searchInput.addEventListener("input", async function() {
        const response = await fetch('api_restaurant.php?search='+(searchInput.value??""))
        const dishes = await response.json()
        updatePage(dishes)
    })
}

