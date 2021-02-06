<template>
   <div class="comment">
       <div class="flex">
            <h4 class="green">{{comment.user + ": "}}</h4> <h4> {{comment.comment}}</h4>
       </div>
        <div class="timestamp">
            <p>{{comment.timestamp}}</p>
        </div>
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
.comment h4{
    margin-right: 2px;
}

p{
    font-size: 12px;
    margin: 7px 2px;
}

</style>