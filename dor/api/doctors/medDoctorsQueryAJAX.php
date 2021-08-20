<script>
    //update delete e insert
    function fntInsertMed() {

        valorNom = document.getElementById("nombre").value;
        if (valorNom == null || valorNom.length == 0 || /^\s+$/.test(valorNom)) {
            alertify.alert('MEDICAMENTOS', 'Por favor seleccione o ingrese un usuario');
            return false;
        }

        //valorMed = document.getElementById("VAL_CARRITOMED").value;
        //if (valorMed == null || valorMed.length == 0 || /^\s+$/.test(valorMed)) {
        //    alertify.alert('MEDICAMENTOS', 'Por favor seleccione al menos un medicamento');
        //    return false;
        //}

        valorMed = document.getElementById("sanitaria").value;
        if (valorMed == '' || valorMed == null || valorMed.length == 0 || /^\s+$/.test(valorMed)) {
            alertify.alert('MEDICAMENTOS', 'Por favor seleccione una unidad sanitaria');
            return false;
        }

        alertify.confirm('Aviso!', 'Seguro que desea continuar? ', function() {
            document.getElementById("loading-screen").style.display = "block";

            var datos = $('#formData').serialize();
            valorMed = document.getElementById("VAL_CARRITOMED").value;
            valorVac = document.getElementById("VAL_CARRITOVAC").value;
            valorLab = document.getElementById("VAL_CARRITOLAB").value;
            valorHosp = document.getElementById("VAL_CARRITOHOSP").value;
            valorCita = document.getElementById("proxima_cita").value;

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsQuery.php?ajax=true&validaciones=insert",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            fntSelectViewSession_()

                            if (valorCita) {
                                setTimeout(fntInsertCitaPac, 500);
                            }

                            if (valorMed) {
                                setTimeout(fntPacInsertMedPac, 900);
                                setTimeout(fntMedInsertMed, 1000);
                                setTimeout(fntPacInsertMed, 1200);
                                setTimeout(fntInsertFar, 1400);
                            }
                            if (valorVac) {
                                setTimeout(fntPacInsertVac, 1800);
                                setTimeout(fntMedInsertVac, 2000);
                            }
                            if (valorLab) {
                                setTimeout(fntPacInsertLab, 2200);
                                setTimeout(fntMedInsertLab, 2400);
                                setTimeout(fntInsertLab, 2600);

                            }
                            if (valorHosp) {
                                setTimeout(fntPacInsertHosp, 2800);
                                setTimeout(fntMedInsertHosp, 3000);
                                setTimeout(fntInsertHosp, 3200);
                            }

                            setTimeout(fntInsertConsPac, 3800);
                        }
                    } else {
                        alertify.alert('Aviso', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };

    function fntInsertConsPac() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "doctorsQuery.php?ajax=true&validaciones=insert_consulta_paciente",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        document.getElementById("loading-screen").style.display = "none";

                        alertify.confirm('Datos cargados correctamente!', 'Desea limpiar ordenes? ', function() {
                            fntLimpiarSesiones()
                        }, function() {
                            alertify.error('Cancel')
                        })

                        $('#formData')[0].reset();
                        //location.reload();
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });

        return false;
    };

    function fntInsertCitaPac() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "doctorsQuery.php?ajax=true&validaciones=insert_cita_paciente",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload();
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });

        return false;
    };
    //////////////////////////////////////////////////// INSERTS SESSIONES MEDICOS //////////////////////////////////////////////////////////

    function fntMedInsertMed() {

        var datos = $('#formDataMed').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=med_insert_med",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });

        return false;

    };

    function fntMedInsertVac() {

        var datos = $('#formDataVac').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=med_insert_vac",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;

    };

    function fntMedInsertLab() {

        var datos = $('#formDataLab').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=med_insert_lab",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;
    };

    function fntMedInsertHosp() {

        var datos = $('#formDataHosp').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=med_insert_hosp",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;

    };

    //////////////////////////////////////////////////// INSERTS SESSIONES PACIENTES //////////////////////////////////////////////////////////

    function fntPacInsertMed() {

        var datos = $('#formDataMed').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=pac_insert_med",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        // $('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });

        return false;

    };

    function fntPacInsertMedPac() {

        var datos = $('#formDataMed').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=pac_insert_med_pac",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        // $('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });

        return false;

    };

    function fntPacInsertVac() {

        var datos = $('#formDataVac').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=pac_insert_vac",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;

    };

    function fntPacInsertLab() {

        var datos = $('#formDataLab').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=pac_insert_lab",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;
    };

    function fntPacInsertHosp() {

        var datos = $('#formDataHosp').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=pac_insert_hosp",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;

    };
    //////////////////////////////////////////////////// INSERTS SESSIONES A BASES DE DATOS  //////////////////////////////////////////////////////////
    function fntInsertFar() {

        var datos = $('#formDataMed').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=insert_tmfFar",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;

    };

    function fntInsertLab() {

        var datos = $('#formDataLab').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=insert_tmflab",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;

    };

    function fntInsertHosp() {

        var datos = $('#formDataHosp').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'ajax',
            url: "doctorsQuery.php?ajax=true&validaciones=insert_tmfhosp",
            success: function(r) {
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload(); 
                    }
                } else {
                    alertify.alert('Tus Consultas', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });
        return false;

    };

    /////////////////////////////////////////////////////////////////////////////////////////


    function fntUpdate() {

        alertify.confirm('Tus Consultas', 'Seguro que desea continuar?  ', function() {
            var datos = $('#formData').serialize();
            //alert(datos);
            //return false;

            $.ajax({
                type: "POST",
                data: datos,
                dataType: 'json',
                url: "doctorsQuery.php?ajax=true&validaciones=update",
                success: function(r) {
                    if (r.status) {
                        if (r.status == 1) {
                            //$('#formData')[0].reset();
                            alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                            //location.reload(); 
                        }
                    } else {
                        alertify.alert('Tus Consultas', 'no se pudo completar!');
                        //location.reload(); 
                    }
                }
            });
        }, function() {
            alertify.error('Cancel')
        })
        return false;
    };


    function fntDibujoDropDep() {

        //alert(strPais + "                                  strPais");

        $.ajax({

            url: "doctorsPatient.php?validaciones=dibujo_dropdow_dep",
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

            url: "doctorsPatient.php?validaciones=dibujo_dropdow_mun",
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

    function fntDibujoTablaPatient() {

        var strSearch = $("#Search").val();

        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=tabla_patient",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#Tabla").html("");
                $("#Tabla").html(data);

                return false;
            }
        });

    };
    ////////////////////////////////TABLAS PRIMER NIVEL//////////////////////////////////
    function fntDibujoTablaMed() {

        var strSearch = $("#SearchMed").val();


        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_med",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableMed").html("");
                $("#tableMed").html(data);

                return false;
            }
        });

    };

    function fntDibujoTablaVaccine() {
        var strSearch = $("#SearchVac").val();


        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_vaccine",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableVaccine").html("");
                $("#tableVaccine").html(data);

                return false;
            }
        });

    };

    function fntDibujoTablaLabExa() {

        var strSearch = $("#SearchExa").val();

        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_lab_exa",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableLabExa").html("");
                $("#tableLabExa").html(data);

                return false;
            }
        });

    };

    function fntDibujoTablaHospServ() {

        var strSearch = $("#SearchServ").val();

        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_hosp_serv",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableHospServ").html("");
                $("#tableHospServ").html(data);

                return false;
            }
        });

    };
    /////////////////////////// TABLAS SEGUNDO NIVEL///////////////////////////////
    function fntDibujoTablaMedFar() {

        var strFilterFar = $("#filterMed").val();
        var strSearch = $("#SearchFar").val();

        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_med_far",
            data: {
                Search: strSearch,
                strFilterFar: strFilterFar,

            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableMedFar").html("");
                $("#tableMedFar").html(data);

                return false;
            }
        });

    };

    function fntDibujoTablaLab() {

        var strFilterLab = $("#filterExa").val();
        var strSearch = $("#SearchLab").val();

        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_lab",
            data: {
                Search: strSearch,
                strFilterLab: strFilterLab,

            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableLab").html("");
                $("#tableLab").html(data);

                return false;
            }
        });

    };

    function fntDibujoTablaHosp() {

        var strFilterHosp = $("#filterServ").val();
        var strSearch = $("#SearchHosp").val();

        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_hosp",
            data: {
                Search: strSearch,
                strFilterHosp: strFilterHosp,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableHospital").html("");
                $("#tableHospital").html(data);

                return false;
            }
        });

    };

    ////////////// IMAGENES DE MUESTRA EN TABLA //////////////////////////////////

    function fntDibujoTablaMedFarImg() {

        var strFilterFar = $("#filterMedImg").val();
        var strFilterFarPro = $("#filterMedImgPro").val();
        var strSearch = $("#SearchFar").val();

        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_med_far_img",
            data: {
                Search: strSearch,
                strFilterFar: strFilterFar,
                strFilterFarPro: strFilterFarPro,

            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableMedFarImg").html("");
                $("#tableMedFarImg").html(data);

                return false;
            }
        });

    };
    //////////////TABLAS DE VARIABLES SESSION AGREGAR ////////////////////////////////////////////////////////


    function fntEnvioFarmacia() {
        var datos = $('#formData_m').serialize();

        $.ajax({
            url: "doctorsQuery.php?validaciones=session_med_s",
            data: datos,
            type: "POST",
            dataType: "html",
            success: function(data) {
                $('#tableCarritoMed').load('doctorsQuery.php?validaciones=session_carrito_med');
                alertify.alert('Tus Consultas', 'Seleccion cargada correctamente');
                document.getElementById('sessionMedicine').style.display = 'none';
                document.getElementById('sessionVaccine').style.display = 'none';
                document.getElementById('sessionLaboratory').style.display = 'none';
                document.getElementById('sessionHospital').style.display = 'none';

                return false;
            }
        });


        //hideImgCoreLoading()
        return false;

    }



    function fntEnvioVacunas() {

        var datos = $('#v_formData').serialize();

        $.ajax({
            url: "doctorsQuery.php?validaciones=session_vac_s",
            data: datos,
            type: "POST",
            dataType: "html",
            success: function(data) {
                $('#tableCarritoVac').load('doctorsQuery.php?validaciones=session_carrito_vac');
                alertify.alert('Tus Consultas', 'Seleccion cargada correctamente');
                document.getElementById('sessionMedicine').style.display = 'none';
                document.getElementById('sessionVaccine').style.display = 'none';
                document.getElementById('sessionLaboratory').style.display = 'none';
                document.getElementById('sessionHospital').style.display = 'none';

                return false;
            }
        });


        //hideImgCoreLoading()
        return false;

    };

    function fntEnvioLaboratorio() {

        var datos = $('#formData_l').serialize();

        $.ajax({
            url: "doctorsQuery.php?validaciones=session_lab_s",
            data: datos,
            type: "POST",
            dataType: "html",
            success: function(data) {
                $('#tableCarritoLab').load('doctorsQuery.php?validaciones=session_carrito_lab');
                alertify.alert('Tus Consultas', 'Seleccion cargada correctamente');
                document.getElementById('sessionMedicine').style.display = 'none';
                document.getElementById('sessionVaccine').style.display = 'none';
                document.getElementById('sessionLaboratory').style.display = 'none';
                document.getElementById('sessionHospital').style.display = 'none';

                return false;
            }
        });


        //hideImgCoreLoading()
        return false;

    };

    function fntEnvioHospitales() {

        var datos = $('#formData_h').serialize();

        $.ajax({
            url: "doctorsQuery.php?validaciones=session_hosp_s",
            data: datos,
            type: "POST",
            dataType: "html",
            success: function(data) {
                $('#tableCarritoHosp').load('doctorsQuery.php?validaciones=session_carrito_hosp');
                alertify.alert('Tus Consultas', 'Seleccion cargada correctamente');
                document.getElementById('sessionMedicine').style.display = 'none';
                document.getElementById('sessionVaccine').style.display = 'none';
                document.getElementById('sessionLaboratory').style.display = 'none';
                document.getElementById('sessionHospital').style.display = 'none';

                return false;
            }
        });


        //hideImgCoreLoading()
        return false;

    };

    /////////////////////////////////////// ELIMINAR PRODUCTOS VARIABLE DE  SEESSION/////////////////////////////////
    function fntEnvioFarmacia_d() {
        var datos = $('#formData_m_d').serialize();

        $.ajax({
            url: "doctorsQuery.php?validaciones=session_med_d",
            data: datos,
            type: "POST",
            dataType: "html",
            success: function(data) {
                $('#tableCarritoMed').load('doctorsQuery.php?validaciones=session_carrito_med');
                alertify.alert('Tus Consultas', 'Seleccion eliminada correctamente');
                document.getElementById('sessionMedicine').style.display = 'none';
                document.getElementById('sessionVaccine').style.display = 'none';
                document.getElementById('sessionLaboratory').style.display = 'none';
                document.getElementById('sessionHospital').style.display = 'none';

                return false;
            }
        });


        //hideImgCoreLoading()
        return false;

    }



    function fntEnvioVacunas_d() {

        var datos = $('#v_formData_d').serialize();

        $.ajax({
            url: "doctorsQuery.php?validaciones=session_vac_d",
            data: datos,
            type: "POST",
            dataType: "html",
            success: function(data) {
                $('#tableCarritoVac').load('doctorsQuery.php?validaciones=session_carrito_vac');
                alertify.alert('Tus Consultas', 'Seleccion eliminada correctamente');
                $("#myModal").modal("hide");
                document.getElementById('sessionMedicine').style.display = 'none';
                document.getElementById('sessionVaccine').style.display = 'none';
                document.getElementById('sessionLaboratory').style.display = 'none';
                document.getElementById('sessionHospital').style.display = 'none';

                return false;
            }
        });


        //hideImgCoreLoading()
        return false;

    };

    function fntEnvioLaboratorio_d() {

        var datos = $('#formData_l_d').serialize();

        $.ajax({
            url: "doctorsQuery.php?validaciones=session_lab_d",
            data: datos,
            type: "POST",
            dataType: "html",
            success: function(data) {
                $('#tableCarritoLab').load('doctorsQuery.php?validaciones=session_carrito_lab');
                alertify.alert('Tus Consultas', 'Seleccion eliminada correctamente');
                // $("#sessionLaboratory").modal("hide");
                document.getElementById('sessionMedicine').style.display = 'none';
                document.getElementById('sessionVaccine').style.display = 'none';
                document.getElementById('sessionLaboratory').style.display = 'none';
                document.getElementById('sessionHospital').style.display = 'none';

                return false;
            }
        });


        //hideImgCoreLoading()
        return false;

    };

    function fntEnvioHospitales_d() {

        var datos = $('#formData_h_d').serialize();

        $.ajax({
            url: "doctorsQuery.php?validaciones=session_hosp_d",
            data: datos,
            type: "POST",
            dataType: "html",
            success: function(data) {
                $('#tableCarritoHosp').load('doctorsQuery.php?validaciones=session_carrito_hosp');
                alertify.alert('Tus Consultas', 'Seleccion eliminada correctamente');
                //  $("#sessionHospital").modal("hide");
                document.getElementById('sessionMedicine').style.display = 'none';
                document.getElementById('sessionVaccine').style.display = 'none';
                document.getElementById('sessionLaboratory').style.display = 'none';
                document.getElementById('sessionHospital').style.display = 'none';

                return false;
            }
        });


        //hideImgCoreLoading()
        return false;

    };

    //////////////////////////////////////////////LLENAR FORMULARIOS DE SESIONES //////////////////////////////////////////////////////////////////////

    function fntSelectSessionMed(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strid = $("#hid_id_" + intParametro).val();
            var strctg_fap_nomcom = $("#hid_ctg_fap_nomcom_" + intParametro).val();
            var strctg_far_nomcom = $("#hid_ctg_far_nomcom_" + intParametro).val();
            var strctg_fap_contrato = $("#hid_ctg_fap_contrato_" + intParametro).val();
            var strctg_far_code = $("#hid_ctg_far_code_" + intParametro).val();
            var strctg_fap_pre = $("#hid_ctg_fap_pre_" + intParametro).val();
            var strctg_fap_pro = $("#hid_ctg_fap_pro_" + intParametro).val();
            var strctg_far_email = $("#hid_ctg_far_email_" + intParametro).val();
            var strcantidad = $("#hid_cantidad_" + intParametro).val();
            var strNombreProd = $("#hidtrNameProd_" + intParametro).val();
            //var strNombreProd = $('#hidtrNameProd_' + intParametro).text();

            //alert(strNombreProd + "                         strNombreProd");
            $("#m_id").val(strid);
            $("#ctg_fap_nomcom").val(strctg_fap_nomcom);
            $("#ctg_far_nomcom").val(strctg_far_nomcom);
            $("#ctg_fap_contrato").val(strctg_fap_contrato);
            $("#ctg_far_code").val(strctg_far_code);
            $("#ctg_fap_pre").val(strctg_fap_pre);
            $("#ctg_fap_pro").val(strctg_fap_pro);
            $("#ctg_far_email").val(strctg_far_email);
            $("#cantidad").val(strcantidad);
            $('#receta').val($.trim($('#receta').val()) + ' \n\n\n ' + strNombreProd + ':    <br>');
        }

        fntEnvioFarmacia()

    }

    function fntSelectMed(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {

            var strNombreProd = $('#trNameProd_' + intParametro).text();
            $('#receta').val($.trim($('#receta').val()) + ' \n\n\n ' + strNombreProd + ':    <br>');
        }

        alertify.alert('Medicamento', 'Datos cargados en indicaciones de la receta');

    }

    function fntSelectSessionVac(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strid = $("#hidv_id_" + intParametro).val();
            var strmed_vac_nom = $("#hidv_med_vac_nom_" + intParametro).val();
            var strmed_vac_id = $("#hidv_med_vac_id_" + intParametro).val();
            var strmed_vac_precio = $("#hidv_med_vac_precio_" + intParametro).val();
            var strv_cantidad = $("#hidv_cantidad_" + intParametro).val();

            // alert(strid + "                         strDPI");

            $("#v_id").val(strid);
            $("#med_vac_nom").val(strmed_vac_nom);
            $("#med_vac_id").val(strmed_vac_id);
            $("#med_vac_precio").val(strmed_vac_precio);
            $("#v_cantidad").val(strv_cantidad);
        }

        fntEnvioVacunas()

    }

    function fntSelectSessionLab(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strid = $("#hidl_id_" + intParametro).val();
            var strctg_lce_descrip = $("#hidl_ctg_lce_descrip_" + intParametro).val();
            var strctg_lab_nomcom = $("#hidl_ctg_lab_nomcom_" + intParametro).val();
            var strctg_lce_code = $("#hidl_ctg_lce_code_" + intParametro).val();
            var strctg_lce_contrato = $("#hidl_ctg_lce_contrato_" + intParametro).val();
            var strctg_lab_contrato = $("#hidl_ctg_lab_contrato_" + intParametro).val();
            var strctg_lab_code = $("#hidl_ctg_lab_code_" + intParametro).val();
            var strctg_lce_pre = $("#hidl_ctg_lce_pre_" + intParametro).val();
            var strctg_lab_email = $("#hidl_ctg_lab_email_" + intParametro).val();
            var strl_cantidad = $("#hidl_cantidad_l_" + intParametro).val();

            //alert(strl_cantidad + "                         strDPI");
            $("#id_l").val(strid);
            $("#ctg_lce_descrip").val(strctg_lce_descrip);
            $("#ctg_lab_nomcom").val(strctg_lab_nomcom);
            $("#ctg_lce_code").val(strctg_lce_code);
            $("#ctg_lce_contrato").val(strctg_lce_contrato);
            $("#ctg_lab_contrato").val(strctg_lab_contrato);
            $("#ctg_lab_code").val(strctg_lab_code);
            $("#ctg_lce_pre").val(strctg_lce_pre);
            $("#ctg_lab_email").val(strctg_lab_email);
            $("#l_cantidad").val(strl_cantidad);
        }

        fntEnvioLaboratorio()

    }

    function fntSelectSessionHosp(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strid = $("#hidh_id_" + intParametro).val();
            var strctg_hpp_descrip = $("#hidh_ctg_hpp_descrip_" + intParametro).val();
            var strctg_hos_nomcom = $("#hidh_ctg_hos_nomcom_" + intParametro).val();
            var strctg_hos_contrato = $("#hidh_ctg_hos_contrato_" + intParametro).val();
            var strctg_hos_code = $("#hidh_ctg_hos_code_" + intParametro).val();
            var strctg_hpp_code = $("#hidh_ctg_hpp_code_" + intParametro).val();
            var strctg_hpp_contrato = $("#hidh_ctg_hpp_contrato_" + intParametro).val();
            var strctg_hpp_pre = $("#hidh_ctg_hpp_pre_" + intParametro).val();
            var strctg_hos_email = $("#hidh_ctg_hos_email_" + intParametro).val();
            var strcantidad_h = $("#hidh_cantidad_" + intParametro).val();

            // alert(strDPI + "                         strDPI");
            $("#id_h").val(strid);
            $("#ctg_hpp_descrip").val(strctg_hpp_descrip);
            $("#ctg_hos_nomcom").val(strctg_hos_nomcom);
            $("#ctg_hos_contrato").val(strctg_hos_contrato);
            $("#ctg_hos_code").val(strctg_hos_code);
            $("#ctg_hpp_code").val(strctg_hpp_code);
            $("#ctg_hpp_contrato").val(strctg_hpp_contrato);
            $("#ctg_hpp_pre").val(strctg_hpp_pre);
            $("#ctg_hos_email").val(strctg_hos_email);
            $("#cantidad_h").val(strcantidad_h);
        }

        fntEnvioHospitales()

    }

    //////////////////////////////////////////////LLENAR FORMULARIOS DE SESIONES //////////////////////////////////////////////////////////////////////

    function fntSelectSessionMed_d(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strid = $("#hidf_d_id_" + intParametro).val();
            // alert(strDPI + "                         strDPI");
            $("#m_id_d").val(strid);
        }

        fntEnvioFarmacia_d()
    }

    function fntSelectSessionVac_d(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strid = $("#hidv_id_d_" + intParametro).val();

            //alert(strid + "                         strDPI");

            $("#v_id_d").val(strid);
        }

        fntEnvioVacunas_d()

    }

    function fntSelectSessionLab_d(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strid = $("#hidl_id_d_" + intParametro).val();

            // alert(strDPI + "                         strDPI");
            $("#id_l_d").val(strid);
        }

        fntEnvioLaboratorio_d()

    }

    function fntSelectSessionHosp_d(intParametro) {
        intParametro = !intParametro ? 0 : intParametro;
        if (intParametro > 0) {
            var strid = $("#hidh_id_d_" + intParametro).val();

            // alert(strDPI + "                         strDPI");
            $("#id_h_d").val(strid);
        }

        fntEnvioHospitales_d()

    }

    //////////////////////////////////////////////DIBUJO CARRITOS///////////////////////////

    function fntDibujoTablaCarritoMed() {

        $.ajax({

            url: "doctorsQuery.php?validaciones=session_carrito_med",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableCarritoMed").html("");
                $("#tableCarritoMed").html(data);

                return false;
            }
        });

    };

    function fntDibujoTablaCarritoVac() {

        $.ajax({

            url: "doctorsQuery.php?validaciones=session_carrito_vac",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableCarritoVac").html("");
                $("#tableCarritoVac").html(data);

                return false;
            }
        });

    };

    function fntDibujoTablaCarritoLab() {

        $.ajax({

            url: "doctorsQuery.php?validaciones=session_carrito_lab",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableCarritoLab").html("");
                $("#tableCarritoLab").html(data);

                return false;
            }
        });

    };

    function fntDibujoTablaCarritoHosp() {

        $.ajax({

            url: "doctorsQuery.php?validaciones=session_carrito_hosp",
            data: {},
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableCarritoHosp").html("");
                $("#tableCarritoHosp").html(data);

                return false;
            }
        });

    };

    function fntLimpiarSesiones() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "doctorsQuery.php?ajax=true&validaciones=LimpiarSesiones",
            success: function(r) {
                location.reload();
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        //alertify.alert('Tus Consultas', 'Datos cargados correctamente');
                        //location.reload();
                    }
                } else {
                    alertify.alert('Aviso', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });

        return false;
    };

    function fntLimpiarSesionesLocal() {

        var datos = $('#formData').serialize();
        //alert(datos);
        //return false;

        $.ajax({
            type: "POST",
            data: datos,
            dataType: 'json',
            url: "doctorsQuery.php?ajax=true&validaciones=LimpiarSesionesLocal",
            success: function(r) {
                location.reload();
                if (r.status) {
                    if (r.status == 1) {
                        //$('#formData')[0].reset();
                        alertify.alert('Aviso', 'Se limpiaron los carritos');
                        //location.reload();
                    }
                } else {
                    alertify.alert('Aviso', 'no se pudo completar!');
                    //location.reload(); 
                }
            }
        });

        return false;
    };


    function fntDibujoTablaDietas() {

        var strSearch = $("#SearchDieta").val();

        //alert(strCategori + "                                  strCategori");

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_dietas",
            data: {
                Search: strSearch,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableDietas").html("");
                $("#tableDietas").html(data);

                return false;
            }
        });

    };

    //////////////// HISTORIAL MEDICO DEL PACIENTE

    function fntInfoPatient() {

        $('#modalTablaHistorial').modal('show')

        fntDibujoHistorialMedic()

    };

    function fntDibujoHistorialMedic() {

        var strCode = $("#code").val();

        $.ajax({

            url: "doctorsQuery.php?validaciones=table_historial_medic",
            data: {
                code: strCode,
            },
            async: true,
            global: false,
            type: "post",
            dataType: "html",
            success: function(data) {

                $("#tableHistorial").html("");
                $("#tableHistorial").html(data);

                return false;
            }
        });

    };


    // window.addEventListener('load', fntSessionVac, false)
    window.addEventListener('load', fntDibujoTablaPatient, false)
    window.addEventListener('load', fntDibujoDropDep, false)
    window.addEventListener('load', fntDibujoTablaDietas, false)

    //DIBUJO DE CARRITOS WINDOWS
    window.addEventListener('load', fntDibujoTablaCarritoMed, false)
    window.addEventListener('load', fntDibujoTablaCarritoVac, false)
    window.addEventListener('load', fntDibujoTablaCarritoLab, false)
    window.addEventListener('load', fntDibujoTablaCarritoHosp, false)
</script>