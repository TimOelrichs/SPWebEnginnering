<template>

  <div class="card">
       <h4>{{solution.title}}</h4>
      <img v-bind:src="solution.picUrl" alt="">
      <div> 
          <p>Vorlesungseinheit: {{solution.unit}}</p>
      </div>
      <router-link v-bind:to="solution.routerlink">Lösung anzeigen</router-link>
  </div>
  
</template>

<script>
export default {
props: {
  solution: Object,
}
}
</script>

<style>
  .card{
    height: 200px;
    width: 200px;
    border: 1px solid grey;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    margin: 10px;
  }
  .card:hover{
    box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  }

  .card img{
    height: 100px;
    width: 50px;
  }

</style>