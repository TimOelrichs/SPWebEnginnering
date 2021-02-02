function identity(param) {
return param;
}

function identity_function(param) {
    return function() {return param;};
}

function add(a,b){
    return a+b;
}

function mul(a, b) {
    return a * b;
}

function addf(x) {
    return function (y) {
        return x + y;
    }
}

function applyf(f) {
    return function (x) {
        return function (y) {
            return f(x, y);
        }
    }
}

console.log(identity("a"));
console.log(identity_function("a")());
console.log(add(1,1));
console.log(mul(5,5));
console.log(addf(1)(2));
console.log(applyf(add)(5)(8));

