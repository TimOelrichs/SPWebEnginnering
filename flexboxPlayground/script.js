let propertiesObj = {
    "flex-direction": ["row", "row-reverse", "column", "column-reverse"],
    "flex-wrap": ["nowrap", "wrap", "wrap-reverse"],
    "justify-content": ["flex-start", "flex-end", "center", "space-between", "space-around"],
    "align-content": ["stretch", "flex-start", "flex-end", "center", "space-between", "space-around"]
}

let colors = ["#49A69C", "#F2F2F2", "#F2911B", "#D9B5A0", "#A66A5D"];

window.onload = init;
const formcontainer = document.getElementById("formcontainer");
const resultBox = document.getElementById('resultBox');
const widthrange = document.getElementById('widthRange');
const addBtn = document.getElementById('addBtn') 
const rangeLabel = document.getElementById('rangeLabel');
const cssText = document.getElementById('cssText');
var sampleCounter = 0;

function init() {
    
    let properties = Object.keys(propertiesObj);
    for (prop of properties) {
        createRadioGroup(prop)
    }

    widthrange.addEventListener('change', (event) => {
        document.documentElement.style.setProperty('--card-width', `${event.target.value}%`);
        rangeLabel.textContent = event.target.value + "%";
    })

    addBtn.addEventListener('click', () => { addSamples(2) })
    addSamples(3)
}

function createRadioGroup(prop) {
    let div = document.createElement('div');
    let fieldset = document.createElement('fieldset');
    let p = document.createElement('p');
    p.textContent = prop;
    for (value of propertiesObj[prop]) {
        let input = document.createElement('input');
        input.type = "radio";
        input.value = value;
        input.name = prop;
        input.id = prop + value;
        let that = value;
        input.addEventListener('click', () => {
            console.log(prop, that)
            resultBox.style[prop] = that;
        })
        let label = document.createElement('label');
        label.for = prop + value;
        label.textContent = value;
        fieldset.appendChild(input);
        fieldset.appendChild(label);
        
    }
    div.appendChild(p);
    div.appendChild(fieldset);
    formcontainer.appendChild(div);
}

function addSamples(number) {
    for (let index = 0; index < number; index++) {
        let div = document.createElement('div');
        div.innerHTML = `
        <button id="close${sampleCounter}">X</button>
        <p class="number">${sampleCounter}</p>
        <h1 contenteditable="true">Edit me1</h1>
        <p contenteditable="true">Edit me!</p>
        </div>`
       
        div.id = "sample" + sampleCounter;
        div.classList.add("sampleBox");
        div.style.backgroundColor = colors[sampleCounter % colors.length]
        
        resultBox.appendChild(div);
        document.getElementById(`close${sampleCounter++}`).addEventListener('click', (event) => {
            resultBox.removeChild(event.target.parentNode)
        })
    }
}
