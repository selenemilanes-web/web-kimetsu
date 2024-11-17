$("#logout").on('click', function () {
    event.preventDefault();
    $.ajax({
        method: "POST",
        url: "logout.php",
        data: {"nom": $("#userlogin").val(), "contrasenya": $("#passwordlogin").val()},
        dataType: "json",

        success: function (data) {
            if (data["Estat"] == "OK"){
                console.log(data);
                $('#registeredusers').html("Te has desconectado correctamente"+JSON.stringify(data["Usuari"]));
                document.getElementById('registeredusers').classList.remove("text-danger", "bg-light", "rounded-pill", "p-1");
                document.getElementById('registeredusers').classList.add("text-success", "bg-light", "rounded-pill", "p-1");


            }if (data["Estat"] == "KO") {
                console.log(data);
                $('#registeredusers').html(JSON.stringify(data["Error"]));
                document.getElementById('registeredusers').classList.remove("text-success", "bg-light", "rounded-pill", "p-1");
                document.getElementById('registeredusers').classList.add("text-danger", "bg-light", "rounded-pill", "p-1");
            }
        },

        error: function (jqXHR, textStatus, error) {
            console.log(jqXHR);
            alert("Error: " + textStatus + " " + error);
        }

    })
});