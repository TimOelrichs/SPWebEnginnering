<template>
  <tool-bar>
      Semesterprojekt
      <ul slot="right">
         <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/portfolio">Portofolio</router-link></li>
      </ul>
    </tool-bar>
    <component></component>
</template>

<script>
import ToolBar from "../components/ToolBar.vue"
export default {

}
</script>

<style>

</style>