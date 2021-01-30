<template>
  <div class="home">
    <tool-bar>
      Semesterprojekt
      <ul slot="right">
         <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/portfolio">Portofolio</router-link></li>
      </ul>
    </tool-bar>
    <transition name="slide">
    <router-view></router-view>
    </transition>
    <footer>Tim Oelrichs</footer>
  </div>
</template>

<script>
// @ is an alias to /src
import ToolBar from "../components/ToolBar.vue"

export default {
  name: 'Home',
  components: {
    ToolBar,
  }
}
</script>

<style scoped>

.home{
  display: grid;
  grid-template-rows: auto 1fr auto;
}

router-view{
  height: 80vh;
}

footer{
  background-color: grey;
}
</style>

