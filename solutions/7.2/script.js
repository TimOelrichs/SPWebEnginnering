var redner = {currentSpeaking: null, counter: 1};
var timerId;
let colors = ["#49A69C", "#F2F2F2", "#F2911B", "#D9B5A0", "#A66A5D"];

const prozentbar = document.getElementById('prozent');

window.onload = () => {
    document.getElementById("add").addEventListener('click', addRedner);
    document.getElementById("txtInput").addEventListener('keyup', (event) => {
        if(event.keyCode === 13) addRedner();
    })
}

function addRedner(){
    let card = document.createElement("div");
        card.classList.add("card");
        let txt = document.getElementById('txtInput');
        let name = txt.value.trim();
        if(!name) return false;
        let id = redner.counter++;
        txt.value = "";
        redner[id] = {name, elapsedTime: 0};
        card.innerHTML = `<i class="material-icons">face</i><h1>${name}</h1><h2 id="t${id}">00:00:00</h2><button id="b${id}"">Start</button>`
        document.getElementById("liste").appendChild(card);
        let btn = document.getElementById(`b${id}`);
        btn.addEventListener('click', () => startHandler(id))
        addToPercentBar(id);
}

function addToPercentBar(id) {
    let div = document.createElement('div');
    div.style.width = 0;
    div.style.backgroundColor = colors[id % colors.length];
    div.classList.add("bar");
    prozentbar.appendChild(div);
}

function updatePercent() {
    let zeiten = [];
    for (let index = 1; index < redner.counter; index++) {
        zeiten.push(redner[index].current || redner[index].elapsedTime); 
    }
    let sum = zeiten.reduce((acc, t) => acc + t);
  
    let bars = document.querySelectorAll('.bar');
    for (let index = 0; index < zeiten.length; index++) {
        bars[index].style.width = Math.round(zeiten[index] * 100 / sum) + "%";
    }

}

function startHandler(id){
    
    if(redner.currentSpeaking){
        stopHandler(redner.currentSpeaking)
    }
    redner.currentSpeaking = id;
    let btn = document.getElementById(`b${id}`);
    btn.innerText = "Stop"
    btn.removeEventListener('click', () => startHandler(id));
    btn.addEventListener('click', () => stopHandler(id));
    timerId = window.setInterval(() => timer(id), 100)  
}

function stopHandler(id){
    window.clearInterval(timerId);
    timerId = null;
    let r = redner[id];
    r.startTime = null;
    r.elapsedTime = r.current;
    redner.currentSpeaking = null;
    let btn = document.getElementById(`b${id}`);
    btn.innerText = "Start"
    btn.removeEventListener('click', () => stopHandler(id));
    btn.addEventListener('click', () => startHandler(id));
    
}

function timer(id){
    let r = redner[id];
    let d = Date.now();
    if(r.startTime){
        r.current = ((d - r.startTime)) + r.elapsedTime;
    }else{
        r.startTime = d;
        r.current = r.elapsedTime;
    }
    document.getElementById(`t${id}`).innerText = new Date(r.current).toUTCString().split("1970")[1].split("GMT")[0];r.current;
    updatePercent();
}
