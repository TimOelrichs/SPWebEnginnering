<?php
session_start();

$file = "../common/data/data.json";

function isPreviewMode()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION["login"]) && $_SESSION["login"] == 1;
}

function getData()
{
    if (isPreviewMode()) {
        return file_get_contents('php://input');
    }
    global $file;
    $contents = file_get_contents($file);
    $json = json_decode($contents, true);
    return json_encode($json);
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

    <body>
        <div id="site">
            <header>
                <div>
                    <h1>WWW-Navigator</h1>
                    <div>
                        <?php if (!isset($_SESSION["login"]) || $_SESSION["login"] != 1) {
                            echo '<a href="./login.php">login</a>';
                        } else {
                            echo '<a href="./logout.php">logout</a>';
                        }

                        ?>
                    </div>
                </div>

                <nav>
                    <ul id="mainnav"></ul>
                </nav>
            </header>
            <aside id=left>
                <h4>Themen:</h4>
                <nav>
                    <ul id="leftnav"></ul>
                </nav>
            </aside>
            <article id="content">

            </article>
            <aside id="right">
                <h4>Referenzen:</h4>
                <nav>
                    <ul id="rightnav"></ul>
                </nav>
            </aside>

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
                let json = <?PHP echo getData()

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
                    li.addEventListener('click', (event) => showContent(event, subCat, key));

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
                console.log(json[subCat][key].references.map(r => `<a href="${r}>${r}</a>`).join())
                right.innerHTML = json[subCat][key].references.map(r => `<a href="${r}">${r.split("/").pop()}</a>`).join();
            }

            function menuItemClickHandler(event, subCat) {
                document.querySelector('.active_main')?.classList.remove('active_main');
                event.target.classList.add('active_main');
                createSideMenu(subCat)
            }
        </script>
    </body>

</html>