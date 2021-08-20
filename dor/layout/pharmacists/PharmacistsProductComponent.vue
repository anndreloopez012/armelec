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
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Escriba el nombre del medicamento o el principio activo">
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <a data-toggle="modal" data-target=".addProductTwo"><i class="fad fa-books fa-2x"></i>&nbsp&nbsp</a>
                                                    <a data-toggle="modal" data-target=".addProduct"><i class="fad fa-pills fa-2x"></i>&nbsp&nbsp</a>
                                                    <a href="#"><i class="fad fa-trash-alt fa-2x"></i></a>
                                                 </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre Del Producto</th>
                                                    <th>Principio Activo</th>
                                                    <th>Fabricante</th>
                                                    <th>Autorizado</th>
                                                    <th>Vence</th>
                                                    <th>Sel</th>
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
<!-- MODAL Add/view Product -------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade bd-example-modal-lg addProduct" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tus Prodcutos/Agregar</h3>
                    </div>
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Escriba el nombre del producto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No. De Reg.</th>
                            <th>Nombre</th>
                            <th>Principio Activo</th>
                            <th>Fabricante</th>
                            <th>Autorizado</th>
                            <th>Vence</th>
                            <th>BUY</th>
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
<!-- MODAL Add Product -------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="modal fade bd-example-modal-lg addProductTwo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tus Prodcutos/Agregar</h3>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                    <label>Nombre Del Producto</label>
                                    <input type="text" class="form-control" placeholder="Escriba el nombre del Prodcuto ">
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label>Nombre Del Fabricante</label>
                                    <input type="text" class="form-control" placeholder="Escriba el nombre del Fabricante ">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label>Img</label>
                                    <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <button class="btn btn-block btn-primary btn-flat" type="button"><i class="far fa-save"> Guardar</i></button>
                                    </div>
                                </div>
                                <div class="col-sm-4"></div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
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
