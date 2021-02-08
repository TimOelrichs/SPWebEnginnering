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
    }

    #form {
        width: 80vw;
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
        height: 20vh;
        padding: 20px;
    }

    input {
        height: 20px;

    }

    select {
        height: 20px;
        width: 150px;
    }

    label {
        display: inline-block;
        padding: 5px;
        width: 150px;
    }

    header {
        margin: 0;
        padding: 5px;
        height: 40px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }

    #textareaHeader {
        display: flex;
        justify-content: space-between;
    }
</style>
<header>
    <h1>Content Editor</h1>
</header>
<div id="form">
    <legend>Kategorie auswählen oder hinzufügen:</legend>
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
        <button onclick="preview()"><i class="material-icons">preview</i>Vorschau</button>
    </div>
    <textarea id="content"></textarea>
    <div>
        <p>Referenzen hinzufügen:</p>
    </div>
    <textarea id="references" onchange="saveLocal()"></textarea>
    <div>
        <button onclick="saveLocal()">Lokal speichern</button>
        <button onclick="publish()">Veröffentlichen</button>
    </div>

</div>
<div id="preview">
</div>

<?PHP
$json = getAllData();
?>

<script>
    let json = <?PHP echo json_encode($json) ?>;
    const top_header = document.querySelector('select[name="top_header"]');
    const sub_header = document.querySelector('select[name="sub_header"]');
    const txt_NewHeader = document.getElementById("newHeader");
    const txt_NewSubHeader = document.getElementById("newSubHeader");
    const content = document.getElementById("content");
    const references = document.getElementById("references");

    init();

    function init() {
        Object.keys(json).forEach(key => {
            const option = document.createElement('option');
            option.value = key;
            option.innerText = key;
            top_header.append(option);
        })

        updateSubheaders(top_header.value);

        top_header.addEventListener('change', e => {
            console.log("old:", e.oldValue)
            updateSubheaders(e.target.value);
            updateTextAreas();

        });
        sub_header.addEventListener('change', e => {
            console.log("old:", e.oldValue)
            updateTextAreas();
        });


    }

    function saveLocal() {
        console.log("saveLocal")
        json[top_header.value][sub_header.value].content = content.value;
        json[top_header.value][sub_header.value].references = references.value.replaceAll("\n", "").split(",");
        localStorage.setItem("content", JSON.stringify(json));
    }

    function publish() {
        console.log(json);
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
        }).then(res => res.text()).then(res => console.log(res));

    }

    function deleteTopHeader() {
        let c = confirm("Kategorie wirklich löschen? Alle UNterkategorien werden ebenfalls gelöscht")
        if (c) {
            delete json[top_header.value];
            top_header.removeChild(document.querySelector('option[value=' + top_header.value + ']'));
            updateSubheaders(top_header.value);
        }
    }

    function deleteSubHeader() {
        let c = confirm("Unterkategorie wirklich löschen?")
        if (c) {
            delete json[top_header.value][sub_header.value];
            sub_header.removeChild(document.querySelector('option[value=' + sub_header.value + ']'));
            updateTextAreas();
        }
    }

    function preview() {
        fetch(new Request("./navigator.php"), {
            method: 'POST',
            mode: 'cors',
            cache: 'no-store',
            body: JSON.stringify(json),
        }, {
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(async res => {
            let html = await res.text();
            console.log(html)
            document.documentElement.innerHTML = html;
            history.pushState({
                url: "/navigator.php"
            }, "Preview", "navigator.php");
        });
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
<?PHP

if (isset($_POST['top_header']) && isset($_POST['sub_header']) && isset($_POST['content'])) {
    $top_header = $_POST['top_header'];
    $sub_header = $_POST['sub_header'];
    $content = $_POST['content'];
    $json[$top_header][$sub_header] = $content;
    if (file_put_contents($file, json_encode($json, true))) {
        echo "<script>alert('Content is entered successfully!')</script>";
    }
}
?>