<template>
<div>
    <tool-bar></tool-bar>
     <iframe seamless sandbox="allow-forms allow-same-origin allow-scripts"  src="http://localhost:3000/client/mainpage/public/solutions/php-www-navigator/navigator.php" frameborder="0"></iframe>
    <!--
    <iframe seamless sandbox="allow-forms allow-same-origin allow-scripts"  :src="'solutions/' +$route.params.url" frameborder="0"></iframe>
  -->
</div>
  
</template>

<script>
import ToolBar from './ToolBar.vue'
export default {
  components: { ToolBar },
    props: {
  url: String,
},
}
</script>

<style>
iframe{
  width: 80vw;
  height: 85vh;
}

</style>