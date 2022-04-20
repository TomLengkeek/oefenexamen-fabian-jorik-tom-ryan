<!-- Form om de docentgegevens te updaten -->
<form action="<?= URLROOT; ?>/docenten/update" method="post">
    <table>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="afkorting" id="afkorting" value="<?= $data['row']->afkorting; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="voornaam" id="voornaam" value="<?= $data['row']->voornaam; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="tussenvoegsel" id="tussenvoegsel" value="<?= $data['row']->tussenvoegsel; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="achternaam" id="achternaam" value="<?= $data['row']->achternaam; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="email" id="email" value="<?= $data['row']->email; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="telnum" id="telnum" value="<?= $data['row']->telnum; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="mentorklas" id="mentorklas" value="<?= $data['row']->mentorklas; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="id" value="<?= $data['row']->id; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Verzenden">
                </td>
            </tr>
        </tbody>
    </table>
</form>