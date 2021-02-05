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
    <div class="commentsections">
      <div class="commentsHeader">
        <div v-on:click="showComments = !showComments">
          <i  v-if="!showComments" class="material-icons">keyboard_arrow_down</i>
          <i  v-if="showComments" class="material-icons">keyboard_arrow_up</i>
          </div>
        </div>
      <div v-if="showComments" class="comments">
        <p>works</p>
        <div class="commentform">
          <textarea v-model="commentText"></textarea>
          <button>Senden</button>
        </div>
      </div>
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
        showComments: false,
        commentText: "",
      };
    },
  };
</script>

<style>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons");

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
  .commentsections{
    margin-top: 5px;
     border-top: 1px solid #233554;
  }

  .commentform{
    display: flex;
    padding: 5px;
  }
  .commentform textarea{
    width: 80%;
    height: 30px;
    color: white;
    border: solid 1px white;
    background-color: #020c1b;
    padding: 5px;
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
