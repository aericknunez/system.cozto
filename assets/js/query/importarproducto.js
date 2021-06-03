$(document).ready(function () {


$(function () {
$('[data-toggle="tooltip"]').tooltip()
})




    $("#btn-file").click(function (event) {
        event.preventDefault();
        var form = $('#form-file')[0];
        var data = new FormData(form);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "application/src/routes.php?op=630",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            beforeSend: function () {
                $('#btn-file').html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').addClass('disabled');
                $("#contenido").html('<div class="row justify-content-center" ><h2>Espere... Se sus tantos estan siendo procesados</h2></div><div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
            },
            success: function (data) {
                $('#btn-file').html('Subir Archivo').removeClass('disabled');
                $("#contenido").html(data);
                $("#form-file").trigger("reset");
            },
        });
    });







});

