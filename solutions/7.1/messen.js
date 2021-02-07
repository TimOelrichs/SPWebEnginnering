
window.onload = resetTable;

const testText = "Testing ...."

const testContainer = document.getElementById("test-container");
var testElem = document.getElementById("test");
const table = document.getElementById("results")
const msg = document.getElementById('msg');


function resetTable() {  
    msg.textContent = "";
    table.innerHTML = `
    <tr>
        <th>Platz:</th>
        <th>
            Dom Operation:
        </th>
        <th>
            &#8709; Zeit:
        </th>
    </tr> `
}

function start(){
    msg.textContent = "berechne..."
    resetTable();
    messen();
    msg.textContent = "fertig!"

}

function resetTestElem(){
    testContainer.innerHTML = "";
    testContainer.innerHTML = `<div id="test"></div>`;
    testElem = document.getElementById("test");
}


function messen(){

let anzahl = Number.parseInt(document.getElementById("txt_number").value);
let vorlauf = Number.parseInt(document.getElementById("txt_vorlauf").value);
let durchlaeufe = anzahl + vorlauf;

const ops = ["innerHTML", "innerText", "textContent", "outerHTML"]
let tableObj = {}

ops.forEach((op) => {
    tableObj[op] = 0;
})

//Messungen wiederholen
for (let index = 0; index < durchlaeufe; index++) {
    ops.forEach((op) => {
        let t0 = performance.now();
        testElem[op] = testText;
        let t1 = performance.now()
        if(index >= vorlauf ) tableObj[op] += t1-t0; 
    })  
    resetTestElem();
}



//Durschnitt
ops.forEach((op) => {
        tableObj[op] /= anzahl;
})


Object.entries(tableObj).sort(([,a],[,b]) => a-b).forEach( (item, index) => {
    let tr = document.createElement("tr");
    let td = document.createElement("td")
    td.textContent = index+1;
    tr.appendChild(td);
    td = document.createElement("td")
    td.textContent = item[0];
    tr.appendChild(td);
    td = document.createElement("td")
    td.textContent = item[1];
    tr.appendChild(td)
    table.appendChild(tr)
})


}