<template>
  <div>
    <div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link" v-bind:class="{active:viewActice == 'hoteles'}" href="#" @click="viewActice = 'hoteles'">Hoteles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" v-bind:class="{active:viewActice == 'habitaciones'}" href="#" @click="viewActice = 'habitaciones'">Habitaciones</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
     <Hotel  v-if="viewActice == 'hoteles'"></Hotel>
     <Habitaciones v-if="viewActice == 'habitaciones'"></Habitaciones>
  </div>
 </div>
  

  </div>
</template>

<script>


import Hotel from '../page/Hotel.vue'
import Habitaciones from '../page/Habitacion.vue'
export default {
  name: "App",
  components:{Hotel,Habitaciones},
  data() {
    return {
      viewActice: 'hoteles'
    };
  },
  computed: {
 
  },
  
  methods: {
   
  },
};
</script>
