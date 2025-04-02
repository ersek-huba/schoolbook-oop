<?php

$tableBody = "";

foreach ($subjects as $subject)
{
    $tableBody .= <<<HTML
        <tr>
            <td>{$subject->id}</td>
            <td>{$subject->name}</td>
            <td class='flex float-right'>
                <form method='post' action='/subjects/edit'>
                    <input type='hidden' name='id' value='{$subject->id}'>
                    <button type='submit' name='btn-edit' title='Módosít'>Módosít</button>
                </form>
                <form method='post' action='/subjects'>
                    <input type='hidden' name='id' value='{$subject->id}'>
                    <input type='hidden' name='_method' value='DELETE'>
                    <button type='submit' name='btn-del' title='Töröl'>Töröl</button>
                </form>
            </td>
        </tr>
    HTML;
}

$html = <<<HTML
    <table id="admin-subjects-table" class="admin-subjects-table">
    <thead>
        <th>#</th>
        <th>Tantárgy</th>
        <th>
            <form method="POST" action="/subjects/create">
                <button type="sumbit" name="btn-plus" title="Új">Új</button>
            </form>
        </th>
    </thead>
    <tbody>%s</tbody>
    <tfoot></tfoot>
    </table>
HTML;

echo sprintf($html, $tableBody);