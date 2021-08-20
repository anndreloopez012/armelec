<script>
    function fntUpdate() {
    
        alertify.confirm('Tus Medicamentos', 'Seguro que desea continuar? ', function() {
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
                    url: "doctorCurrentlySupplied.php?ajax=true&validaciones=update&code=" + intCode,
                    success: function(r) {
                        if (r.status) {
                            if (r.status == 1) {
                                //$('#formData')[0].reset();
                                //$('#Tabla').load('doctorsDiet.php?validaciones=busqueda_table');
                                alertify.alert('Tus Medicamentos', 'Datos cargados correctamente');
                                document.getElementById("loading-screen").style.display = "none";
                                //location.reload(); 
                            }
                        } else {
                            //$('#formData')[0].reset();
                            alertify.alert('Tus Medicamentos', 'no se pudo completar!');
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


    function fntDibujoTabla1() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table1",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla1").html("");
                $("#Tabla1").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTabla2() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table2",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla2").html("");
                $("#Tabla2").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTabla3() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table3",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla3").html("");
                $("#Tabla3").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTabla4() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table4",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla4").html("");
                $("#Tabla4").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTabla5() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table5",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla5").html("");
                $("#Tabla5").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTabla6() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table6",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla6").html("");
                $("#Tabla6").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTabla7() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table7",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla7").html("");
                $("#Tabla7").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTabla8() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table8",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla8").html("");
                $("#Tabla8").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };

    function fntDibujoTabla9() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "doctorCurrentlySupplied.php?validaciones=busqueda_table9",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla9").html("");
                $("#Tabla9").html(data);
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };


    window.addEventListener('load', fntDibujoTabla1, false)
    window.addEventListener('load', fntDibujoTabla2, false)
    window.addEventListener('load', fntDibujoTabla3, false)
    window.addEventListener('load', fntDibujoTabla4, false)
    window.addEventListener('load', fntDibujoTabla5, false)
    window.addEventListener('load', fntDibujoTabla6, false)
    window.addEventListener('load', fntDibujoTabla7, false)
    window.addEventListener('load', fntDibujoTabla8, false)
    window.addEventListener('load', fntDibujoTabla9, false)

</script>