<template>
    <div class="container container-task">
        <div class="row">
            <div class="col-md-6">
                <h2>{{namePage}}</h2>
                <table class="table text-center"><!--Creamos una tabla que mostrará todas las tareas-->
                        <thead>
                            <tr>                              
                                <th scope="col">Cantidad</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Acomodacion</th>
                                <th scope="col">Nombre Hotel</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="habitacion in habitaciones" :key="habitacion.id"> <!--Recorremos el array y cargamos nuestra tabla-->
                                <td v-text="habitacion.cantidad"></td>
                                <td v-text="habitacion.tipo"></td>
                                <td v-text="habitacion.acomodacion"></td>
                                <td v-text="habitacion.hotel.nombre"></td>
                                <td>
                                    <!--Botón modificar, que carga los datos del formulario con la tarea seleccionada-->
                                    <button class="btn" @click="loadFieldsUpdate(habitacion)">Modificar</button>
                                    <!--Botón que borra la tarea que seleccionemos-->
                                    <button class="btn" @click="deleteTask(habitacion)">Borrar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6">
                <div class="form-group"><!-- Formulario para la creación o modificación de nuestras tareas-->
                    <div v-if="viewAlert"  v-bind:class="{'alert alert-danger':activeDanger,'alert alert-success':activeSuccess}" role="alert">
                        {{listMessageAlert.message}}
                        <div v-for="(errorArray, idx) in listMessageAlert.errors" :key="idx">
                            {{ errorArray.join(' ')}} 
                        </div> 
                    </div>
                     <select v-model="hotel_id" class="form-control">
                        <option v-for="hotel in hoteles" :key="hotel.id"  v-bind:value="hotel.id">{{hotel.nombre}}</option>
                    </select>
                    <label>Cantidad {{calcCantHabitaciones}}</label>
                    <input v-model="cantidad" type="number" class="form-control">
                    <label>Tipo</label>
                      <select v-model="tipo" class="form-control" @change="selectTipo(tipo)">
                        <option v-for="list in listTipo" :key="list.id"  v-bind:value="list.id">{{list.name}}</option>
                    </select>
                    <label>Acomodacion</label>
                    <input v-model="tipoSelectAsing" type="text" class="form-control" disabled>
                    <label>Nombre Hotel</label>
                   
                </div>
                <br>
                <div class="container-buttons">
                    <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
                    <button v-if="update == 0" @click="saveTasks()" class="btn btn-success">Añadir</button>
                    <!-- Botón que modifica la tarea que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="updateTasks()" class="btn btn-warning">Actualizar</button>
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
                 namePage:'Habitaciones',
                cantidad:"0", //Esta variable, mediante v-model esta relacionada con el input del formulario
                tipo:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                acomodacion:"",
                hotel_id:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                update:0, /*Esta variable contrarolará cuando es una nueva tarea o una modificación, si es 0 significará que no hemos seleccionado
                          ninguna tarea, pero si es diferente de 0 entonces tendrá el id de la tarea y no mostrará el boton guardar sino el modificar*/
                habitaciones:[], //Este array contendrá las tareas de nuestra bd
                hoteles:[],
                activeDanger:false,
                activeSuccess:false,
                listMessageAlert:[],
                viewAlert:false,
                tipeAlert:'',
                listTipo:[
                    {id:'ESTANDAR',name:'ESTANDAR',asing:'Sencilla o Doble'},
                    {id:'JUNIOR',name:'JUNIOR',asing:' Triple o Cuádruple'},
                    {id:'SUITE',name:'SUITE',asing:' Sencilla, Doble o Triple'}
                ],
                tipoSelectAsing:''
            }
        },
        computed:{
            calcCantHabitaciones:function(){
                //filtra la cantidad habitaciones de acuerdo al hotel seleccionado
                let totalCantidad = this.habitaciones.filter(hab => hab.hotel_id === this.hotel_id)
                let cantTotal = 0
                //suma el total de habitaciones por el hotel 
                totalCantidad.forEach(function(val,index,array){
                    cantTotal += val.cantidad
                })
                let totalForSelect = parseInt(cantTotal)+parseInt(this.cantidad)
                let filterHotel = this.hoteles.find(x => x.id === this.hotel_id)
                if (filterHotel) {
                    console.log(filterHotel.num_habitaciones > cantTotal)
                    if (cantTotal > filterHotel.num_habitaciones  ) {

                        
                        this.activeDanger = true
                        this.listMessageAlert = {message:'Esta superando la cantidad de habitaciones que el hotel tiene asignado. '}
                        this.viewAlert = true    
                    
                    }    
                }  
                return this.cantidad
            }
        },
        methods:{
            getTasks(){
                let me =this;
                let url = '/api/habitaciones' //Ruta que hemos creado para que nos devuelva todas las tareas
                axios.get(url).then(function (response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.habitaciones = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            saveTasks(){
                let me =this;
                let url = '/api/habitaciones' //Ruta que hemos creado para enviar una tarea y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la tarea
                    'cantidad':this.cantidad,
                    'tipo':this.tipo,
                    'acomodacion':this.acomodacion,
                    'hotel_id':this.hotel_id
                }).then(function (response) {
                    me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                    me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                     me.activeDanger = true
                    me.activeSuccess = true
                    me.listMessageAlert =  JSON.parse(response.data)
                    me.viewAlert = true
                })
                .catch(function (error) {
                     if (error.request) {
                        me.activeDanger = true
                        me.listMessageAlert = JSON.parse(error.request.response)
                        me.viewAlert = true    
                    }
                });   
                 setTimeout(() => {
                    this.viewAlert = false
                }, 4000);

            },
            updateTasks(){/*Esta funcion, es igual que la anterior, solo que tambien envia la variable update que contiene el id de la
                tarea que queremos modificar*/
                let me = this;
                axios.put('/api/habitaciones/'+this.update,{
                    'cantidad':this.cantidad,
                    'tipo':this.tipo,
                    'acomodacion':this.acomodacion,
                    'hotel_id':this.hotel_id,
                    'id':this.update
                }).then(function (response) {
                   me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                   me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadFieldsUpdate(data){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
                this.update = data.id
                let me =this;
                let url = '/api/habitaciones/'+this.update;
                axios.get(url).then(function (response) {
                    me.cantidad=response.data.cantidad
                    me.tipo=response.data.tipo
                    me.acomodacion=response.data.acomodacion
                    me.hotel_id=response.data.hotel_id
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                }); 
            },
            deleteTask(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
                let me =this;
                let task_id = data.id
                if (confirm('¿Seguro que deseas borrar esta habitación?')) {
                    axios.delete('/api/habitaciones/'+task_id
                    ).then(function (response) {
                        me.getTasks();
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                }
            },
            clearFields(){/*Limpia los campos e inicializa la variable update a 0*/
                this.cantidad = ''
                this.tipo = ''
                this.acomodacion = ''
                this.hotel_id = 0
            },
            getHoteles(){
                let me =this;
                let url = '/api/hoteles' 
                axios.get(url).then(function (response) {

                    me.hoteles = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectTipo(tipo){
                let me =this;
                me.tipoSelectAsing = this.listTipo.find(x => x.name === tipo).asing 
           }
        },
        mounted() {
           this.getTasks();
           this.getHoteles()
        }
    }
</script>