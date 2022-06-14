const entityMap = {
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': '&quot;',
    "'": '&#39;',
    "/": '&#x2F;'
  };
function escapeHtml(string) {
    return String(string).replace(/[&<>"'\/]/g, function (s) {
        return entityMap[s];
    });
}

let slideBars = document.querySelectorAll(".slideBar")

const searchInput = document.getElementById("searchbar")

searchInput.placeholder = "Search for Restaurants"

function fixSlideBar(e){
    let min = parseInt(document.querySelector(".slideBar.min").value,10)
    let max = parseInt(document.querySelector(".slideBar.max").value,10)
    if(min>=max-14){
        if(e.target.classList.contains("min")){
            min=max-15
            e.target.value=min
        }
        else{
            max=min+15
            e.target.value=max
        }
    }
    document.querySelector(".range").style.width = (max-min)+"%"
    document.querySelector(".range").style.marginLeft = min+"%"

    document.querySelector(".minScore").style.marginLeft = min+"%"
    document.querySelector(".minScore").innerHTML=min
    document.querySelector(".maxScore").style.marginLeft = max+"%"
    document.querySelector(".maxScore").innerHTML=max
    //spaghetti code to center text with button
    document.querySelector(".maxScore").style.right= (-(100-max)*0.005+0.4*(Math.floor(Math.log(max)/Math.log(10))+1))+"em"
    document.querySelector(".minScore").style.right= (min*0.005+0.4*(Math.floor(Math.log(min)/Math.log(10))))+"em"

}

for(const slideBar of slideBars){
    slideBar.addEventListener('change',async function(){
        updatePage()
    })

    slideBar.addEventListener('input',function(e){
        fixSlideBar(e)
    })
}


let priceButtons = document.querySelectorAll(".price")


for(const priceButton of priceButtons){
    priceButton.addEventListener('click',async function(e){
        const removeSelected = e.target.classList.contains("checked")
        for(const checkedButtons of document.querySelectorAll(".price.checked")){
            checkedButtons.classList.remove("checked")
        }
        if(!removeSelected)
            priceButton.classList.add("checked")
        updatePage()
    })
}   


let sortRadios = document.querySelectorAll(".sort")


for(const sortRadio of sortRadios){
    sortRadio.addEventListener('click',async function(){
        updatePage()
    })
}   













async function updatePage(){
    let checkedPrice = document.querySelector(".price.checked")??-1
    if(checkedPrice!==-1)
        checkedPrice = checkedPrice.classList[1]
    const response = await fetch('api_restaurants.php?search='+(searchInput.value??"")+ '&minScore=' +
    (document.querySelector(".slideBar.min").value??0) + '&maxScore='+(document.querySelector(".slideBar.max").value??100)+
    '&priceMagnitude='+checkedPrice + '&sort='+document.querySelector(".sort:checked").classList[1])

    const response_json = await response.json()
    generateRestaurantsHTML(response_json[0],response_json[1])
}

function generateRestaurantsHTML(restaurants,restaurantsWithImages){
    const listOfCategoryRestaurants = document.querySelector('#restaurants')
    listOfCategoryRestaurants.innerHTML = ''
    for (const category of Object.keys(restaurants).filter(x=>(x !== null && x !== undefined && x!==""))) {
        const restaurantCategory = document.createElement('div')
        restaurantCategory.classList.add("Category")

        const categoryName = document.createElement('h1')
        categoryName.innerHTML = "Category: " + escapeHtml(category)
        restaurantCategory.appendChild(categoryName)

        const categoryRestaurants = document.createElement('ul')
        for(const restaurantInfo of restaurants[category]){
            const img = document.createElement('img')

            if(restaurantsWithImages.includes(restaurantInfo.idRestaurant))
                img.src = 'imgs/restaurants/'+restaurantInfo.idRestaurant+'/header.jpg'
            else
                img.src = 'imgs/restaurants_background.png'
           

            img.alt = escapeHtml(restaurantInfo.name)
            const restaurant = document.createElement('li')
            const nameAndAddress = document.createElement('p')
            nameAndAddress.innerHTML= escapeHtml(restaurantInfo.name)+"<br>"+"Address: "+ escapeHtml(restaurantInfo.address)
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
        updatePage()
    })
}


window.addEventListener('load', async function(){
    updatePage()
});