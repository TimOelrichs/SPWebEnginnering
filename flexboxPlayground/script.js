let propertiesObj = {
    "flex-direction": ["row", "row-reverse", "column", "column-reverse"],
    "flex-wrap": ["nowrap", "wrap", "wrap-reverse"],
    "justify-content": ["flex-start", "flex-end", "center", "space-between", "space-around"],
    "align-content": ["strech", "flex-start", "flex-end", "center", "space-between", "space-around"]
}

window.onload = init;
const formcontainer = document.getElementById("formcontainer");

function init() {
    
    let properties = Object.keys(propertiesObj);
    for (prop of properties) {
        createRadioGroup(prop)
    }

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