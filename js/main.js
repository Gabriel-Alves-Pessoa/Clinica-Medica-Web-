window.addEventListener("scroll", function(){
    var header = document.querySelector("header");
    header.classList.toggle("sticky", window.scrollY > 0);
});

var mail = document.querySelector(".mail img");

mail.addEventListener("click", visivel);
function visivel(){
    var p = document.getElementById("p");
    if(p.style.visibility === "hidden"){
        p.style.visibility = "visible";
    }else{
        p.style.visibility = "hidden";
    }
}
