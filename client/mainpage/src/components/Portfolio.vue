<template>
  <div id="solutions">
    <div id="cards">
    <Card v-for="solution in solutions" :key="solution.index" :solution="solution">
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
      solutions: []
    }
  },
  created: async function () {
    //this.solutions = await fetch("../solutions_data.json");
    let data = await fetch(new Request("http://www2.inf.h-bonn-rhein-sieg.de/~toelri2s/backend/solutions/server.php") , {
method: 'GET',
mode: 'cors',
cache: 'no-store'
});
    console.log(data);
    data = await data.json();
    console.log(data);
    this.solutions = data;
    }
}



</script>

<style>
#solutions{
  margin: 0px;
  display: flex;
  justify-content: center;
  width: 80%;
  height: auto;
  padding: 20px; 
  
  
}

#cards{
  display: flex;
  flex-wrap: wrap;
  width: 90%;
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
  color: #64ffda;
  padding: 5px 30px;
}
</style>