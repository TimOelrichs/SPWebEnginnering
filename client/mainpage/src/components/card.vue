<template>

  <div class="card">
       <h4>{{solution.title}}</h4>
      <img v-bind:src="solution.picUrl" alt="">
      <div> 
          <p>Vorlesungseinheit: {{solution.unit}}</p>
      </div>
      <button @click="goTo(solution.routerlink)">Zur Lösung</button>
      <a href="github"><i class="fab fa-github"></i></a>
      <a :href="'solution/' + solution.routerlink">View</a>
      <router-link v-bind:to="'solution/' + solution.routerlink">Lösung anzeigen</router-link>
  </div>
  
</template>

<script>
//import router from "../router"; 
export default {
props: {
  solution: Object,
},
methods:{
  goTo: (url) => {location.href(url)}
}

}
</script>

<style>
  .card{ /* card design from https://codepen.io/sdthornton/pen/wBZdXq */ 
    display: inline-block;
    border-radius: 2px;
    height: 200px;
    width: 200px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    margin: 1rem;
  }
  .card:hover{
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  }

  .card img{
    height: 100px;
    width: 50px;
  }

</style>