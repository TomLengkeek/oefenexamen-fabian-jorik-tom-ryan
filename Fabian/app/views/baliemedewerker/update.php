<?php




?>
<form action="<?= URLROOT; ?>/baliemedewerker/update" method="post">
    <table>
        <tbody>
            <tr>
                <td><input type="nummer" name="studentnummer" id="name" value="<?=$data["row"]->studentnummer; ?>"></td>
            </tr>
            <tr>
                <td><input type="text" name="voornaam" id="capitalCity" value="<?=$data["row"]->voornaam; ?>"></td>
            </tr>
            <tr>
                <td><input type="text" name="tussenvoegsel" id="continent" value="<?=$data["row"]->tussenvoegsel; ?>"></td>
            </tr>
            <tr>
                <td><input type="text" name="achternaam" id="population" value="<?=$data["row"]->achternaam; ?>"></td>
            </tr>

            <tr>
                <td><input type="text" name="email" id="population" value="<?=$data["row"]->email; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?=$data["row"]->id;?>"></td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="verzenden">
                </td>
            </tr>
        </tbody>
    </table>
</form>