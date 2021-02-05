<template>
   <div class="comment">
       <div class="head"></div>
              <div>{{comment.user}}: {{comment.comment}}</div>
    </div>
</template>

<script>
export default {
      props: {
      comment: Object,
    },

}
</script>

<style scoped>
.comment{
    padding: 10px;
}

</style>