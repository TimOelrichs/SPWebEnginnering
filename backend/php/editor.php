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
        margin: 1rem;
    }
</style>
<label for="newheader">Neue Rubrik</label>
<input type="text" name="newheader" id="newHeader"><button onclick="addHeader()">+</button>
<label for="newsubheader">Neue Unterkategorie</label>
<input type="text" name="newsubheader" id="newSubHeader"><button onclick="addSubHeader()">+</button>
<form method="post">
    <fieldset>
        <legend>Select content area and add a new text:</legend>

        <select name="top_header">
            <option value="html">HTML</option>
            <option value="css">CSS</option>
            <option value="javascript">JavaScript</option>
        </select>
        <select name="sub_header">
        </select>

        <textarea name="content"></textarea>
        <textarea name="references"></textarea>
        <input type="submit" value="Submit">
    </fieldset>
</form>
<?PHP
$file = '../data/data.json';
$contents = file_get_contents($file);
$json = json_decode($contents, true);

?>
<script>
    let json = <?PHP echo json_encode($json) ?>;
    const top_header = document.querySelector('select[name="top_header"]');
    const sub_header = document.querySelector('select[name="sub_header"]');
    top_header.addEventListener('change', e => {
        sub_header.innerHTML = "";
        Object.keys(json[e.target.value]).forEach(key => {
            const option = document.createElement('option');
            option.value = key;
            option.innerText = key;
            sub_header.append(option);
        });
    });

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
        let input = document.getElementById("newSubHeader");
        json[input.value] = {};
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