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
<!-- GENERAL ---------------------------------------------------------------------------------------->
            <section class="content col-md-9">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Medicamentos Suministrados Actualmente</h3>
                                    <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                            <label>Medicamento</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label>Cronico</label>
                                                </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Frecuencia</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                            <label>FInalizacion</label>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Escriba el nombre del medicamento ">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <select class="form-control">
                                                <option>no</option>
                                                <option>si</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option>Semanal</option>
                                                    <option>Quincenal</option>
                                                    <option>Mensual</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <input type="date" class="form-control" placeholder="Enter ..." >
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label>Tiene alguna discapacidad?</label>
                                            <select class="form-control">
                                                <option>no</option>
                                                <option>si</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label>Cual</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Escriba el nombre del medicamento ">
                                            </div>
                                        </div>
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
