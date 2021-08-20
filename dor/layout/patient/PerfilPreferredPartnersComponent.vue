<template>
    <main class="main">
        <div class="content-header">
            <div class="container-fluid">
                <input type="hidden" id="titlePage" v-model="titlePage">
            </div>
        </div>
    <section class="content col-md-12">
        <div class="container-fluid">
          <div class="row">
            <section class="content col-md-9">
                <div class="container-fluid">
                    <div class="row">
<!-- GENERAL ---------------------------------------------------------------------------------------->
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                    <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputName">Tu Farmacia Preferida</label>
                                        <input type="text" id="inputName" class="form-control" placeholder="Buscar farmacia">
                                        <input type="text" id="inputName" class="form-control" placeholder="Direccion" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Tu Laboratorio Clinico Preferido</label>
                                        <input type="text" id="inputName" class="form-control" placeholder="Buscar laboratorio">
                                        <input type="text" id="inputName" class="form-control" placeholder="Direccion" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputClientCompany">Tu Hospital Preferido</label>
                                        <input type="text" id="inputClientCompany" class="form-control" placeholder="Buscar hospital">
                                        <input type="text" id="inputName" class="form-control" placeholder="Direccion" disabled> 
                                    </div>
                                </div>
                            </div>
                        </div>                     
                    </div>
                </div>
            </section>
<!-- PUBLICIDAD -------------------------------------------------------------------------------------------------------------------------------------------------->
              <template>
                  <promotion></promotion>
              </template>
        </div>
    </div>
</section>
</main>
</template>

<script>
    import Vuetify from 'vuetify';
    import 'vuetify/dist/vuetify.min.css';
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
