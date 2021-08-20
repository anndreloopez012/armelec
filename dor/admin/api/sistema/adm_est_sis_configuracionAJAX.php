<script>
    //update delete e insert
    function fntInsert() {

        alertify.confirm('AVISO', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "est_sis_configuracion.php?ajax=true&validaciones=proces",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('AVISO', 'Datos cargados correctamente');
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('AVISO', 'no se pudo completar!');
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };


</script>