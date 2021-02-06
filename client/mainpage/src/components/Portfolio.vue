<template>

  <div id="solutions">
    <div class="w-100 flex center fixed z-100">
      <div class="filter flex" id="filter">
        <div class="pointer" @click="tilesViewON = !tilesViewON">
            <i v-if="!tilesViewON" class="material-icons">grid_view</i>
            <i v-if="tilesViewON" class="material-icons">list</i>
       </div>
        <div class="">
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
    this.tags = this.getTags();
    //this.tags.forEach( t => tagsFilter[t] = true); 

},
mounted(){
  window.bus.$on('addComment', commentObj => {
  
    this.solutions.filter( s => s.id == commentObj.id)[0].comments.push(commentObj.comment);
    console.log(this.solutions.filter( s => s.id == commentObj.id)[0].comments)
    solutionsService.postComment(commentObj)
      .then(res => res.json())
      .then(res => console.log("postComment", res));
  })

  window.bus.$on('incView', id => {
      this.solutions.filter( s => s.id == id)[0].view++;
      solutionsService.incView(id)
      .then(res => res.text())
      .then(res => console.log("incView", res));
  })

  window.bus.$on('solution-liked', id => {
      this.solutions.filter( s => s.id == id)[0].likes++;
      solutionsService.incLike(id).then(res => console.log("incLike", res));
  })

   window.bus.$on('solution-disliked', id => {
      this.solutions.filter( s => s.id == id)[0].likes--;
      solutionsService.decLike(id).then(res => console.log("decLike", res));
  })

},
methods:{
  getTags: function () {
    /*
    let set = new Set([]);
    this.solutions.forEach(s => {
     set = new Set([...set, ...s.tags])
    });
    return Array.from(set);
    */
  },
  sort: function(event){
    console.log("sort()");
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
          return b.view-a.view;
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
    }

/*
        <option></option>
        <option>Views: aufsteigend</option>
        <option>Views: absteigend</option>
        <option>Likes: aufsteigend</option>
        <option>Likes: absteigend</option>
        */
  }
 
},
computed:{
  filteredSolutions : function (){
    return this.solutions.filter( s => s.titel.includes(this.searchText) || s.id.startsWith(this.searchText));
  },
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
    top: 60px;
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
  justify-content: space-between;
  width: 70%;
  background-color:#020c1b;
  z-index: 100;
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