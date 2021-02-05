<template>

  <div id="solutions">
    <div class="filter" id="filter">
      <input type="text" v-model="searchText" placeholder="Filter nach Titel oder Nr.">
      <p>{{this.solutionCount}} Lösungen</p>
    </div>
    <div id="cards">
    <Card v-for="solution in filteredSolutions" :key="solution.index" :solution="solution">
      </Card>
      </div>
  </div>
</template>

<script>
import Card from "../components/Card.vue"

export default {
components: {
    Card,
  },
  data: function () {
    return {
      solutions: [],
      searchText: "",
      tags: [],
    }
  },
  created: async function () {
    //this.solutions = await fetch("../solutions_data.json");
    let data = await fetch(new Request("http://www2.inf.h-bonn-rhein-sieg.de/~toelri2s/backend/solutions/server.php") , {
method: 'GET',
mode: 'cors',
cache: 'no-store'
});
    this.solutions = await data.json();
    this.tags = this.getTags();
    //this.tags.forEach( t => tagsFilter[t] = true); 

},
mounted(){
  window.bus.$on('addComment', commentObj => {
    
    this.solutions.filter( s => s.id == commentObj.id)[0].comments.push(commentObj.comment);
    console.log(this.solutions.filter( s => s.id == commentObj.id)[0].comments)
  })

  window.bus.$on('incView', id => {
      this.solutions.filter( s => s.id == id)[0].view++;
  })

  window.bus.$on('solution-liked', id => {
      this.solutions.filter( s => s.id == id)[0].likes++;
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
  }
 
},
computed:{
  filteredSolutions : function (){
    return this.solutions.filter( s => s.titel.includes(this.searchText) || s.id.startsWith(this.searchText));
  },
  solutionCount: function(){
    return this.filteredSolutions.length;
  }

},
}



</script>

<style>
#solutions{
  margin: 0px;
  margin-top: 50px;
  display: flex;
  justify-content: center;
  align-content: flex-start;
  width: 80%;
  height: auto;
  padding: 20px; 
   
}

.filter{
  display: flex;
  position: fixed;
  top: 60px;
  widows: 100%;
  background-color:#020c1b;
  z-index: 100;
}

input{
  color: #64ffda;
  border: solid 1px white;
  background-color: #020c1b;
}

input[type=text]{
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