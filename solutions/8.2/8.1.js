
function fetchAndConcat() {

    let inpA = document.getElementById('inpA').value;
    let inpB = document.getElementById('inpB').value;

    let a = fetch(inpA).then(x => x.text());
    let b = fetch(inpB).then(x => x.text());

    let div = document.getElementById('container')

    Promise.all([a, b])
        .then(([a, b]) => {
            document.getElementById('txta').innerText = a;
            document.getElementById('txtb').innerText = b;
            return ([a,b])
        })
        .then(([a, b]) => [a.split('\n'), b.split('\n')])
        .then(([a, b]) => a.length >= b.length ? a.map((e, i) => e + (b[i] || "")) : b.map((e, i) => (a[i] || "") + e))
        .then(a => a.join("<br>"))
        .then(a => div.innerHTML = a)
}