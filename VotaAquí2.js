$("#añadirvotacion").on("click", function () {
    event.preventDefault();
    $.ajax({
        method: "POST",
        url: "VotaAquí2.php",
        dataType: "json",

        success: function (data) {
            if (data["Estat"] == "OK"){
                console.log(data);
                $('#registeredusers').html(JSON.stringify(data["Error"]+" Usuario: "+data["Usuari"]+". Anime: "+data["Anime"]+"."));
                document.getElementById('registeredusers').classList.remove("text-danger", "bg-light", "rounded-pill", "p-2");
                document.getElementById('registeredusers').classList.add("text-success", "bg-light", "rounded-pill", "p-4");
                document.forms[1].reset() //to clear the form "Register" for the next entries

            }if (data["Estat"] == "KO") {
                console.log(data);
                $('#registeredusers').html(JSON.stringify(data["Error"]+" Usuario: "+data["Usuari"]+". Anime: "+data["Anime"]+"."));
                document.getElementById('registeredusers').classList.remove("text-success", "bg-light", "rounded-pill", "p-2");
                document.getElementById('registeredusers').classList.add("text-danger", "bg-light", "rounded-pill", "p-4");
                document.forms[1].reset() //to clear the form "Register" for the next entries
            }
        },

        error: function (jqXHR, textStatus, error) {
            console.log(jqXHR);
            alert("Error: " + textStatus + " " + error);
        }

    })
});