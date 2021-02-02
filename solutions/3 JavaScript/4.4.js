
var mytasks = [["schlafen", "studieren"], ["essen", "studieren"], ["studieren", "pruefen"]];

function topsort(tasks) {
    console.log("Here we go");
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
    console.log(dependiciesObj);

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
    console.log(`order is : ${order}`)
    return order;
}

console.log(topsort(mytasks))

//Tests
//Arange   
var tasks1 = [["schlafen", "studieren"], ["essen", "studieren"], ["studieren", "pruefen"]];
//Act
var d = makeDependenciesObj(tasks1);
var order = topsort(d);
var expected = [ 'schlafen', 'essen', 'studieren', 'pruefen' ]
//Assert
console.assert(String(order) === String(expected))
