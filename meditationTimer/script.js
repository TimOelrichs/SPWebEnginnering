window.onload = init;

const startBtn = document.getElementById('startBtn');
const resetBtn = document.getElementById('resetBtn');
const timeBox = document.getElementById('timeBox');

var minuten = 1;
let endTime;
var resume = false; 
var timerID = 0;
var percent = 0;


function init() {
    startBtn.addEventListener('click', clickHandlerStart)
    resetBtn.addEventListener('click', clickHandlerReset);
}

function clickHandlerStart() {
    if(!resume) endTime = Date.now() + 5000; //(minuten * 60000);
    timerID = setInterval(() => {
        let milliseconds = endTime - Date.now();
        if (milliseconds < 0) { clickHandlerStop(); timeBox.textContent = "Ring Ring"; return}
        timeBox.textContent = new Date(milliseconds).toUTCString().split("1970")[1].split("GMT")[0];
        percent = (5000 * milliseconds / 100);
        console.log(milliseconds)
    }, 300)
    startBtn.textContent = "Stop"
    startBtn.removeEventListener('click', clickHandlerStart )
    startBtn.addEventListener('click', clickHandlerStop)
}

function clickHandlerStop() {
    if(timerID) clearInterval(timerID);
    resume = true;
    timerID = 0;
    startBtn.textContent = "Start"
    startBtn.removeEventListener('click', clickHandlerStop);
    startBtn.addEventListener('click', clickHandlerStart);
}

function clickHandlerReset() {
    if (timerID) clickHandlerStop();
    resume = false; 
    timeBox.textContent = "00:01:00";
}
