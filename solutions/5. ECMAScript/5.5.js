function deepCopy(struct) {
    const copy = Array.isArray(struct) ? [] : {};

    for (const [key, value] of Object.entries(struct)) {
        //console.log(`${key}: ${value}`);
        copy[key] = Array.isArray(value) ? value.map(x => x) :
            typeof value === 'object' ? deepCopy(value) : value;
   
      }
    return copy;
}


const obj = {
    name: "tim",
    hobbys: ["kochen", "programmieren"],
    objekte: {
        haus: {
            türen: [{name: "front"}, {name: "bad"}]
        }
    }
}

console.log(obj);
const copy = deepCopy(obj)
console.log(copy);
console.assert(String(obj) === String(copy))
