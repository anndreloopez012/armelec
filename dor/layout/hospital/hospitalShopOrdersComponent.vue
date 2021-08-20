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
                                    <h3 class="card-title">Nuevo</h3>
                                    <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body " style="display: block;">
                                    <div class="row">
                                        <div class="form-group row col-sm-12">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Fecha</label>
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control float-left" id="namePac" placeholder="Nombre Del Paciente">
                                            </div>
                                            <div class="form-group float-right">
                                                <a data-toggle="modal" data-target=".addPerfilInfo"><i class="fad fa-id-card fa-2x"></i>&nbsp&nbsp</a>
                                                <a data-toggle="modal" data-target=".addProduct"><i class="fad fa-id-card fa-2x"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group row col-sm-12">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nombre Del Paciente</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control float-left" id="namePac" placeholder="Nombre Del Paciente">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Nombre Del Prodcuto</label>
                                            <div class="col-sm-4">
                                                <input type="number" class="form-control float-left" id="Valor" placeholder="valor">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Precio Del Producto</label>
                                                <input type="text" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Unidades</label>
                                                <input type="text" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Descuento</label>
                                            <div class="form-group row">
                                                
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" placeholder="Enter ...">
                                                </div>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" placeholder="Enter ...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Fecha</th>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>% Dto.</th>
                                                    <th>Descuento</th>
                                                    <th>Examenes</th>
                                                    <th>Total</th>
                                                    <th>DELETE</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td>DATOS</td>
                                                <td>DATOS</td>
                                                <td>DATOS</td>
                                                <td>DATOS</td>
                                                <td>DATOS</td>
                                                <td>DATOS</td>
                                                <td>DATOS</td>
                                                <td>X</td>
                                            </tr>
                                        </table>
                                        <br><br>
                                    <div class="form-group row">
                                        <div class="col-sm-6"></div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            <button class="btn btn-block btn-primary btn-flat" type="button"><i class="far fa-save"> Guardar</i></button>
                                            </div>
                                        </div>                
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                            <button class="btn btn-block btn-primary btn-flat" type="button"><i class="far fa-save"> Cancelar</i></button>
                                            </div>
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


