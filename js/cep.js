var regexNumeros = /^[0-9]+$/;
var regexLetrasEspaco = /^[a-zA-Z\u00C0-\u017F\s]+$/;
var regexLetrasNumeros = /^[a-zA-Z0-9]+$/;
var regexUF = /^[a-zA-Z]{2}$/
let fillCep = document.getElementById("fillCep");
let submit = document.getElementById("cadCliente");

fillCep.addEventListener("click", verificar);
submit.addEventListener("click", validar);

function validar(event){
    let nameInput = document.getElementById("firstName").value;
    let lastnameInput = document.getElementById("lastName").value;
    let cepInput = document.getElementById("cepNumber").value;
    let streetInput = document.getElementById("street").value;
    let numberInput = document.getElementById("number").value;
    let neigInput = document.getElementById("neighborhood").value;
    let cityInput = document.getElementById("city").value;
    let ufInput = document.getElementById("uf").value;

    if(nameInput !== "" || lastnameInput !== "" || cepInput !== "" || streetInput !== "" || numberInput !== "" || neigInput !== "" || cityInput !== "" || ufInput !== ""){
        if(!regexLetrasEspaco.test(nameInput)){
            event.preventDefault();

            let locDiv = document.getElementById("nameInput");
            let errorDiv = document.createElement("div");

            errorDiv.classList.add("error");
            errorDiv.id = "nameError";

            let error = document.querySelectorAll("#nameError");
            if(error.length === 0){
                errorDiv.innerHTML = "Apenas letras e espaços.";
                locDiv.appendChild(errorDiv);
            }

            setTimeout(function(){
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);

            firstName.style.border = "1px solid red";
        }
        if(!regexLetrasEspaco.test(lastnameInput)){
            event.preventDefault();

            let locDiv = document.getElementById("lastnameInput");
            let errorDiv = document.createElement("div");

            errorDiv.classList.add("error");
            errorDiv.id = "userError";

            let error = document.querySelectorAll("#userError");
            if(error.length === 0){
                errorDiv.innerHTML = "Apenas letras e espaços.";
                locDiv.appendChild(errorDiv);
            }

            setTimeout(function(){
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);

            lastName.style.border = "1px solid red";
        }
        if(!regexNumeros.test(cepInput)){
            event.preventDefault();

            let locDiv = document.getElementById("validCep");
            let errorDiv = document.createElement("div");
    
            errorDiv.classList.add("error");
            errorDiv.id = "cepInvalid2";
    
            let error = document.querySelectorAll("#cepInvalid2");
            if(error.length === 0){
                errorDiv.innerHTML = "Apenas números.";
                locDiv.appendChild(errorDiv);
            }
    
            setTimeout(function(){
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);
    
            cepInput.style.border = "1px solid red"; 
        }else if(cepInput.length !== 8){
            event.preventDefault();
            let locDiv = document.getElementById("validCep");
            let errorDiv = document.createElement("div");
    
            errorDiv.classList.add("error");
            errorDiv.id = "cepInvalid";
    
            let error = document.querySelectorAll("#cepInvalid");
            if(error.length === 0){
                errorDiv.innerHTML = "CEP precisa possuir apenas 8 números.";
                locDiv.appendChild(errorDiv);
            }
    
            setTimeout(function(){
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);
    
            cepInput.style.border = "1px solid red";
        }
        if(!regexUF.test(ufInput)) {
            event.preventDefault();
            
            let locDiv = document.getElementById("ufInput");
            let errorDiv = document.createElement("div");
            
            errorDiv.classList.add("error");
            errorDiv.id = "ufError";
            
            let error = document.querySelectorAll("#ufError");
            if (error.length === 0) {
                errorDiv.innerHTML = "Estado Inválido.";
                locDiv.appendChild(errorDiv);
            }
            
            setTimeout(function () {
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);
            
            document.getElementById("uf").style.border = "1px solid red";
        }
    }else{
        event.preventDefault();
        alert("Preencha todos os campos.");
    }
    
}

function verificar(event) {
    let cepInput = document.getElementById("cepNumber");
    let cep = cepInput.value;

    if(!regexNumeros.test(cep)){
        event.preventDefault();
        let locDiv = document.getElementById("validCep");
        let errorDiv = document.createElement("div");

        errorDiv.classList.add("error");
        errorDiv.id = "cepInvalid";

        let error = document.querySelectorAll("#cepInvalid");
        if(error.length === 0){
            errorDiv.innerHTML = "Apenas números.";
            locDiv.appendChild(errorDiv);
        }

        setTimeout(function(){
            errorDiv.classList.add("hide");
            errorDiv.id = "";
        }, 4000);

        cepInput.style.border = "1px solid red"; 
    }else if(cep.length !== 8){
        event.preventDefault();
        let locDiv = document.getElementById("validCep");
        let errorDiv = document.createElement("div");

        errorDiv.classList.add("error");
        errorDiv.id = "cepInvalid";

        let error = document.querySelectorAll("#cepInvalid");
        if(error.length === 0){
            errorDiv.innerHTML = "CEP precisa possuir apenas 8 números.";
            locDiv.appendChild(errorDiv);
        }

        setTimeout(function(){
            errorDiv.classList.add("hide");
            errorDiv.id = "";
        }, 4000);

        cepInput.style.border = "1px solid red";
    }
}
