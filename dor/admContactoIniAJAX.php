<script>
    function fntInsertUs() {

        valorNom = document.getElementById("ctg_nombre_completo").value;
        if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
            alertify.alert('AVISO ', 'Por favor seleccione o ingrese un nombre');
            return false;
        }

        valorNom = document.getElementById("ctg_telefono").value;
        if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
            alertify.alert('AVISO ', 'Por favor seleccione o ingrese un telefono');
            return false;
        }

        valorNom = document.getElementById("ctg_correo").value;
        if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
            alertify.alert('AVISO ', 'Por favor seleccione o ingrese un correo');
            return false;
        }

        valorNom = document.getElementById("ctg_mensaje").value;
        if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
            alertify.alert('AVISO ', 'Por favor seleccione o ingrese un mensaje');
            return false;
        }

       // document.getElementById("loading-screen").style.display = "block";

        var datos = $('#formDataContacto').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "admContactoIni.php?ajax=true&validacionesContacto=insert_form_contacto",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        document.getElementById("loading-screen").style.display = "none";
                        document.getElementById('insert').disabled = false;

                        alertify.confirm('Datos cargados correctamente!', ' ', function() {}, function() {
                            alertify.error('Cancel')
                        })

                        $('#formDataContacto')[0].reset();
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });

        return false;
    };
</script>
