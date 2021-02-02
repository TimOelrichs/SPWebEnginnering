class Vorrang{
    constructor(tasks) {
        this._tasks = tasks;
        this._dependiciesObj = {};
        this._order = [];
        this.topsort();
    }

    getOrder() { return this._order;}

    topsort() {
        this.makeDependenciesObj();
        let keys = Object.keys(this._dependiciesObj);
        while (keys.length) {
            for (var k of keys) {
                var dependencies = this._dependiciesObj[k];
                if (dependencies.every(d => this._order.includes(d))) {
                    this._order.push(k);
                    keys.splice(keys.indexOf(k), 1);
                }
            };
           
        }
    }

    makeDependenciesObj() {
              this._tasks.forEach(t => {
                if (!this._dependiciesObj[t[0]]) {
                    this._dependiciesObj[t[0]] = [];
                }
                if (!this._dependiciesObj[t[1]]) {
                    this._dependiciesObj[t[1]] = [t[0]];
                } else {
                    this._dependiciesObj[t[1]].push(t[0]);
                }
            });
    }

}

//Tests
//Arange   
const vorrang = new Vorrang([["schlafen", "studieren"], ["essen", "studieren"], ["studieren", "pruefen"]]);
const expected = [ 'schlafen', 'essen', 'studieren', 'pruefen' ]
//Act

var order = vorrang.getOrder();

//Assert
console.assert(String(order) === String(expected))
