
let json; 


async function getData(){
    let data = await fetch("./data.json")
    return await data.json();
}


async function init() {
    try {
        json = await getData();
        console.log(json)
        createMainMenu();
    } catch (error) {
        console.log(error)
    }
 
}

init();

function createMainMenu() {
    let nav = document.getElementById('mainnav');
    let i = 0
    for (const key of Object.keys(json)) {
        const li = document.createElement('li');
        li.textContent = key;
        li.addEventListener('click', (event) => menuItemClickHandler(event, key));
        
        if (!i++) {
            li.classList.add('active_main')
            createSideMenu(key)
        }
        nav.appendChild(li)
        
    }
}

function createSideMenu(subCat) {
    let nav = document.getElementById('leftnav');
    nav.innerHTML = "";
    let i = 0;
    for (const key of Object.keys(json[subCat])) {
        const li = document.createElement('li');
        li.textContent = key;
        li.addEventListener('click', (event) => showContent(event, subCat, key ));
        
        if (!i++) {
            li.classList.add('active_side')
            showContent(null, subCat, key);
        }
        nav.appendChild(li);
    }
}

function showContent(event, subCat, key) {
    
    document.querySelector('.active_side')?.classList.remove('active_side');
    event?.target.classList.add('active_side');
    let content = document.getElementById('content');
    content.innerHTML = json[subCat][key].content;
    let right = document.getElementById('rightnav');
    console.log(json[subCat][key].references.map( r => `<a href="${r}>${r}</a>`).join())
    right.innerHTML = json[subCat][key].references.map( r => `<a href="${r}">${r.split("/").pop()}</a>`).join();
}

function menuItemClickHandler(event, subCat) {
    document.querySelector('.active_main')?.classList.remove('active_main');
    event.target.classList.add('active_main');
    createSideMenu(subCat)
}

