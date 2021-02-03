<template>
  <div class="home">
    <tool-bar id="toolbar">
      Semesterprojekt
   
      <ul slot="right">
         <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/portfolio">Portfolio</router-link></li>
      </ul>
      
    </tool-bar>

    <div id="main">
      <transition name="fade">
        <router-view></router-view>
      </transition>
    </div>

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

*{
  margin: 0px;
}


.home{
  width: 100%;
  height: auto; 
}

#toolbar{
    position: sticky;
    height:30px;
    width: 100%;
    top: 0;
    background-color: #020c1b;
}

li, a, p, h1{
  color: #e6f1ff;
}

a{
  text-decoration: none;
}

#main{
  display: flex;
  justify-content: center;
  align-items: center;
  height: auto;
  min-height: calc(100vh - 50px);
  width: 100%;
  margin: 0px;
  padding: 0px;
  background-color:#020c1b;
}
#footer{
  display: flex;
  justify-content: space-around;
  align-items: baseline;
  position: fixed;
  height: 20px;
  width: 100%;
  bottom: 0;
  background-color: #020c1b;
}

nav ul{
  list-style-type: none;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}



</style>

