function validarFormulario(){

    let nome = document.getElementById("nome").value;
    let email = document.getElementById("email").value;
    let telefone = document.getElementById("telefone").value;

    if(nome == "" || email == "" || telefone == ""){
        alert("Preencha todos os campos!");
        return false;
    }

    if(email.indexOf("@") == -1 || email.indexOf(".") == -1){
        alert("Digite um email válido!");
        return false;
    }

    return true;
}