
var redner = {currentSpeaking: null, counter: 1};
var timerId;

window.onload = () => {
    document.getElementById("add").addEventListener('click', addRedner);
    document.getElementById("txtInput").addEventListener('keyup', (event) => {
        if(event.keyCode === 13) addRedner();
    })
}

function addRedner(){
    let li = document.createElement("li");
        let txt = document.getElementById('txtInput');
        let name = txt.value.trim();
        if(!name) return false;
        let id = redner.counter++;
        txt.value = "";
        redner[id] = {name, elapsedTime: 0};
        
        li.innerHTML = `${name}\t<span id="t${id}">0</span> Sek.\t<button id="b${id}"">Start</button>`
        document.getElementById("liste").appendChild(li);
        let btn = document.getElementById(`b${id}`);
        btn.addEventListener('click', () => startHandler(id))
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
        r.current = ((d-r.startTime)) / 1000 + r.elapsedTime;
    }else{
        r.startTime = d;
        r.current = r.elapsedTime;
    }
    document.getElementById(`t${id}`).innerText = r.current;
}
