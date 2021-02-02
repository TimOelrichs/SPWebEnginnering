var Person = {
        getCars: function () {
            return this.cars;
        },
        toString: function () {
            return `Person ${this.firstname} ${this.lastname}` 
        }
}

var Auto ={
        toString: function () {
            return `${this.name} ${this.model}, ${this.weight}, ${this.color}, ${this.fident}` 
        }
}    

function conflict() {
    var carsFident = [];
    var conflict = false;
    persons.forEach(p => {
        p.cars.forEach(car => {
            if (carsFident.includes(car.fident)) {
                conflict = true;
            } else {
                carsFident.push(car.fident);
            }
        })
    });
    return conflict;
}


// Test 
//Arange
var fiat500 = {
    __proto__: Auto,
    name: "Fiat",
    model: "500",
    fident: "123456798",
    weight: "850kg",
    color: "white"
}

var kiaRio = {
    __proto__: Auto,
    name: "Kia",
    model: "Rio",
    fident: "987654321",
    weight: "850kg",
    color: "red"
}

var hans = {
    __proto__: Person,
    firstname: "Hans",
    lastname: "Meiser",
    cars: [fiat500, kiaRio]
};

var peter = {
    __proto__: Person,
    firstname: "Peter",
    lastname: "Müller",
    cars: [ fiat500 ]
};

var persons = [hans, peter];

//Act
var res = conflict();

//Assert
console.assert(res === true, "the existing conflict was not found")
