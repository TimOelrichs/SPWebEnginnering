<template>
<div>
  <input type="text" v-model="text">
  <p>letters: {{ letters }}</p>
  <p>spaces: {{ spaces }}</p>
  <p>words: {{ words }}</p>

</div>
</template>

<script>
export default {
  name: 'HelloWorld',
  data: function () {
    return {
      text : ''  
    }
  },
  computed:{
    letters: function () { 
      const reg = /[a-zA-Z]/gi;
      const m = this.text.match(reg) || "";
      return m.length},
    spaces: function () {
      const reg = /\s/gi;
      const m = this.text.match(reg) || "";
      return m.length
    },
    words: function() {
     const reg = /\w+\s?/gi;
      const m = this.text.match(reg) || "";
      return m.length
    }
  }
}

</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
