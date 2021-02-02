function identity_function(para){
    return function () {
        return para;
    }
}

function addf(x){
    return function(y){
        return x+y;
    }
}

function applyf(fnc){
    return function (x) {
        return function (y) {
            return fnc(x,y);
        }
    }
}
function add(x,y){return x+y;}
function mul(x,y){return x*y;}
function curry(fnc, param) {
    return function (param2) {
        return fnc(param,param2);
    }
}
let inc = addf(1);
function methodize(fnc) {
    return function(para){
        return fnc(this,para);
    }
}
function demethodize(fnc){
    return function (x,y) {
        return fnc(x,y);
    }
}
function twice(fnc){
    return function(para){
        return fnc(para,para);
    }
}
function composeu(fnc1,fnc2){
    return function (para) {
        return fnc2(fnc1(para,para),fnc1(para,para));
    }
}
function composeb(fnc1,fnc2){
    return function (para1,para2,para3) {
        return fnc2(fnc1(para1,para2),para3);
    }
}
function once(fnc){
    let counter = false;
    return function (para,para2) {
        if (counter){
            throw new Error("method only allowed to use once");
        }
        counter = true;
        return fnc(para,para2);
    }
}
function counterf(para) {
    return {
        x: para,
        inc: () => ++para,
        dec: () => --para
    };
}
function revocable(func){
    return {
        func: func,
        invoke: (...args) => func(...args),
        revoke: () =>  {
            func = null;
            throw new Error("rewoked");
        }
    };
}
function vector() {
    return {
        c: [],
        append: function(...args)  {
            this.c = this.c.concat(args);
        },
        get: function(index)  {
            return this.c[index];
        },
        store: function(i,v)  {
            this.c.splice(i, 0, v);
        }
    };
}

let alert = console.log
temp = revocable(alert);
temp.invoke(7); // führt zu alert(7);
temp.revoke();
temp.invoke(8); // Fehlerabbruch!