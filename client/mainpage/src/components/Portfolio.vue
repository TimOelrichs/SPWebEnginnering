<template>

  <div id="solutions">
    <div class="w-100 flex center fixed z-100">
      <div class="filter flex" id="filter">
        <div class="pointer" @click="tilesViewON = !tilesViewON">
            <i v-if="!tilesViewON" class="material-icons">grid_view</i>
            <i v-if="tilesViewON" class="material-icons">list</i>
       </div>
        <div>
          <input type="text" v-model="searchText" placeholder="Filter nach Titel oder Nr.">
          <p>{{this.solutionCount}} Lösungen</p>
        </div>

        <select @change="sort($event)">
          <option>Vorlesung: aufsteigend</option>
          <option>Vorlesung: absteigend</option>
          <option>Views: aufsteigend</option>
          <option>Views: absteigend</option>
          <option>Likes: aufsteigend</option>
          <option>Likes: absteigend</option>
          <option>Kommentare: aufsteigend</option>
          <option>Kommentare: absteigend</option>
        </select>
    </div>
    </div>
    <div id="cards">
    <Card :style="{ width: tilesView }" v-for="solution in filteredSolutions" :key="solution.index" :solution="solution">
      </Card>
      </div>
  </div>
</template>

<script>
import Card from "../components/Card.vue"

import solutionsService from "../services/solutions.service";

export default {
components: {
    Card,
  },
  data: function () {
    return {
      solutions: [],
      searchText: "",
      tags: [],
      tilesViewON: false,
    }
  },
  created: async function () {

    this.solutions = await solutionsService.getAllData();

},
mounted(){
  window.bus.$on('addComment', commentObj => {
  
    this.solutions.filter( s => s.id == commentObj.id)[0].comments.push(commentObj.comment);
    solutionsService.postComment(commentObj)
      .then(res => res.json())
      .catch(err => console.error("postComment", err));
  })

  window.bus.$on('incView', id => {
      this.solutions.filter( s => s.id == id)[0].view++;
      solutionsService.incView(id)
      .then(res => res.text())
      .catch(err => console.error("incView", err));
  })

  window.bus.$on('solution-liked', id => {
      this.solutions.filter( s => s.id == id)[0].likes++;
      solutionsService.incLike(id)
      .catch(err => console.error("incLike", err));
  })

   window.bus.$on('solution-disliked', id => {
      this.solutions.filter( s => s.id == id)[0].likes--;
      solutionsService.decLike(id)
      .catch(err => console.error("decLike", err));
  })

},
methods:{

  sort: function(event){
    let value = event.target.value;
    switch(value){
      case "Vorlesung: aufsteigend":
        this.solutions = this.solutions.sort((a, b) => {
          let number = function(solution){
            return  solution.vorlesung.substring(0,2).replace(".", "")
          } 
          return number(a)-number(b);
        });
        break;
      case "Vorlesung: absteigend":
         this.solutions = this.solutions.sort((a, b) => {
          let number = function(solution){
            return  solution.vorlesung.substring(0,2).replace(".", "")
          } 
          return number(b)-number(a);
        });
        break;
          case "Views: aufsteigend":
        this.solutions = this.solutions.sort((a, b) => {
          return a.view-b.view;
        });
        break;
          case "Views: absteigend":
        this.solutions = this.solutions.sort((a, b) => {
          return b.view-a.view;
        });
        break;
               case "Likes: aufsteigend":
        this.solutions = this.solutions.sort((a, b) => {
          return a.likes-b.likes;
        });
        break;
          case "Likes: absteigend":
        this.solutions = this.solutions.sort((a, b) => {
          return b.likes-a.likes;
        });
        break;
          case "Kommentare: aufsteigend":
            this.solutions = this.solutions.sort((a, b) => {
          return a.comments.length-b.comments.length;});
        break;
          case "Kommentare: absteigend":
            this.solutions = this.solutions.sort((a, b) => {
          return b.comments.length-a.comments.length;});
        break;
    }
  }
 
},
computed:{
  filteredSolutions : function (){
    return this.solutions.filter( 
      s => s.titel.toLowerCase().includes(this.searchText.toLowerCase()) ||
      s.id.startsWith(this.searchText) || 
      this.searchText.split(" ").every( word => s.beschreibung.toLowerCase().includes(word.toLowerCase()) ||
      this.searchText.split(" ").every(word => s.tags.map(t => t.toLowerCase()).includes(word.toLowerCase())))
    )},
  solutionCount: function(){
    return this.filteredSolutions.length;
  },
  tilesView: function (){
    return this.tilesViewON ? "40%": "100%";
  }

},
}



</script>

<style>
#solutions{
  margin: 0px;
  margin-top: 100px;
  display: flex;
  justify-content: center;
  align-content: flex-start;
  width: 80%;
  height: auto;
  padding: 20px; 
   
}

.flex{
  display: flex;
 
}
.block{
  display: block;
}

.fixed{
    position: fixed;
    top: 50px;
}

.w-100{
  width: 100%;
}

.z-100{
  z-index: 100;
}

.center{
   justify-content: center;
}

.viewbtn{
  cursor: pointer;
}

.pointer{
  cursor: pointer;
}


.filter{
  margin-top: 0px;
  justify-content: space-between;
  width: 80%;
  background-color:#020c1b;
  z-index: 100;
  box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); /* https://codepen.io/sdthornton/pen/wBZdXq */ 
}



input, select{
  color: grey;
  border: solid 1px white;
  background-color: #020c1b;
}

input[type=text], select{
  height: 30px;
  border-radius: 2px;
  padding: 2px 15px;
}
input[type=text]:focus{
  border: solid 1px white
}

#cards{
  display: flex;
  flex-wrap: wrap;
  width: 90%;
  height: auto;
}
.green{
    color:#64ffda; 
}

a{
  text-decoration: none;
}
a:hover{
  color: #64ffda;
}

.btn{
  display: block;
  border-radius: 2px;
  border: 1px solid #64ffda;
  color: #64ffda;
  padding: 5px 30px;
}

.btn:hover{
  display: block;
  border-radius: 2px;
  border: 1px solid #64ffda;
  background-color: #64ffda;
  color: #020c1b;
  padding: 5px 30px;
}
</style>