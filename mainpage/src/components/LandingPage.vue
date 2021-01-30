<template>
<main>
    <div id="title">
        <div>
            <h3>Ich bin</h3>
            <h1>Tim Oelrichs</h1>
        </div>
        <img id="profilePic" src="../assets/foto_tim.jpg" alt="Foto Tim Oelrichs">
    </div>
    <div id="text">
        <p>Diese wurde Seite als Semesterprojekt an der Hochschule Bonn-Rhein-Sieg für die Lehreinheit </p>
    </div>
</main>
  
</template>

<script>
export default {

}
</script>

<style>
main{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-content: center;
}
#profilePic{
    border-radius: 50%;
    height: 200px;
    width: 200px;
}

#title{
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-content: center;
}
</style>