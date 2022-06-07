const categories = document.getElementById("categories");
const sticky = categories.offsetTop;


window.onscroll = function()    {
                                const dishes = document.getElementById("dishes");
                                const stopSticky = dishes.offsetTop + dishes.offsetHeight;
                                if (window.pageYOffset >= sticky && window.pageYOffset < stopSticky) {
                                    categories.classList.add("sticky")
                                } else {
                                    categories.classList.remove("sticky");
                                }};


