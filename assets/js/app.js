function atualizarHorario() {
   var data = new Date().toLocaleString("pt-br", {
        timeZone: "America/Sao_Paulo"
    }); data.replace(", ", " ");
    document.getElementById("horario").innerHTML = data.replace(", ", " ");
}
setInterval(atualizarHorario, 1000);


