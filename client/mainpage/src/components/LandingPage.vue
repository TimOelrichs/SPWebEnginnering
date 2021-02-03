<template>
    <div id="container">
        <div id="title">
            <div class="headings">
                <span id="iam">Ich bin</span><br>
                <span id="name">Tim Oelrichs</span>
            </div> 
        </div>
        <div id="text">
            <p>Diese wurde Seite als Semesterprojekt an der Hochschule Bonn-Rhein-Sieg für die Lehreinheit <span class="green">Einführung in Web Engineering</span>  erstellt. </p>
            <p>Die Webseite dient als Navigator durch die von mir erstellten Lösungen zu den Übungsaufgaben.</p>
        </div>
        <div>
    <router-link class="btn" to="/portfolio">Lösungen</router-link>
    </div>
</div> 
</template>

<script>
export default {

}
</script>

<style>

.headings{
    text-align: left;
}

#container{
width: 50%;
min-width: 300px;
}

span{
    color: #ccd6f6;
    margin-right: 2px;
}

#iam{
    font-size: 2rem;
    color: #a8b2d1;
}

#name{
    font-size: 4rem;
    color: #ccd6f6;
}

#text{
    width: 100%;
    text-align: left;
    min-width: 300px;
    margin: 40px 0px;
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

</style>