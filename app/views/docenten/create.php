<!-- Form om nieuwe docentgegevens toe te voegen aan de tabel -->
<form action="<?= URLROOT; ?>/docenten/create" method="post">
    <table>
        <tbody>
            <tr>
                <td>
                    <label for="afkorting">Afkorting</label>
                    <input type="text" name="afkorting" id="afkorting">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="voornaam">Voornaam</label>
                    <input type="text" name="voornaam" id="voornaam">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tussenvoegsel">Tussenvoegsel</label>
                    <input type="text" name="tussenvoegsel" id="tussenvoegsel">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="achternaam">Achternaam</label>
                    <input type="text" name="achternaam" id="achternaam">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">E-mailadres</label>
                    <input type="text" name="email" id="email">
                </td>
            </tr>
            <tr>
                <td>
                    <label for=" telnum">Telefoonnummer</label>
                    <input type="text" name="telnum" id="telnum">
                </td>
            </tr>
            <tr>
                <td>
                    <label for=" mentorklas">Mentorklas</label>
                    <input type="text" name="mentorklas" id="mentorklas">
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