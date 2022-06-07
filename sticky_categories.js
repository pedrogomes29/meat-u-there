var categories = document.getElementById("categories");

var sticky = categories.offsetTop;

window.onscroll = function() {  if (window.pageYOffset >= sticky) {
                                    categories.classList.add("sticky")
                                } else {
                                    categories.classList.remove("sticky");
                                }};


