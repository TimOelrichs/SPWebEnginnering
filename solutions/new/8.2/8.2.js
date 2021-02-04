
let div = document.getElementById('container')

async function getAndConcatText(){
    let a, b = await Promise.all([
        (async () => await fetch("./A.txt").then(x => x.text()))(),
        (async () => await fetch("./B.txt").then(x => x.text()))(),
    ])

    a, b = a.split('\n'), b.split('\n');
    a =  a.length >= b.length ? a.map((e, i) => e + (b[i] || "")) : b.map((e, i) => (a[i] || "") + e)
    a = a.join("<br>")
    div.innerHTML = a;
}

getAndConcatText()

//window.onload = getAndConcatText