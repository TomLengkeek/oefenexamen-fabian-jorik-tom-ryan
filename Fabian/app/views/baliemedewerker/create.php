create

<form action="<?= URLROOT; ?>/baliemedewerker/create" method="post">
    <table>
        <tbody>
            <tr>
               
                <td> 
           
                     <label for="studentnummer"> vul hier je studentnummer in</label>
                <input type="number" name="studentnummer" id="studentnummer" ></td>
             
            </tr>
            <tr>
           
                <td>
             
                <label for="voornaam"> vul hier je voornaam in</label> 
                <input type="text" name="voornaam" id="voornaam" ></td>
               
            </tr>
            <tr>
            
                <td>

                    <label for="tussenvoegsel"> vul hier je tussenvoegsel in</label>
                <input type="text" name="tussenvoegsel" id="tussenvoegsel" ></td>
            </tr>
            <tr>
           
                <td> 
                
                    <label for="achternaam">vul hier je achternaam in</label>
                <input type="text" name="achternaam" id="achternaam" ></td>
                
            </tr>

            <tr>
           
                <td> 
                
                    <label for="email">vul hier je email in</label>
                <input type="text" name="email" id="email" ></td>


            </tr>
           
            <tr>
                <td>
                    <input type="submit" value="verzenden">
                </td>
            </tr>
        </tbody>
    </table>
</form>