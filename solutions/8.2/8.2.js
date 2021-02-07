
let div = document.getElementById('container')

async function getAndConcatText() {
    let inpA = document.getElementById('inpA').value;
    let inpB = document.getElementById('inpB').value;
    console.log(inpA)

    let a, b = await Promise.all([
        (async () => await fetch(inpA).then(x => x.text()))(),
        (async () => await fetch(inpB).then(x => x.text()))(),
    ])

    document.getElementById('txta').innerText = a;
    document.getElementById('txtb').innerText = b;

    a, b = a.split('\n'), b.split('\n');
    a =  a.length >= b.length ? a.map((e, i) => e + (b[i] || "")) : b.map((e, i) => (a[i] || "") + e)
    a = a.join("<br>")
    div.innerHTML = a;
}
