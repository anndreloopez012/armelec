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
                        <div class="ex1">
                            <div class="col-md-12">
                                <div id="accordion">
                                    <div class="card card-success">
                                        <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Pedido No. -321654- &nbsp&nbsp Fecha -20/20/1234- &nbsp&nbsp Origen -Medico-
                                            </button>
                                        </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <form class="form-horizontal">
                                                    <div class="card-body">
                                                    <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-1 col-form-label">No. Pedido</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control float-left" id="noPed" placeholder="No. Pedido">
                                                        </div>
                                                        <label for="inputEmail3" class="col-sm-1 col-form-label">Fecha</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control float-left" id="date" placeholder="Fecha">
                                                        </div>
                                                        <label for="inputEmail3" class="col-sm-1 col-form-label">Origen</label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control float-left" id="Origen" placeholder="Origen">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Nombre Del Paciente</label>
                                                        <div class="col-sm-7">
                                                            <input type="text" class="form-control float-left" id="namePac" placeholder="Nombre Del Paciente">
                                                        </div>
                                                        <label for="inputPassword3" class="col-sm-1 col-form-label">Valor</label>
                                                        <div class="col-sm-2">
                                                            <input type="number" class="form-control float-left" id="Valor" placeholder="valor">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword3" class="col-sm-1 col-form-label">Telefono</label>
                                                        <div class="col-sm-3">
                                                            <input type="number" class="form-control float-left" id="tel" placeholder="Telefono">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputPassword3" class="col-sm-2 col-form-label">Descripcion De entrega</label>
                                                        <div class="col-sm-10">
                                                            <textarea rows="3" class="form-control" placeholder="Escribe la descripcion"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label>Descripcion Del Pedido</label>
                                                            <input type="text" class="form-control float-left" id="descrip1" placeholder="Nombre del producto, utilidades, precio.">
                                                            <input type="text" class="form-control float-left" id="descrip2" placeholder="Nombre del producto, utilidades, precio.">
                                                            <input type="text" class="form-control float-left" id="descrip3" placeholder="Nombre del producto, utilidades, precio.">
                                                            <input type="text" class="form-control float-left" id="descrip4" placeholder="Nombre del producto, utilidades, precio.">
                                                           
                                                        </div>
                                                    </div>
                                                    
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6"></div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <button class="btn btn-block btn-primary btn-flat" type="button"><i class="far fa-save"> Anulada</i></button>
                                                            </div>
                                                        </div>                
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                            <button class="btn btn-block btn-primary btn-flat" type="button"><i class="far fa-save"> Procesda</i></button>
                                                            </div>
                                                        </div>
                                                    </div>                                           
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-success">
                                        <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Collapsible Group Item #2
                                            </button>
                                        </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card card-success">
                                        <div class="card-header" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Collapsible Group Item #3
                                            </button>
                                        </h5>
                                        </div>
                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div><br>
                        <div class="col-sm-6"></div><br>
                        <div class="col-sm-3">
                            <div class="form-group">
                            <button class="btn btn-block btn-primary btn-flat" type="button"><i class="far fa-save"> Pedido De Tienda</i></button>
                            </div>
                        </div>                
                        <div class="col-sm-3">
                            <div class="form-group">
                            <button class="btn btn-block btn-primary btn-flat" type="button"><i class="far fa-save"> Regresar</i></button>
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
