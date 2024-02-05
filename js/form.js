var regexLetrasEspaco = /^[a-zA-Z\u00C0-\u017F\s]+$/;
var regexLetrasNumeros = /^[a-zA-Z0-9]+$/;
var regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
var regexCPF = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;

const formulario = document.getElementById("cadFunc");

formulario.addEventListener("submit", validar);

function validar(event){
    let nome = document.getElementById("nome");
    let user = document.getElementById("user");
    let email = document.getElementById("email");
    let cpf = document.getElementById("cpf");

    if(nome.value != "" && user.value != "" && email.value != "" && cpf.value != ""){
        if(!regexLetrasEspaco.test(nome.value)){
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

            nome.style.border = "1px solid red";
            event.preventDefault();
        }
    
        if(!regexLetrasNumeros.test(user.value) || user.value.length > 12 || user.value.length < 3){
            let locDiv = document.getElementById("userInput");
            let errorDiv = document.createElement("div");

            errorDiv.classList.add("error");
            errorDiv.id = "userError";

            let error = document.querySelectorAll("#userError");
            if(error.length === 0){
                errorDiv.innerHTML = "3 à 12 caracteres, não pode conter espaços.";
                locDiv.appendChild(errorDiv);
            }

            setTimeout(function(){
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);
            
            user.style.border = "1px solid red";
            event.preventDefault();
        }
        
        if(!regexEmail.test(email.value.trim())){
            let locDiv = document.getElementById("emailInput");
            let errorDiv = document.createElement("div");

            errorDiv.classList.add("error");
            errorDiv.id = "emailError";

            let error = document.querySelectorAll("#emailError");
            if(error.length === 0){
                errorDiv.innerHTML = "Digite um e-mail válido.";
                locDiv.appendChild(errorDiv);
            }

            setTimeout(function(){
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);

            email.style.border = "1px solid red";
            event.preventDefault();
        }
        
        if(!regexCPF.test(cpf.value)){
            let locDiv = document.getElementById("cpfInput");
            let errorDiv = document.createElement("div");

            errorDiv.classList.add("error");
            errorDiv.id = "cpfError";

            let error = document.querySelectorAll("#cpfError");
            if(error.length === 0){
                errorDiv.innerHTML = "Verifique o formato correto.";
                locDiv.appendChild(errorDiv);
            }

            setTimeout(function(){
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);

            cpf.style.border = "1px solid red";
            event.preventDefault();
        }        
    }else{
        event.preventDefault();
    }
}