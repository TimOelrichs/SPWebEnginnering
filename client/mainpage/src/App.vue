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
import ToolBar from "./components/ToolBar.vue"

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
  padding: 0px;
}
html, body{
  width: 100vw;
  height: 100vh;
}


.home{
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #ccd6f6;
  margin: 0px;
  width: 100%;
  box-sizing: border-box;
}

#toolbar{
    position: sticky;
    height:50px;
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

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}


</style>

