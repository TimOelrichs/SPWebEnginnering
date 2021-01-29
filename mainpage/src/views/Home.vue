<template>
  <div class="home">
    <tool-bar>
      Hello World
    </tool-bar>
    <router-view></router-view>
    
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

