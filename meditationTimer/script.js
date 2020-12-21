window.onload = init;

const startBtn = document.getElementById('startBtn');
var minuten = 10;

function init() {
    startBtn.addEventListener('click', clickHandlerStart)
}

function clickHandlerStart() {
    let endTime = Date.now() + minuten * 60000;
    let timer = setInterval(() => { console.log(endTime - Date.now()) }, 500)
    startBtn.textContent = "Stop"
    startBtn.removeEventListener('click', clickHandlerStart )
    startBtn.addEventListener('click', () => clickHandlerStop(timer))
}

function clickHandlerStop(timer) {
    clearInterval(timer);
    startBtn.textContent = "Start"
    startBtn.removeEventListener('click', () => clickHandlerStop(timer))
    startBtn.addEventListener('click', clickHandlerStart)
}

