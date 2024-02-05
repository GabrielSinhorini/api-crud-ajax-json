let safePassword = document.getElementById("verificarSenha");
let confirmSuccess = document.getElementById("safePass");
let confirmUnsafe = document.getElementById("unsafePass");
let submit = document.getElementById("trocarSenha");

safePassword.addEventListener("click", verificar);
submit.addEventListener("click", validar);

function validar(event){
    let oldPass = document.getElementById("oldPass");
    let newPass = document.getElementById("newpass");
    let newPass2 = document.getElementById("newpass2");

    if(oldPass.value != "" && newPass.value != "" && newPass2.value != ""){
        if(newPass.value !== newPass2.value){
            event.preventDefault();
            let locDiv = document.getElementById("passInput");
            let errorDiv = document.createElement("div");

            errorDiv.classList.add("error");
            errorDiv.style.width = "70%";
            errorDiv.style.margin = "0 auto";
            errorDiv.id = "senhaError";

            let error = document.querySelectorAll("#senhaError");
            if(error.length === 0){
                errorDiv.innerHTML = "As senhas precisam ser iguais";
                locDiv.appendChild(errorDiv);
            }

            setTimeout(function(){
                errorDiv.classList.add("hide");
                errorDiv.id = "";
            }, 4000);

            newPass.style.border = "1px solid red";
            newPass2.style.border = "1px solid red";
        }  
    }else{
        event.preventDefault();
        let locDiv = document.getElementById("passInput");
        let errorDiv = document.createElement("div");

        errorDiv.classList.add("error");
        errorDiv.style.width = "70%";
        errorDiv.style.margin = "0 auto";
        errorDiv.id = "emptyError";

        let error = document.querySelectorAll("#emptyError");
        if(error.length === 0){
            errorDiv.innerHTML = "Preencha todos os campos.";
            locDiv.appendChild(errorDiv);
        }

        setTimeout(function(){
            errorDiv.classList.add("hide");
            errorDiv.id = "";
        }, 4000);

        oldPass.style.border = "1px solid red";
        newPass.style.border = "1px solid red";
        newPass2.style.border = "1px solid red";
    }
}

async function verificar() {
    const newPass = document.getElementById("newpass").value;
    
    if(!newPass.trim()){
        submit.setAttribute("disabled", true);
        gsap.fromTo(confirmUnsafe, {opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.5, display: 'block' });

        setTimeout(function () {
            gsap.to(confirmUnsafe, { opacity: 0, y: 20, duration: 0.5, display: 'none' });
        }, 3000);
        return;
    }

    const hash = await sha1(newPass);
    let pwned = 0;
    const prefixo = hash.substring(0, 5);

    try{
        const httpReq = new XMLHttpRequest();
        httpReq.onreadystatechange = function() {
            if(httpReq.readyState === XMLHttpRequest.DONE) {
                if(httpReq.status === 200) {
                    const response = httpReq.responseText;
                    const sufixoResponse = hash.substring(5).toUpperCase();
                    const lines = response.split('\n');

                    for(const line of lines) {
                        const[hash, count] = line.split(':');
                        if(hash === sufixoResponse) {
                            pwned = parseInt(count);
                            break;
                        }
                    }

                    if(pwned > 0){
                        submit.setAttribute("disabled", true);
                        gsap.fromTo(confirmUnsafe, {opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.5, display: 'block' });

                        setTimeout(function () {
                            gsap.to(confirmUnsafe, { opacity: 0, y: 20, duration: 0.5, display: 'none' });
                        }, 3000);
                    }else{
                        let safe = newPass;
                        submit.removeAttribute("disabled");
                        gsap.fromTo(confirmSuccess, {opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.5, display: 'block' });
                        
                        setTimeout(function () {
                            gsap.to(confirmSuccess, { opacity: 0, y: 20, duration: 0.5, display: 'none' });
                        }, 3000);
                        
                    }

                    
                }else{
                    submit.setAttribute("disabled", true);
                    document.getElementById("confirmUnsafe").textContent = "HTTP ERROR. CODE: " + httpReq.status;
                    gsap.fromTo(confirmUnsafe, {opacity: 0, y: 20 }, { opacity: 1, y: 0, duration: 0.5, display: 'block' });

                        setTimeout(function () {
                            gsap.to(confirmUnsafe, { opacity: 0, y: 20, duration: 0.5, display: 'none' });
                        }, 3000);
                }
            }
        };

        httpReq.open("GET", `https://api.pwnedpasswords.com/range/${prefixo}`);
        httpReq.send();
    }catch(error) {
        console.error("Erro:", error);
    }
}

function sha1(input) {
    const buffer = new TextEncoder().encode(input);
    return crypto.subtle.digest("SHA-1", buffer).then(hashBuffer => {
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
        return hashHex;
    });
}