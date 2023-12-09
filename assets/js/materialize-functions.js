//Função Floating Menu
document.addEventListener('DOMContentLoaded', function(){
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems,{
        direction: 'top',
        hoverEnabled: false
    });
});

//Função Select
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
});

//Função de exibição de modal
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
});

$(document).ready(function () {
    $("#number_register").on("input", function () {
        var number_register = $(this).val();
        
        console.log("Valor do number_register: " + number_register);  // Adiciona este log

        $.ajax({
            type: "POST",
            url: "./actions/consulta.php",
            data: {number_register: number_register},
            success: function (response) {
                $("#colaborador").val(response);
            }
        });
    });
});
