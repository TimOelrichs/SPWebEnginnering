<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP WWW-Navigator</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div id="site">
        <header>
            <div class="flex">
                <h1>PHP WWW-Navigator</h1>
                <p>Hallo, <?php echo ucwords($_SESSION['user']) ?>!</p>
                <div class="flex">
                    <a class="btn edit" href="editor.php"><i class="material-icons">edit</i></a>
                    <a class="btn" href="logout.php">Log Out</a>
                </div>

            </div>
            <nav>
                <ul id="mainnav"></ul>
            </nav>
        </header>
        <main>
            <aside id="left">
                <nav>
                    <ul id="leftnav"></ul>
                </nav>
            </aside>
            <section id="content">

            </section>
            <aside id="right">
            </aside>
        </main>
        <footer>
            <h1>Footer:</h1>
            <a>Sitemap</a>
            <a>Home</a>
            <a>News</a>
            <a>Contact</a>
        </footer>
    </div>
    <script>
        async function getData() {
            let json = <?PHP
                        $file = "./data/data.json";
                        $contents = file_get_contents($file);
                        $json = json_decode($contents, true);
                        echo json_encode($json)
                        ?>;
            //let data = await fetch("./content.php")
            return json;
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
                const a = document.createElement('a');
                a.textContent = key;
                a.addEventListener('click', () => menuItemClickHandler(key));
                li.appendChild(a);
                nav.appendChild(li)
                if (!i++) createSideMenu(key)
            }
        }

        function createSideMenu(subCat) {
            let nav = document.getElementById('leftnav');
            nav.innerHTML = "";
            let i = 0;
            for (const key of Object.keys(json[subCat])) {
                const li = document.createElement('li');
                li.textContent = key;
                li.addEventListener('click', () => showContent(subCat, key));
                nav.appendChild(li);
                if (!i++) showContent(subCat, key);
            }
        }

        function showContent(subCat, key) {
            let content = document.getElementById('content');
            content.innerHTML = json[subCat][key].content;
            let right = document.getElementById('right');
            console.log(json[subCat][key].references.map(r => `<a href="${r}>${r}</a>`).join())
            right.innerHTML = json[subCat][key].references.map(r => `<a href="${r}">${r.split("/").pop()}</a>`).join();
        }

        function menuItemClickHandler(subCat) {
            createSideMenu(subCat)
        }
    </script>
</body>

</html>