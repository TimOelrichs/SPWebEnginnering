<template>
<nav>
    <ul :style="look">
        <li v-for="item in items" v-bind:key="item.id" @click="item.clickHandler">
            {{item.text}}      
        </li>
    </ul>
</nav>
</template>

<script>
export default {
  name: 'my-Menu',
  props: {
      isVertical: {type: Boolean, default: false},
      items: {type: Array, default() {return []}}
  },
  data: function () {
    return {
      currentItem: "",
      entries : this.item,
    }
  },
  computed: {
      look() {
          return this.isVertical ? {"flex-direction": "column"} : "";
      }
  }
}

</script>

<style>
ul {
    display: flex;
    list-style: none;
}
li{
  padding: 10px;
}
li:hover{
  background-color: aquamarine;
}

</style>
