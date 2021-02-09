<?php
session_start();

include "../common/util/content.php"

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
                <div class="headline">
                    <h1> <a href="./navigator.php">PHP WWW-Navigator</a></h1>
                    <div>
                        <?php if (isset($_SESSION["user"])) {
                            echo "Willkommen," . ucwords($_SESSION['user']) . "!";
                        }
                        ?>
                    </div>
                    <div>
                        <?php if (isset($_SESSION["login"]) && $_SESSION["login"] == 1) {
                            echo '<a class="editFab" href="./editor.php"><i class="material-icons">edit</i></a>';
                            echo '<a class="btn" href="./logout.php">logout</a>';
                        } else {
                            echo '<a class="btn" href="./login.php">login</a>';
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
                <a>Sitemap</a>
                <a>Home</a>
                <a>News</a>
                <a>Contact</a>
            </footer>
        </div>


        <script>
            async function getData() {
                let json = <?PHP echo json_encode(getAllData(), true);

                            ?>;
                return json;
            }

            async function init() {
                try {
                    json = await getData();
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
                console.log(json[subCat][key].references.map(r => `<a href="${r}>${r}</a>`).join(""))
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