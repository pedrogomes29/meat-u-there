

window.onscroll = function()    {
    let categories = document.getElementsByClassName("category")
    for (let i = 0; i < categories.length; i++){ 
        const underLineCategory = categories[i].offsetTop
        const stopUnderline = categories[i].offsetTop + categories[i].offsetHeight
        if (window.pageYOffset >= underLineCategory && window.pageYOffset < stopUnderline){
            document.getElementsByClassName(categories[i].classList[1])[0].classList.add("underLineCategory")
        } else {
            document.getElementsByClassName(categories[i].classList[1])[0].classList.remove("underLineCategory")
        }
    }
}
