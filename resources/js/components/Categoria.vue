<template>
            <main class="main main-footer">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    
                    
                    <template v-if="listado==1">
                        <div class="card-header">
                        <i class="fa fa-align-justify" ></i> Categorías
                        <button type="button" class="btn btn-secondary" @click="mostrarDetalle()">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group" >
                                        <select class="form-control col-md-3" v-model="criterio">
                                        <option value="nombre">Nombre</option>
                                        <option value="descripcion">Descripción</option>
                                        </select>
                                        <input type="text" v-model="buscar" @keyup.enter="listarCategoria(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarCategoria(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <table class=" table table-bordered table-striped table-sm ">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" style="color:#fff ;font-size: 13px; padding: 5px 7px;">
                                                <i class="fa  fa-edit"  aria-hidden="true" ></i>

                                            </button> 
                                            <template v-if="categoria.condicion">
                                                <button type="button" class="btn btn-danger btn-sm" @click="desactivarCategoria(categoria.id)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </template>
                                            <template v-else>
                                                <button type="button" class="btn btn-info btn-sm" @click="activarCategoria(categoria.id)">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </template>
                                        </td>
                                        <td v-text="categoria.nombre"></td>
                                        <td v-text="categoria.descripcion"></td>
                                        <td>
                                            <div v-if="categoria.condicion">
                                                <span class="badge badge-success">Activo</span>
                                            </div>
                                            <div v-else>
                                                <span class="badge badge-danger">Desactivado</span>
                                            </div>
                                            
                                        </td>
                                    </tr>                                
                                </tbody>
                            </table>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                    </li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </template>
                    <!--Fin Listado-->
                    <!-- Detalle-->
                    <template v-else-if="listado==0">
                        <div class=" card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Nueva Categoria</h3>
                            </div>
                            <div class="row">

                                <!-- /.card-header -->
                                <!-- form start -->
                
                                <div class="col-md-6">
                                    <div class="card-body ">
                                        <div class="form-group">
                                            <label for="exampleInputCategoria">Categorias</label>
                                            <input type="text" v-model="nombre" class="form-control" id="exampleInputCategoria" placeholder="categoria">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputDescripcion">Descripcion</label>
                                            
                                            <textarea type="text" v-model="descripcion" class="form-control" id="exampleInputDescripcion" placeholder="descripcion" ></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Imagen</label>
                                            <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Imagen</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Subir</span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Estado</label>
                                        </div><br>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                                <button type="button" class="btn btn-primary" @click="registrarCategoria()">Registrar Venta</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!-- /.card-body -->

                
                
                                <div class="col-md-6">
                                    <div class="card-body ">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tittle</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="tittle">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Description</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="description">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Keyword</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="keyword">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Slug</label>
                                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="slug">
                                        </div>
                                        
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div>
                                    </div>

                                       

                                </div>

                                 
                            
                            </div>
                        </div>
                    </template>
                    <!-- Fin Detalle-->
                    <!-- Ver ingreso -->
                    <template v-else-if="listado==2">
                        <div class="card-body">
                            <div class="form-group row border">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="">Cliente</label>
                                        <p v-text="cliente"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Impuesto</label>
                                    <p v-text="impuesto"></p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipo Comprobante</label>
                                        <p v-text="tipo_comprobante"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Serie Comprobante</label>
                                        <p v-text="serie_comprobante"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Número Comprobante</label>
                                        <p v-text="num_comprobante"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row border">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Artículo</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Descuento</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody v-if="arrayDetalle.length">
                                            <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                                <td v-text="detalle.articulo">
                                                </td>
                                                <td v-text="detalle.precio">
                                                </td>
                                                <td v-text="detalle.cantidad">
                                                </td>
                                                <td v-text="detalle.descuento">
                                                </td>
                                                <td>
                                                    {{detalle.precio*detalle.cantidad-detalle.descuento}}
                                                </td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total Parcial:</strong></td>
                                                <td>$ {{totalParcial=(total-totalImpuesto).toFixed(2)}}</td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total Impuesto:</strong></td>
                                                <td>$ {{totalImpuesto=((total*impuesto)).toFixed(2)}}</td>
                                            </tr>
                                            <tr style="background-color: #CEECF5;">
                                                <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                                <td>$ {{total}}</td>
                                            </tr>
                                        </tbody>
                                        <tbody v-else>
                                            <tr>
                                                <td colspan="5">
                                                    NO hay artículos agregados
                                                </td>
                                            </tr>
                                        </tbody>                                    
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                    
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data (){
            return {
                categoria_id: 0,
                nombre : '',
                descripcion : '',
                arrayCategoria : [],
                modal : 0,
                listado:1,
                tituloModal : '',
                tipoAccion : 0,
                errorCategoria : 0,
                errorMostrarMsjCategoria : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarCategoria (page,buscar,criterio){
                let me=this;
                var url= '/categoria?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCategoria = respuesta.categorias.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            ocultarDetalle(){
                this.listado=1;
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCategoria(page,buscar,criterio);
            },
            registrarCategoria(){
                if (this.validarCategoria()){
                    return;
                }
                
                let me = this;

                axios.post('/categoria/registrar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            
            actualizarCategoria(){
               if (this.validarCategoria()){
                    return;
                }
                
                let me = this;

                axios.put('/categoria/actualizar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'id': this.categoria_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoria(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;

               
            },
            desactivarCategoria(id){
               swal({
                title: 'Esta seguro de desactivar esta categoría?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/categoria/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarCategoria(id){
               swal({
                title: 'Esta seguro de activar esta categoría?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/categoria/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarCategoria(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarCategoria(){
                this.errorCategoria=0;
                this.errorMostrarMsjCategoria =[];

                if (!this.nombre) this.errorMostrarMsjCategoria.push("El nombre de la categoría no puede estar vacío.");

                if (this.errorMostrarMsjCategoria.length) this.errorCategoria = 1;

                return this.errorCategoria;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.descripcion='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "categoria":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Categoría';
                                this.nombre= '';
                                this.descripcion = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar categoría';
                                this.tipoAccion=2;
                                this.categoria_id=data['id'];
                                this.nombre = data['nombre'];
                                this.descripcion= data['descripcion'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarCategoria(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
