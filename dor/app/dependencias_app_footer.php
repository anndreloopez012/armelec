<script src="../../lib/alertify/alertify.js"></script>
<script src="../../lib/plugins/chart.js/Chart.min.js"></script>
<script src="../../lib/plugins/sparklines/sparkline.js"></script>
<script src="../../lib/plugins/moment/moment.min.js"></script>
<script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
<script>$(document).ready(function() { $('body').bootstrapMaterialDesign(); });</script>

<script type="text/javascript" src="../../lib/jquery_upload/js/jquery.form.js"></script>
<script type="text/javascript" src="../../lib/jquery_upload/js/jquery.uploadfile.js"></script>

<!-- ALERTS MODAL JS -->
<script src="../../lib/alertify/alertify.js"></script>
<script src="../../lib/alertify/alertify.min.js"></script>
<!-- SEC  JS -->
<script>
$(document).ready(function(){
  $("#bloquear").on('paste', function(e){
    e.preventDefault();
    alert('Esta acción está prohibida');
  })
  
  $("#bloquear").on('copy', function(e){
    e.preventDefault();
    alert('Esta acción está prohibida');
  })
})
</script>
</body>
</html>