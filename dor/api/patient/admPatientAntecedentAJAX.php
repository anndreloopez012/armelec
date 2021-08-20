<script>
    function fntUpdate() {

        alertify.confirm('Tus Antecedentes', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;

            var objCode = document.getElementById("code");
            var intCode = objCode.value * 1;

            if (!isNaN(intCode) && (intCode > 0)) {
                document.getElementById("loading-screen").style.display = "block";

                $.ajax({
                    type: "POST",
                    data: datos,
                    dataType: 'json',
                    url: "patientAntecedent.php?ajax=true&validaciones=update&code=" + intCode,
                    success: function(r) {
                        if (r.status) {
                            if (r.status == 1) {
                                //$('#formData')[0].reset();
                                //$('#Tabla').load('doctorsDiet.php?validaciones=busqueda_table');
                                alertify.alert('Tus Antecedentes', 'Datos cargados correctamente');
                                //location.reload();
                                document.getElementById("loading-screen").style.display = "none";
                            }
                        } else {
                            $('#formData')[0].reset();
                            alertify.alert('Tus Antecedentes', 'no se pudo completar!');
                            //location.reload(); 
                        }
                    }

                });
            }

        }, function() {
            alertify.error('Cancel')
        })

        return false;
    };
</script>