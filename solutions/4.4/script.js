
window.onload = init;

var depCounter = 0;
function addTask(){
    let task = document.getElementById("newtask").value.trim();
    addDependencyToForm(task);
    
}

function addDependencyToForm(task, depenency){
    let tasksForm = document.getElementById("tasksForm");
    let div = document.createElement("div");
    div.id = "dep" + depCounter++;
    let input = document.createElement("input");
    input.type = "text";
    input.value = task;
    div.appendChild(input);
    let input2 = document.createElement("input");
    input2.type = "text";
    input2.value = depenency ? depenency : "";
    div.appendChild(input2)
    let btn = document.createElement("input");
    btn.type = "button";
    btn.value = "x";
    btn.addEventListener('click', (event) => {
        tasksForm.removeChild(event.target.parentNode)
    })
    div.appendChild(btn);
    tasksForm.appendChild(div);
    
}


function init(){
    console.log(mytasks)
    mytasks.forEach( task => {
        addDependencyToForm(task[0], task[1]);
    })
}

function sort() {
    let inputs = document.querySelectorAll('input[type="text"]:not(#newtask)');
    console.log(inputs)
}

var mytasks = [["schlafen", "studieren"], ["essen", "studieren"], ["studieren", "pruefen"]];

function makeDependenciesObj(tasks){
    
    var dependiciesObj = {};
    order = [];
    //Fill dependiciesObj with keys
    tasks.forEach(t => {
        if (!dependiciesObj[t[0]]) {
            dependiciesObj[t[0]] = [];
        }
        if (!dependiciesObj[t[1]]) {
            dependiciesObj[t[1]] = [t[0]];
        } else {
            dependiciesObj[t[1]].push(t[0]);
        }
    });

    return dependiciesObj;
}

function topsort(dependiciesObj) {
    
    var keys = Object.keys(dependiciesObj);

    while (keys.length) {
        for (var k of keys) {
            var dependencies = dependiciesObj[k];
            if (dependencies.every(d => order.includes(d))) {
                order.push(k);
                keys.splice(keys.indexOf(k), 1);
            }
        };
       
    }
  
    return order;
}

var dObj = makeDependenciesObj(mytasks)
document.getElementById("task").innerText = mytasks;
document.getElementById("order").innerText = "Correct Order:" + topsort(dObj);


//Tests
//Arange   
var tasks1 = [["schlafen", "studieren"], ["essen", "studieren"], ["studieren", "pruefen"]];
//Act
var d = makeDependenciesObj(tasks1);
var order = topsort(d);
var expected = [ 'schlafen', 'essen', 'studieren', 'pruefen' ]
//Assert
console.assert(String(order) === String(expected))
