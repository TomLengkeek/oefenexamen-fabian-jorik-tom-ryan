create
<form action="<?= URLROOT; ?>/countries/create" method="post">
    <table>
        <tbody>
            <tr>
               
                <td>  <label for="name"> naam van land</label>
                <input type="text" name="name" id="name" ></td>
            </tr>
            <tr>
           
                <td>
                <label for="name"> naam hoofdstad</label> 
                <input type="text" name="capitalCity" id="capitalCity" ></td>
            </tr>
            <tr>
            
                <td>
                    <label for="name"> naam continent</label>
                <input type="text" name="continent" id="continent" ></td>
            </tr>
            <tr>
           
                <td> 
                    <label for="population">hoeveelheid mensen</label>
                <input type="number" name="population" id="population" ></td>
            </tr>
           
            <tr>
                <td>
                    <input type="submit" value="verzenden">
                </td>
            </tr>
        </tbody>
    </table>
</form>