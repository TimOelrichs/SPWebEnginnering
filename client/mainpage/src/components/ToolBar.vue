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
      <nav>
      <ul id="right">
          <slot name="right"></slot>
      </ul>
      </nav>
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

      h1, h2{
  color:#64ffda
}
 .toolbar{
       width: 100%;
       background-color: white;
       display: flex;
       flex-direction: row;
       justify-content: space-between;
       align-items: center;
       height: 30px;
       z-index: 100;
      padding: 15px 0px 5px 0px;
      width: 100%;
      box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23); /* TODO QUELLE*/
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

 #right ul{
       display: flex;
       justify-content: center;
       align-content: flex-start;
       padding-right: 10px;
       width: 300px;
      list-style-type: none;
 }

 #right ul li{
       padding-right: 10px;
 }

 #right ul li a:hover{ 
      color: #64ffda;
 }
 
</style>