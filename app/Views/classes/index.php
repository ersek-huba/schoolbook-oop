<?php

$tableBody = "";

foreach ($classes as $class)
{
    $tableBody .= <<<HTML
        <tr>
            <td>{$class->id}</td>
            <td>{$class->code}</td>
            <td>{$class->year}</td>
            <td class='flex float-right'>
                <form method='post' action='/classes/edit'>
                    <input type='hidden' name='id' value='{$class->id}'>
                    <button type='submit' name='btn-edit' title='Módosít'>Módosít</button>
                </form>
                <form method='post' action='/classes'>
                    <input type='hidden' name='id' value='{$class->id}'>
                    <input type='hidden' name='_method' value='DELETE'>
                    <button type='submit' name='btn-del' title='Töröl'>Töröl</button>
                </form>
            </td>
        </tr>
    HTML;
}

$html = <<<HTML
    <table id="admin-classes-table" class="admin-classes-table">
    <thead>
        <th>#</th>
        <th>Osztály</th>
        <th>Év</th>
        <th>
            <form method="POST" action="/classes/create">
                <button type="sumbit" name="btn-plus" title="Új">Új</button>
            </form>
        </th>
    </thead>
    <tbody>%s</tbody>
    <tfoot></tfoot>
    </table>
HTML;

echo sprintf($html, $tableBody);