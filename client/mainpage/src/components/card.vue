<template>

  <div class="card">
      <h4><span class="green">{{solution.id}}</span> {{solution.titel}}</h4>
      <h5>{{solution.subtitel}}</h5>
      <h4>Vorlesung: {{solution.vorlesung}}</h4>
      <div> 
          <p>{{solution.beschreibung}}</p>
      </div>
      <div>
         <div class="tag" v-for="tag in solution.tags" :key="tag">{{tag}}</div>
      </div>
  
      <div class="cardbottom">
        <a class="btn" :href="githubBase + solution.id">Github</a>
        <a class="btn" :href="solutionBase +  solution.id">View</a>
      </div>
  </div>
  
</template>

<script>
//import router from "../router"; 
export default {
props: {
  solution: Object,
},
data: function (){
  return {
    githubBase: "https://github.com/TimOelrichs/SPWebEnginnering/tree/main/solutions/",
    solutionBase: "http://www2.inf.h-bonn-rhein-sieg.de/~toelri2s/solutions/"
  }
},

}
</script>

<style>
  .card{ /* card design from https://codepen.io/sdthornton/pen/wBZdXq */ 
    position: relative;
    display: block;
    text-align: left;
    background-color: #0a192f;
    border-radius: 5px;
    height: 300px;
    width: 25%;
    min-width: 250px;
    padding: 10px;
    /*
    box-shadow: 0 1px 3px rgba(255,255,255,0.2), 0 1px 2px rgba(255,255,255,0.24);
    
    */margin: 1rem;
  }
  .card:hover{
    top: -10px;
    /*box-shadow: 0 14px 28px rgba(255,255,255,0.25), 0 10px 10px rgba(255,255,255,0.22);
    */
  }

  .card img{
    height: 100px;
    width: 50px;
  }

.cardbottom{
  display: flex;  
  position: relative;
  bottom: 0px;
  border-top: 1px solid #233554;
  padding: 10px;
}
</style>