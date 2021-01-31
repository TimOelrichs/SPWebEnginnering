<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: login.php");
    exit;
}
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
        padding: 5px;
        width: 300px;
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
    <legend>Select content area and add a new text:</legend>
    <div>
        <select name="top_header">
        </select>
        <label for="newheader">Neue Kategorie:</label>
        <input type="text" name="newheader" id="newHeader"><button onclick="addHeader()">+</button>
    </div>
    <div>
        <select name="sub_header">
        </select>
        <label for="newsubheader">Neue Unterkategorie:</label>
        <input type="text" name="newsubheader" id="newSubHeader">
        <button onclick="addSubHeader()">+</button>
    </div>
    <div id="textareaHeader">
        <p>Content hinzufügen:</p>
        <button onclick="preview()"><i class="material-icons">preview</i>Vorschau</button>
    </div>
    <textarea name="content"></textarea>
    <div>
        <p>Referenzen hinzufügen:</p>
    </div>
    <textarea name="references"></textarea>
    <input type="submit" value="Submit" id="submit"><i class="material-icons">publish</i></input>
</div>

<?PHP
$file = '../data/data.json';
$contents = file_get_contents($file);
$json = json_decode($contents, true);
?>

<script>
    let json = <?PHP echo json_encode($json) ?>;
    const top_header = document.querySelector('select[name="top_header"]');
    const sub_header = document.querySelector('select[name="sub_header"]');
    const txt_NewHeader = document.getElementById("newHeader");
    const txt_NewSubHeader = document.getElementById("newSubHeader");
    const submit = document.getElementById("submit");

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
            updateSubheaders(e.target.value)
        });

        submit.addEventListener('click', (event) => {
            event.preventDefault();
            fetch(new Request("./editor.php"), {
                method: 'POST',
                mode: 'cors',
                cache: 'no-store',
                body: json
            }, {
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        });
    };



    function updateSubheaders(header) {
        let category = header || top_header.value;
        sub_header.innerHTML = "";
        Object.keys(json[header]).forEach(key => {
            const option = document.createElement('option');
            option.value = key;
            option.innerText = key;
            sub_header.append(option);
        });
    }

    function addHeader() {
        let input = document.getElementById("newHeader");
        let value = input.value;
        console.log(value)
        input.value = "";
        json[value] = {};
        const option = document.createElement('option');
        option.value = value;
        option.innerText = value;
        top_header.append(option);
        top_header.value = value;
        updateSubheaders(value);
    }

    function addSubHeader() {
        const option = document.createElement('option');
        let value = txt_NewSubHeader.value
        option.value = value;
        option.innerText = value;
        sub_header.append(option);
        json[top_header.value][value] = {};
        updateSubheaders(top_header.value);
        txt_NewSubHeader.value = "";
        sub_header.value = value;
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