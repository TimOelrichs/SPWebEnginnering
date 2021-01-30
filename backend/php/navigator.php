<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
    header("Location: login.php");
    exit;
}
?>

<body>
    <header>
        <h1>WWW-Navigator</h1>
        <nav>
            <ul id="mainnav"></ul>
        </nav>
        <a href="logout.php">Log Out</a>
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
    <script>
        let json;
        async function getData() {
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
                li.addEventListener('click', () => menuItemClickHandler(key));
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