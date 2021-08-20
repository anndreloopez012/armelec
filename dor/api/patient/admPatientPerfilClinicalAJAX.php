<script>
    function fntUpdate() {


        alertify.confirm('Tus Perfil Clinico', 'Seguro que desea continuar? ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;
            document.getElementById("loading-screen").style.display = "block";

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "patientPerfilClinical.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            alertify.alert('Tus Perfil Clinico', 'Datos cargados correctamente');
                            //location.reload(); 
                            document.getElementById("loading-screen").style.display = "none";
                        }
                    } else {
                        alertify.alert('Tus Perfil Clinico', 'No se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    //validar codigo 
    function fntValidacioncodigo() {

        var objnombre = document.getElementById("nombre");
        var intnombre = objnombre.value * 1;

        if (!isNaN(intnombre) && (intcnombre > 0)) {

            $.ajax({

                url: "patientPerfilClinical.php?validaciones=validacion_nombre&nombre=" + intnombre,
                async: true,
                global: false,

                success: function(data) {

                    if (data == "Y") {
                        alertify.alert('Tus Perfil Clinico', 'Este nombre ya esta siendo usado');
                    }
                }
            });

        }
        return false;
    }


    function fntDibujoDropDep() {

        //alert(strPais + "                                  strPais");

        $.ajax({

            url: "patientPerfilClinical.php?validaciones=dibujo_dropdow_dep",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#region").html("");
                $("#region").html(data);
                $('#region').val($('#hid_region').val())
                if ($('#hid_region').val() != '0') {
                    fntDibujoDropMun()
                }
                return false;
            }
        });

    };

    function fntDibujoDropMun() {

        var strReg = $("#region").val();

        //alert(strReg + "                                  strReg");

        $.ajax({

            url: "patientPerfilClinical.php?validaciones=dibujo_dropdow_mun",
            data: {
                region: strReg,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#distrito").html("");
                $("#distrito").html(data);
                $('#distrito').val($('#hid_distrito').val())
                return false;
            }
        });

    };

    function fntDibujoTipSangre() {

        //alert(strReg + "                                  strReg");

        $.ajax({

            url: "patientPerfilClinical.php?validaciones=dibujo_tip_sangre",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tip_sangre").html("");
                $("#tip_sangre").html(data);
                $('#tip_sangre').val($('#hid_sangre').val())
                return false;
            }
        });

    };

    function fntEdad() {

        var strReg = $("#año").val();
        var fecha = new Date();
        var ano = fecha.getFullYear();
        var edad = '';

        edad = (parseInt(ano) - 0) - parseInt(strReg);

        $("#edad").val(edad);
        //   alert(edad + "                                  edad");


    };

    window.addEventListener('load', fntEdad, false)

    window.addEventListener('load', fntDibujoTipSangre, false)
    window.addEventListener('load', fntDibujoDropDep, false)
</script>