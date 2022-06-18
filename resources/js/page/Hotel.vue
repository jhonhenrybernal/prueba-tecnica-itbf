<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>{{namePage}}</h2>
                <table class="table text-center"><!--Creamos una tabla que mostrará todas las tareas-->
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Numero habitantes</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Nit</th>
                                 <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="hotel in hoteles" :key="hotel.id"> <!--Recorremos el array y cargamos nuestra tabla-->
                                <td v-text="hotel.nombre"></td>
                                <td v-text="hotel.ciudad"></td>
                                <td v-text="hotel.num_habitantes"></td>
                                <td v-text="hotel.direccion"></td>
                                <td v-text="hotel.nit"></td>
                                <td>
                                    <!--Botón modificar, que carga los datos del formulario con la tarea seleccionada-->
                                    <button class="btn" @click="updateHotel(hotel)">Modificar</button>
                                    <!--Botón que borra la tarea que seleccionemos-->
                                    <button class="btn" @click="deleteHotel(hotel)">Borrar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6">
                <div class="form-group"><!-- Formulario para la creación o modificación de nuestras tareas-->
                    <label>Nombre</label>
                    <input v-model="nombre" type="text" class="form-control">

                    <label>Ciudad</label>
                    <input v-model="ciudad" type="text" class="form-control">

                    <label>Numero habitantes</label>
                    <input v-model="num_habitantes" type="number" class="form-control">

                    <label>Direccion</label>
                    <input v-model="direccion" type="text" class="form-control">

                    <label>Nit</label>
                    <input v-model="nit" type="number" class="form-control">
                </div>
                <br>
                <div class="container-buttons">
                    <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
                    <button v-if="update == 0" @click="saveHotel()" class="btn btn-success">Añadir</button>
                    <!-- Botón que modifica la tarea que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="updateHotel()" class="btn btn-warning">Actualizar</button>
                    <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                namePage:'Hoteles',
                nombre:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                ciudad:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                num_habitantes:"",
                direccion:"",
                nit:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                update:0, /*Esta variable contrarolará cuando es una nueva tarea o una modificación, si es 0 significará que no hemos seleccionado
                          ninguna tarea, pero si es diferente de 0 entonces tendrá el id de la tarea y no mostrará el boton guardar sino el modificar*/
                hoteles:[], //Este array contendrá las tareas de nuestra bd
            }
        },
        methods:{
            getHotel(){
                let me =this;
                let url = '/api/hoteles' //Ruta que hemos creado para que nos devuelva todas las tareas
                axios.get(url).then(function (response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.hoteles = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            saveHotel(){
                let me =this;
                let url = '/api/hoteles' //Ruta que hemos creado para enviar una tarea y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la tarea
                    'nombre':this.nombre,
                    'ciudad':this.ciudad,
                    'num_habitantes':this.num_habitantes,
                    'direccion':this.direccion,
                    'nit':this.nit,
                }).then(function (response) {
                    me.getHotel();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                    me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });   

            },
            updateHotel(){/*Esta funcion, es igual que la anterior, solo que tambien envia la variable update que contiene el id de la
                tarea que queremos modificar*/
                let me = this;
                axios.put('/api/hoteles',{
                    'nombre':this.nombre,
                    'ciudad':this.ciudad,
                    'num_habitantes':this.num_habitantes,
                    'direccion':this.direccion,
                    'nit':this.nit,
                }).then(function (response) {
                   me.getHotel();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                   me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            updateHotel(data){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
                this.update = data.id
                let me =this;
                let url = '/api/hoteles/'+this.update;
                axios.get(url).then(function (response) {
                    me.nombre=response.nombre;
                    me.ciudad=response.ciudad;
                    me.num_habitantes=response.num_habitantes;
                    me.direccion=response.direccion;
                    me.nit=response.nit;

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                }); 
            },
            deleteHotel(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
                let me =this;
                let id = data.id
                if (confirm('¿Seguro que deseas borrar este hotel?')) {
                    axios.delete('/api/hoteles'+id
                    ).then(function (response) {
                        me.getHotel();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){/*Limpia los campos e inicializa la variable update a 0*/
                this.nombre=''
                this.ciudad=''
                this.num_habitantes=''
                this.direccion=''
                this.nit=''
            }
        },
        mounted() {
           this.getHotel();
        }
    }
</script>