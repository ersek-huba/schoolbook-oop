<?php

namespace App\Views;

class Layout
{
    public static function header($title = "Iskola")
    {
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="hu">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>$title</title>
            <!--<link href="/css/school.css" rel="stylesheet">-->
        </head>
        <body>
        HTML;
        self::navbar();
        self::handleMessages();
        echo '<div class="container">';
    }
    public static function handleMessages()
    {
        // TODO
    }
    public static function navbar()
    {
        echo <<<HTML
        <nav class="navbar">
            <ul class="nav-list">
                <li class="nav-button"><a href="/"><button style="button" title="Kezdőlap">Kezdőlap</button></a></li>
                <li class="nav-button"><a href="/subjects"><button style="button" title="Tantárgyak">Tantárgyak</button></a></li>
                <li class="nav-button"><a href="/classes"><button style="button" title="Osztályok">Osztályok</button></a></li>
            </ul>
        </nav>
        HTML;
    }
    public static function sidebar()
    {
        echo <<<HTML
        <aside>
            <h3>Sidebar</h3>
        </aside>
        HTML;
    }
    public static function footer()
    {
        echo <<<HTML
        </div>
        <footer>
            <hr>
            <p>2025 &copy; Érsek Huba</p>
        </footer>
        </body>
        </html>
        HTML;
    }
}