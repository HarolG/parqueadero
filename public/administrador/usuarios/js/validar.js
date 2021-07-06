function validar() {
    var tipousu;
        expresion = /^[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/g;
    tipousu = document.getElementById("registipusu").value;

    if (tipousu === "") {
        alert("Por favor llene el campo!");
        return false;
    } else if (!expresion.test(tipousu)){
        alert("Ese tipo de ususario ya esta creado");
        return false;
    }
}