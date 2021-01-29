<template>
<div class="toolbar">
      <div class="left">
            <div class="btnPlaceholder">
                  <slot name="leftBtn"></slot>
            </div>
            <div>
                  <h2>
                        <slot>Title</slot>
                  </h2>
            </div>
      </div>
      <div>
          <slot name="right"></slot>
      </div>
</div>
</template>

<script>
export default {

}
</script>

<style>
*{
      margin: 0px;
      padding: 0px;
}
 .toolbar{
       display: flex;
       flex-direction: row;
       justify-content: space-between;
       height: 30px;
      padding: 15px 5px 5px 0px;
      width: 100vw;
      box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
 }

 .left{
       display: flex;
       justify-content: space-between;
 }

 .btnPlaceholder{
       display: inline-block;
       width: 30px;
       height: 30px;
       padding: 5px;
       
 }
</style>