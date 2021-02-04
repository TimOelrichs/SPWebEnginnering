<template>
  <div class="card">
    <h4>{{ solution.vorlesung }}</h4>
    <div class="cardcenter">
      <h5>
        <span class="green">{{ solution.id }}</span> {{ solution.titel }}
      </h5>
      <!--<h5>{{solution.subtitel}}</h5>-->
      <div>
        <h5>Aufgabe:</h5>
        <p>{{ solution.beschreibung }}</p>
      </div>
      <div class="tags">
        <h5 class="tag" v-for="tag in solution.tags" :key="tag">{{ tag }}</h5>
      </div>
    </div>
    <div class="cardbottom">
      <a class="btn" :href="githubBase + solution.id" target="_blank">Github</a>
      <a class="btn" :href="solutionBase + solution.id" target="_blank">View</a>
    </div>
  </div>
</template>

<script>
  //import router from "../router";
  export default {
    props: {
      solution: Object,
    },
    data: function() {
      return {
        githubBase:
          'https://github.com/TimOelrichs/SPWebEnginnering/tree/main/solutions/',
        solutionBase:
          'http://www2.inf.h-bonn-rhein-sieg.de/~toelri2s/solutions/',
      };
    },
  };
</script>

<style>
  .card {
    /* card design from https://codepen.io/sdthornton/pen/wBZdXq */
    position: relative;
    display: block;
    text-align: left;
    background-color: #0a192f;
    border-radius: 5px;
    height: auto;
    width: 100%;
    min-width: 100px;
    padding: 10px;
    margin: 1rem;
  }
  .card:hover {
    top: -3px;
  }

  .card img {
    height: 100px;
    width: 50px;
  }
  .cardcenter {
    border-top: 1px solid #233554;
    border-bottom: 1px solid #233554;
  }
  .cardbottom {
    display: flex;
    position: relative;
    justify-content: flex-start;
    align-content: space-around;
    height: 15%;
    width: 100%;
    bottom: 0px;
    margin-top: 15px;
  }

  .tags {
    display: flex;
    justify-content: flex-start;
    align-items: space-around;
    width: 100%;
  }
  .tag {
    color: #64ffda;
  }
</style>
