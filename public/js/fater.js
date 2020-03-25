$(document).ready(function () {
    $('#preloader').hide();
    $("#form_ajouter").on('submit', (function (e) {
        $('#preloader').show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/participant.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $("#erreur").html(data);
                $('#form_ajouter')[0].reset();
                $('#preloader').hide();


            }

        });


    }));
    $("#globale_send").on('submit', (function (e) {
        $('#preloader').show();
        e.preventDefault();
        $.ajax({
            url: "app/DefaultApp/traitements/participant.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#preloader').hide();
                if(data=='ok'){
                    alert("Message envoyer avec Succes !!");
                    document.location.href="home";
                }else{
                    alert(data);
                }
                $('#globale_send')[0].reset();



            }

        });


    }));

});