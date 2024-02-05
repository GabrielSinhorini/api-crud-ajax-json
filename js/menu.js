let hidden = true;

const menu = document.querySelector("img");

menu.addEventListener("click", hiddenMenu);

function hiddenMenu(){
    if(hidden === true){
        document.getElementById("hiddenMenu").style.visibility = "visible";
        hidden = false;
    }else{
        document.getElementById("hiddenMenu").style.visibility = "hidden";
        hidden = true;
    }
}