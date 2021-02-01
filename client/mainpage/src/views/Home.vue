<template>
  <div class="home">
    <tool-bar id="toolbar">
      Semesterprojekt
      <ul slot="right">
         <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/portfolio">Portofolio</router-link></li>
      </ul>
    </tool-bar>
    <transition name="fade">
    <router-view></router-view>
    </transition>
    <footer id="footer"><ul slot="right">
      <p>© Tim Oelrichs, 2021</p>
         <li><router-link to="/impressum">Impressum</router-link></li>
      </ul></footer>
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
  
}

#toolbar{
    position: sticky;
    top: 0;
}


#footer{
  position: sticky;
  bottom: 0;
  background-color: grey;
}
</style>

