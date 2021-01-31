<!doctype html>
<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: login.php");
    exit;
}
?>
<h1>Fill with contents</h1>
<style>
    textarea {
        margin: 1rem;
        display: block;
        width: 80vw;
        height: 20vh;
    }

    input {
        height: 20px;
        margin: 1rem;
    }

    select {
        height: 20px;
        width: 100px;
    }

    label {
        padding: 5px;
        width: 150px;
    }
</style>

<div id="form">
    <legend>Select content area and add a new text:</legend>
    <select name="top_header">
    </select>
    <label for="newheader">Neue Kategorie:</label>
    <input type="text" name="newheader" id="newHeader"><button onclick="addHeader()">+</button>
    <br>
    <select name="sub_header">
    </select>
    <label for="newsubheader">Neue Unterkategorie:</label>
    <input type="text" name="newsubheader" id="newSubHeader">
    <button onclick="addSubHeader()">+</button>
    <textarea name="content"></textarea>
    <textarea name="references"></textarea>
    <input type="submit" value="Submit" id="submit">
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
            fetch(new Request("./server.php"), {
                method: 'POST',
                mode: 'cors',
                cache: 'no-store',
                body: JSON.stringify(Array.from(document.querySelectorAll('.form'))
                    .reduce((json, input_field) => {
                        json[input_field.id] = input_field.value;
                        return json
                    }, {})),
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        }); <
        /
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
        console.log(top_header)
    }

    function addSubHeader() {
        const option = document.createElement('option');
        option.value = txt_NewSubHeader.value;
        option.innerText = txt_NewSubHeader.value;
        sub_header.append(option);
        json[top_header.value][txt_NewSubHeader.value] = {};
        updateSubheaders(top_header.value);
        txt_NewSubHeader.value = "";
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