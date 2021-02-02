<template>
<main>
    <div id="container">
        <div id="title">
            <div class="headings">
                <span id="iam">Ich bin</span>
                <span id="name">Tim Oelrichs</span>
            </div> 
        </div>
        <div id="text" class="headings">
            <p>Diese wurde Seite als Semesterprojekt an der Hochschule Bonn-Rhein-Sieg für die Lehreinheit <span class="green">Einführung in Web Engineering</span>  erstellt. </p>
            <p>Die Webseite dient als Navigator durch die von mir erstellten Lösungen zu den Übungsaufgaben.</p>
        </div>
    <div class="btn"><router-link to="/portfolio">Lösungen</router-link></div>
    </div>
    
</main>

  
</template>

<script>
export default {

}
</script>

<style>
main{
    width: 100vw;
    height: calc(100vh - 124px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
}

.headings{
    text-align: left;
}

#container{
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: center;
    align-content: center;
}

span{
    color: #ccd6f6;
    margin-right: 2px;
}

#iam{
    font-size: 2rem;
}

#name{
    font-size: 5rem;
    color: #ccd6f6;
}

#text{
    width: 50vw;
    min-width: 300px;
}
</style>