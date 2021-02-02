<template>
  <div class="home">
    <tool-bar id="toolbar">
      Semesterprojekt
      <nav>
      <ul slot="right">
         <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/portfolio">Portofolio</router-link></li>
      </ul>
      </nav>
    </tool-bar>
    <transition name="fade">
    <router-view></router-view>
    </transition>
    <footer id="footer">
      <p>© Tim Oelrichs, 2021</p>
      <nav>
      <ul slot="right">
      <li><router-link to="/impressum">Impressum</router-link></li>
      </ul>
      </nav>
      </footer>
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

h1{
  color:#64ffda
}
.home{
  background-color:#020c1b;
  width: 100vw;
  
}

#toolbar{
    position: sticky;
    height:30px;
    width: 95vw;
    top: 0;
    background-color: #020c1b;
}

li, a, p, h1{
  color: #e6f1ff;
}

a{
  text-decoration: none;
}
#footer{
  display: flex;
  justify-content: space-around;
  align-items: baseline;
  position: sticky;
  bottom: 0;
  background-color: #020c1b;
}

nav ul{
  list-style-type: none;
}


</style>

