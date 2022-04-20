<form action ="<?= URLROOT;?>/students/create" method="post">
    <table>
        <tbody>
            <tr>
                <td>
                    <label for="voornaam"> vul hier je voornaam in</label>
                <input type="text" name="voornaam" id="voornaam">
                </td>
            </tr>
            <tr>
                <td> 
                    <label for="tussenvoegsel"> vul hier je tussenvoegsel in</label>
                    <input type="text" name="tussenvoegsel" id="tussenvoegsel" >
                </td>
            </tr>
            <tr>
                <td>
                <label for="achternaam"> vul hier je achternaam in</label>    
                <input type="text" name="achternaam" id="achternaam" >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email"> vul hier je email in</label>    
                    <input type="text" name="email" id="email" >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="telefoonnumer"> vul hier je telefoonnummer in</label>    
                    <input type="nummer" name="telefoonnumer" id="telefoonnummer" >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="klas"> vul hier je klas in</label>    
                    <input type="text" name="klas" id="klas" >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="studentnummer"> vul hier je studentnummer in</label>    
                    <input type="nummer" name="studentnummer" id="studentnummer" >
                </td>
            </tr>
            <tr>
                <td>
                    <label for="beroep"> vul hier je beroep in</label>    
                    <input type="text" name="beroep" id="beroep" >
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit"  value="verzenden">
                </td>
            </tr>

        </tbody>

  
</table>
</form>