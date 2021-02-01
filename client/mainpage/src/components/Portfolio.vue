<template>
  <div id="solutions">
  <Card v-for="solution in solutions" :key="solution.index" :solution="solution">
    </Card>
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
    let data = await fetch("../data/solutions_data.json");
    console.log(data);
    data = await data.json();
    console.log(data);
    this.solutions = data;
    }
}



</script>

<style>
#solutions{
  display: flex;
  height: 70vh;
  width: 100vw;
  margin: 20px;
  padding: 20px; 
  flex-wrap: wrap;
  justify-content: center;
  
}

</style>