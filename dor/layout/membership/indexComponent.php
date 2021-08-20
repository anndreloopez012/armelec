<section class="content col-md-12">
    <p>
    <p>
    <p>
    <p>

        <?php $session = $_SESSION['adm_usr_tipo']; ?>
        <a class="btn btn-raised btn-info" <?php if ($session == 'pac') {
                                            ?> href="../patient" <?php
                                            } elseif ($session == 'med') {
                                                ?> href="../doctors" <?php
                                            }elseif ($session == 'far') {
                                                ?> href="../pharmacists" <?php
                                            }elseif ($session == 'hos') {
                                                ?> href="../hospital" <?php
                                            }elseif ($session == 'lab') {
                                                ?> href="../laboratory" <?php
                                            } ?> role="button" aria-expanded="false">Inicio</a>
    </p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-md-1 "></div>
            <div class="col-xl-8 col-md-10 ">
                <div class=" collapse show" id="personalInfo">
                    <div class="card card-body">
                        <form id="formData" method="POST">
                            <div class="card card-primary">
                                <div class="col-12">
                                    <div class="col-12">
                                        <h3>Transferencias Bancarias</h3><br>
                                        <p>Aqui va la informacion en formato de texto.</p>
                                    </div>
                                    <div class="col-12">
                                        <h3>Pago con Targeta de Credito/Debito</h3><br>
                                        <p>Aqui va la informacion en formato de texto 1.</p>
                                        <p>Aqui va la informacion en formato de texto 2.</p>
                                        <p>Aqui va la informacion en formato de texto 3.</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-1 "></div>
        </div>
    </div>
</section>

<script>

</script>
<style>
    .color-label {
        color: #03a9f4 !important;
    }

    a.btn-center {
        text-align: center !important;
    }

    .custom-file-control,
    .form-control,
    .is-focused .custom-file-control,
    .is-focused .form-control {
        background-image: linear-gradient(0deg,
                #03a9f4 2px, rgba(0, 150, 136, 0) 0), linear-gradient(0deg, rgba(0, 0, 0, .26) 1px,
                transparent 0) !important;
    }
</style>