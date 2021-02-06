<template>
  <div class="card">
    <div class="cardheader">
      <h4>{{ solution.vorlesung }}</h4>
        <div v-on:click="like(solution.id)" class="likes">
          <i v-if="!hasLiked" class="material-icons">thumb_up_off_alt</i>
          <i v-if="hasLiked" class="material-icons">thumb_up</i>
           {{solution.likes}}  Likes</div>
        <div>{{solution.view}}  {{solution.view == 1 ? "View" : "Views"}}</div>
    </div>
    
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
      <a class="btn" :href="solutionBase + solution.id" target="_blank" v-on:click="incViews(solution.id)">View</a>
    </div>
   
    <div class="commentsections">
      <div class="commentsHeader"  v-on:click="showComments = !showComments">
            <i  v-if="!showComments" class="material-icons">keyboard_arrow_down</i>
            <i  v-if="showComments" class="material-icons">keyboard_arrow_up</i>
            <div> {{solution.comments.length}} Kommentare</div>
        </div>
      <div v-if="showComments" class="comments">
        <Comment v-for="comment in solution.comments" :key="comment.comment" :comment="comment">
        </Comment>
        <div class="commentform flex wrap">
          <div class="flex">
            <label class="block" for="user">Name:</label>
            <input type="text" v-model="commentUser" name="user">
          </div>
          <div class="flex">
            <label class="block" for="comment">Kommentar:</label>
            <input type="text" v-model="commentText" name="comment">
            <button class="btn bg-dark" @click="postComment(solution.id)">Senden</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import Comment from './Comment.vue';

  export default {
    components: {
    Comment
  },
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
        commentUser: "",
        hasLiked: false,
      };
    },
    methods:{
      postComment: function (id) {
        console.log(id);

        window.bus.$emit('addComment', { id , comment : { user: this.commentUser, comment: this.commentText, timestamp : new Date().toUTCString() }})
        this.commentText = "";
      },
      incViews: function(id){
        window.bus.$emit('incView', id)
      },
      like: function (id){
        this.hasLiked = !this.hasLiked;
        if(this.hasLiked) window.bus.$emit('solution-liked', id)
        else window.bus.$emit('solution-disliked', id)
        
      }
    }
  };
</script>

<style>
@import url("https://fonts.googleapis.com/icon?family=Material+Icons");

  .card {
    /* card design from https://codepen.io/sdthornton/pen/wBZdXq */
    position: relative;
    display: block;
    align-self:flex-start;
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

  .wrap{
    flex-wrap: wrap;
  }

  .block{
    display: block;
    width: 100px;
  }

  .bg-dark{
    background-color: #020c1b;
  }

  .likes{
    cursor: pointer;
  }

  .card img {
    height: 100px;
    width: 50px;
  }

  .cardheader{
    display: flex;
    justify-content: space-between;
    width: 100%
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
    height: 30px;
    width: 100%;
    bottom: 0px;
    margin-top: 15px;
  }
  .commentsections{
    width: 100%;
    margin-top: 5px;
     border-top: 1px solid #233554;
  }

  .commentform{
    display: flex;
    padding: 5px;
    border-top: 1px solid #233554;
  }
  .commentform input[type=text]{
    height: 15px;
    margin-right: 20px;
  }

  .commentsHeader{
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    width: 100%;
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
