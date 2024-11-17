$("#estiradeinosuke").on("click", function(){
        $("#pin").animate({
            left: "+=50px",
        });
});

$("#logo").on("click", function (){
    $(this).fadeOut();
    $(this).fadeIn(10000);
});

$("#slideclock").on("click", function (){
    $("#clock").fadeToggle(2000);
});

$(".Moons").on("load", function (){
    $(this).fadeTo("fast", 0.80)
})
$(".Moons").on("mouseleave", function (){
    $(this).fadeTo("fast", 0.80)
})
$(".Moons").on("mouseover", function (){
    $(this).fadeTo("fast", 1)
})

function tiempo(){
    let date = new Date();
    let horas = date.getHours();
    let minutos = date.getMinutes();
    let segundos = date.getSeconds();

    horas = (horas<10) ? "0" + horas : horas;
    minutos = (minutos<10) ? "0" + minutos : minutos;
    segundos = (segundos<10) ? "0" + segundos : segundos;

    let clock = horas+":"+minutos+":"+segundos;
    document.getElementById('reloj').innerHTML = clock;
    document.getElementById('reloj').textContent = clock;

    setTimeout(tiempo, 1000);

}
tiempo();

let diasweek = ["domingo","lunes","martes","miércoles","jueves","viernes","sábado"];
let meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

const d = new Date();
let diasemana = diasweek[d.getDay()];
let mes = meses[d.getMonth()];
let dia = d.getDate();
let año = d.getFullYear();

document.getElementById("fecha").innerHTML = diasemana+", "+dia+" de "+ mes+" de "+año;

