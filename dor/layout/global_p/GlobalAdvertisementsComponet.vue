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
                                <div class="card-body " style="display: none;">
                                    <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Publicacion</label>
                                                <input type="date" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Titulo</label>
                                                <input type="text" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Contenido</label>
                                                <textarea type="text" class="form-control" placeholder="Enter ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="inputSex">Duracion</label>
                                                <select class="form-control custom-select">
                                                <option selected disabled>Seleccione cuantos dias</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                </select>
                                            </div>
                                        </div>    
                                        
                                        <div class="col-sm-7">
                                            <label for="inputSex">Buscar</label>
                                            <div class="custom-file">
                                                <input id="customFile" class="custom-file-input" type="file">
                                                <label class="custom-file-label" for="customFile">Ruta del archivo</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <button class="btn btn-block btn-success btn-flat" type="button"><i class="far fa-save"> Guardar</i></button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-2"></div>    
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
                                                    <th>Titulo</th>
                                                    <th>Contenido</th>
                                                    <th>Imagen</th>
                                                    <th>Duracion</th>
                                                    <th>Status</th>
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
                                                <td>X</td>
                                            </tr>
                                        </table>
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
