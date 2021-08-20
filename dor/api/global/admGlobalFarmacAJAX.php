<script>


    function fntDibujoTablaMedFar() {

        var strFilterFar = $("#filterMed").val();
        var strSearch = $("#SearchMed").val();

        //alert(strCategori + "                                  strCategori");
        document.getElementById("loading-screen").style.display = "block";

        $.ajax({

            url: "globalFarmac.php?validaciones=table_med_far",
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
                document.getElementById("loading-screen").style.display = "none";
                return false;
            }
        });

    };


    window.addEventListener('load', fntDibujoTablaMedFar, false)
</script>