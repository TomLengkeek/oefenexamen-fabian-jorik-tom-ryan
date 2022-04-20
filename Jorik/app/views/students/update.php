<?= $data["title"]; ?>

<form action ="<?= URLROOT;?>/students/update" method="post">
    <table>
        <tbody>
            <tr>
                <td>
                <input type="text" name="voornaam" id="voornaam" value="<?=$data["row"]->voornaam; ?>">
                </td>
            </tr>
            <tr>
                <td><input type="text" name="tussenvoegsel" id="tussenvoegsel" value="<?=$data["row"]->tussenvoegsel; ?>"</td>
            </tr>
            <tr>
                <td><input type="text" name="achternaam" id="achternaam" value="<?=$data["row"]->achternaam; ?>"</td>
            </tr>
            <tr>
                <td><input type="text" name="email" id="email" value="<?=$data["row"]->email; ?>"</td>
            </tr>
            <tr>
                <td><input type="nummer" name="telefoonnumer" id="telefoonnummer" value="<?=$data["row"]->telefoonnumer; ?>"></td>
            </tr>
            <tr>
                <td><input type="text" name="klas" id="klas" value="<?=$data["row"]->klas; ?>"></td>
            </tr>
            <tr>
                <td><input type="nummer" name="studentnummer" id="klas" value="<?=$data["row"]->studentnummer; ?>"></td>
            </tr>
            <tr>
                <td><input type="text" name="beroep" id="beroep" value="<?=$data["row"]->beroep; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?=$data["row"]->id; ?>"></td>
            </tr>
            <tr>
                <td><input type="submit"  value="verzenden"></td>
            </tr>

        </tbody>

  
</table>
</form>