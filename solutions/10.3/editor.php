<?php
session_start();

if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: navigator.php");
    exit;
}

require "../common/util/content.php";

?>

<!doctype html>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    * {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    body,
    html {
        width: 100%;
        height: 100%
    }

    body {
        display: grid;
        grid-template-rows: auto 1fr auto;
    }

    #form {
        width: 80vw;
        justify-self: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
        padding: 20px;
    }

    textarea {
        margin: 0 0 5px;
        display: block;
        width: 80vw;
        height: 100px;
        padding: 20px;
    }


    select,
    input {
        height: 20px;
        width: 150px;
        padding: 0px 15px;
    }

    label {
        display: inline-block;
        padding: 5px;
        width: 200px;
    }

    header {

        background-color: #333;
        color: white;
        margin: 0;
        padding: 5px 30px;
        height: auto;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }

    header a {
        text-decoration: none;
        color: white;

    }

    #textareaHeader {
        display: flex;
        justify-content: space-between;
    }

    p {
        margin-top: 15px;
    }

    #msg {

        color: blueviolet;
    }

    #vergleichView {
        display: none;
        flex-direction: column;
    }

    .flex {
        display: flex;
    }

    .flex textarea {
        width: 45vw;
        height: 65vh;
    }
</style>
<header>
    <h1> <a href="./navigator.php">PHP WWW-Navigator</a></h1>
    <h3>Content Editor</h3>
</header>
<div id="form">

    <div id="">
        <h4 id="datasource">Geöffnet: Serverdaten</h4>
        <button disabled="true" id="toogleDataBtn" onclick="toogleDataSource()">Wechseln zu lokaler Kopie</button>
        <button onclick="toogleVergleichView()" id="vergleichenBtn">Daten vergleichen</button>
        <button onclick="deleteLocal()" disabled="true" id="deleteLocalCopyBtn">Lokale Kopie löschen</button>
        <button onclick="toogleSaveLocal()" id="toogleSaveLocalBtn">Lokale Kopie deaktivieren</button>
        <button onclick="preview()"><i class="material-icons">preview</i>Vorschau</button>
    </div>
    <p>Kategorie auswählen oder hinzufügen:</p>
    <div>
        <select name="top_header">
        </select>
        <button onclick="deleteTopHeader()">x</button>
        <label for="newheader">Neue Kategorie:</label>
        <input type="text" name="newheader" id="newHeader"><button onclick="addHeader()">+</button>
    </div>
    <div>
        <select name="sub_header">
        </select>
        <button onclick="deleteSubHeader()">x</button>
        <label for="newsubheader">Neue Unterkategorie:</label>
        <input type="text" name="newsubheader" id="newSubHeader">
        <button onclick="addSubHeader()">+</button>
    </div>
    <div id="textareaHeader">
        <p>Content hinzufügen:</p>
        <p id="msg">
        <p>
        <p></p>
    </div>
    <textarea id="content" oninput="saveLocal()"></textarea>
    <div>
        <p>Referenzen hinzufügen:</p>
    </div>
    <textarea id="references" oninput="saveLocal()"></textarea>
    <div>

        <button id="publishBtn" disabled="true" onclick="publish()">Veröffentlichen</button>
    </div>

</div>

<div id="vergleichView">
    <button onclick="toogleVergleichView()" id="vergleichenBtn">Zum Editor wechseln</button>
    <div class="flex">
        <div>
            <h1>Server Daten:</h1>
            <textarea class="jsonTextarea"></textarea>
        </div>
        <div>
            <h1>Lokale Kopie:</h1>
            <textarea class="jsonTextarea"></textarea>
        </div>

    </div>
</div>
<?PHP
$json = getAllData();
?>

