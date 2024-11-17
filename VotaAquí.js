$("#añadiranime").on("click", function () {
    event.preventDefault();
    $.ajax({
        method: "POST",
        url: "VotaAquí.php",
        data: {"nom": $("#nomanime").val()}, //obtiene el valor del input #nom y #contrasenya del html
        dataType: "json", //Es json para que nos coja el "json_encode" del PHP.

        success: function (data) { //En "data" nos está cogiendo el "json_encode" del PHP.
            if (data["Estat"] == "OK"){
                console.log(data);
                $('#registeredusers').html(JSON.stringify(data["Error"]));
                document.getElementById('registeredusers').classList.remove("text-danger", "bg-light", "rounded-pill", "p-2");
                document.getElementById('registeredusers').classList.add("text-success", "bg-light", "rounded-pill", "p-2");
                document.forms[1].reset() //to clear the form "Register" for the next entries

            }if (data["Estat"] == "KO") {
                console.log(data);
                $('#registeredusers').html(JSON.stringify(data["Error"]));
                document.getElementById('registeredusers').classList.remove("text-success", "bg-light", "rounded-pill", "p-2");
                document.getElementById('registeredusers').classList.add("text-danger", "bg-light", "rounded-pill", "p-2");
                document.forms[1].reset() //to clear the form "Register" for the next entries
            }
        },

        error: function (jqXHR, textStatus, error) {
            console.log(jqXHR);
            alert("Error: " + textStatus + " " + error);
        }

    })
});