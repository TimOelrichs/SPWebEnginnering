<template>
  <div id="app">
    <my-menu :items="items" ></my-menu>
    <my-menu :items="items" :is-vertical="true" ></my-menu>
  </div>
</template>

<script>
import MyMenu from './components/MyMenu'

export default {
  name: 'App',
  components: {
    MyMenu
  },
  data: function() {
    return {items: [
      { id: 1, text: 'HTML', clickHandler: () => alert("click on html")},
      { id: 2, text: 'CSS',  clickHandler: () => alert("click on CSS") },
      { id: 3, text: 'JS',  clickHandler: () => alert("click on JS") }]
  }}
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