<script>
    var json = <?PHP echo json_encode($json) ?>;
    const form = document.getElementById('form');
    const top_header = document.querySelector('select[name="top_header"]');
    const sub_header = document.querySelector('select[name="sub_header"]');
    const txt_NewHeader = document.getElementById("newHeader");
    const txt_NewSubHeader = document.getElementById("newSubHeader");
    const content = document.getElementById("content");
    const references = document.getElementById("references");
    const msg = document.getElementById('msg');
    const datasource = document.getElementById('datasource');
    const toogleDataBtn = document.getElementById('toogleDataBtn');
    const vergleichenBtn = document.getElementById('vergleichenBtn');
    const deleteLocalCopyBtn = document.getElementById('deleteLocalCopyBtn');
    const toogleSaveLocalBtn = document.getElementById('toogleSaveLocalBtn');
    const publishBtn = document.getElementById('publishBtn');
    const vergleichView = document.getElementById('vergleichView');

    let isLocalData = false;
    let isSaveLocalActive = true;
    let timeout = 0;
    let localJson;
    let needsRefresh = false;

    init();

    function init() {
        let local = localStorage.getItem('content');
        if (local) {
            loadLocal();
        };
        update();
    }

    function loadLocal() {
        json = JSON.parse(localStorage.getItem('content'))
        toogleDataSource();
    }

    function deleteLocal() {
        localStorage.removeItem('content');
        localJson = null;
        isLocalData = false;
        setDataSource();
        toogleDataBtn.disabled = true;
        deleteLocalCopyBtn.disabled = true;

        init();

    }

    function toogleSaveLocal() {
        isSaveLocalActive = !isSaveLocalActive;
        toogleSaveLocalBtn.innerText = isSaveLocalActive ? "Lokale Kopie deaktieren" : "Lokale Kopie aktivieren";

    }


    async function toogleVergleichView() {
        let display = form.style.display;
        if (display != "none") {
            form.style.display = "none";
            vergleichView.style.display = "flex";
            let textareas = document.querySelectorAll('.flex textarea');
            textareas[0].value = JSON.stringify(await fetchDataFromServer(), null, 2);
            textareas[1].value = JSON.stringify(JSON.parse(localStorage.getItem('content')), null, 2);
        } else {
            form.style.display = "flex";
            vergleichView.style.display = "none";
        }

    }

    function update() {
        top_header.innerHTML = "";
        Object.keys(json).forEach(key => {
            const option = document.createElement('option');
            option.value = key;
            option.innerText = key;
            top_header.append(option);
        })

        updateSubheaders(top_header.value);

        top_header.addEventListener('change', e => {
            updateSubheaders(e.target.value);
            updateTextAreas();

        });
        sub_header.addEventListener('change', e => {
            updateTextAreas();
        });


    }

    async function setDataSource() {
        if (isLocalData) {
            if (localJson) {
                json = localJson;
                localJson = null;
            };
            datasource.innerText = "Geöffnet: Lokale Kopie";
            toogleDataBtn.disabled = false;
            toogleDataBtn.innerText = "Wechsel zu Serverdaten";
            if (!isSaveLocalActive) toogleSaveLocal();
            deleteLocalCopyBtn.disabled = false;
            if (needsRefresh) update();
            needsRefresh = false;
        } else {
            localJson = json;
            json = await fetchDataFromServer();
            datasource.innerText = "Geöffnet: Server Daten";
            toogleDataBtn.innerText = "Wechsel zu lokaler Kopie";
            if (isSaveLocalActive) toogleSaveLocal();
            update();
            needsRefresh = true;
        };
    }

    async function fetchDataFromServer() {
        return await (await fetch(new Request("../common/server/server.php"), {
            method: 'GET',
            mode: 'cors',
            cache: 'no-store'
        })).json();
    }

    function toogleDataSource() {
        isLocalData = !isLocalData;
        setDataSource();
        publishBtn.disabled = !publishBtn.disabled;
    }

    function saveLocal() {

        if (!isSaveLocalActive) return;
        if (!isLocalData) toogleDataSource();
        clearTimeout(timeout);
        json[top_header.value][sub_header.value].content = content.value;
        json[top_header.value][sub_header.value].references = references.value.replaceAll("\n", "").split(",");
        publishBtn.disabled = false;
        msg.innerText = "...";
        timeout = setTimeout(() => {
            msg.innerText = "Lokal gespeichert";
            localStorage.setItem("content", JSON.stringify(json));
            setTimeout(() => {
                msg.innerText = "";
            }, 1000);
        }, 1000);
    }


    function publish() {

        fetch(new Request("../common/server/server.php"), {
                method: 'POST',
                mode: 'cors',
                cache: 'no-store',
                body: JSON.stringify({
                    action: "publish",
                    data: json
                }),
            }, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json())
            .then(res => {
                if (res.status == 'success') {
                    msg.innerHTML = '<a href="./navigator.php">Content veröffentlich!</a>'
                    localStorage.removeItem("content");
                }
            })
            .catch(err => {
                msg.innerText = "Content konnten nicht auf dem Server gespeichert werden.";
                console.error(err);
            })

    }

    function deleteTopHeader() {
        let c = confirm("Kategorie wirklich löschen? Alle UNterkategorien werden ebenfalls gelöscht")
        if (c) {
            delete json[top_header.value];
            top_header.removeChild(document.querySelector('option[value=' + top_header.value + ']'));
            updateSubheaders(top_header.value);
        }
        saveLocal()
    }

    function deleteSubHeader() {
        let c = confirm("Unterkategorie wirklich löschen?")
        if (c) {
            delete json[top_header.value][sub_header.value];
            sub_header.removeChild(document.querySelector('option[value=' + sub_header.value + ']'));
            updateTextAreas();
        }
        saveLocal();
    }

    function preview() {
        console.log(json);
        fetch(new Request("../common/server/server.php"), {
                method: 'POST',
                mode: 'cors',
                cache: 'no-store',
                body: JSON.stringify({
                    action: "savePreviewData",
                    data: json
                }),
            }, {
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json())
            .then(res => {
                if (res.status == 'success') {
                    window.location.href = "./preview.php";
                }
            })
            .catch(err => {
                msg.innerText = "PreviewDaten konnten nicht auf dem Server gespeichert werden.";
                console.error(err);
            })

    }

    function updateSubheaders(header) {
        let category = header || top_header.value;
        sub_header.innerHTML = "";
        Object.keys(json[header]).forEach(key => {
            const option = document.createElement('option');
            option.value = key;
            option.innerText = key;
            sub_header.append(option);
        });
        updateTextAreas();
    }

    function updateTextAreas() {
        if (json?. [top_header.value]?. [sub_header.value]?. ["content"]) {
            content.value = json[top_header.value][sub_header.value].content;
        } else {
            content.value = "";
        }
        if (json?. [top_header.value]?. [sub_header.value]?.references) {
            references.value = json[top_header.value][sub_header.value].references.join(",\n");
        } else {
            references.value = "";
        }
    }

    function addHeader() {
        let input = document.getElementById("newHeader");
        let value = input.value;
        if (value.trim() == "") return
        input.value = "";
        json[value] = {};
        const option = document.createElement('option');
        option.value = value;
        option.innerText = value;
        top_header.append(option);
        top_header.value = value;
        updateSubheaders(value);
        updateTextAreas();
        sub_header.focus();

    }

    function addSubHeader() {
        const option = document.createElement('option');
        let value = txt_NewSubHeader.value
        if (value.trim() == "") return
        option.value = value;
        option.innerText = value;
        sub_header.append(option);
        json[top_header.value][value] = {};
        updateSubheaders(top_header.value);
        txt_NewSubHeader.value = "";
        sub_header.value = value;
        updateTextAreas();
    }
</script>