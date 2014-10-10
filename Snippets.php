<!-- Snippety snippety snopp -->


<!--Här är ett exempel på hur vi får ut en dropdownlist från databasen.
Vet inte hur man använder det sen, men det sa david att han kan-->
<table>
    <tr>  
        <td>Funktionär:</td>  
        <td><select name="Funktionar">  
            <?php  

                $STHtest = $DBH->query('SELECT FunktionarsID, Namn FROM Funktionar');   
                while($row = $STHtest->fetch()) { 
                    echo '<option value="' . $row['FunktionarsID'] . '"> ' . $row['Namn'] .     '</option>';  
                }
            ?>  
        </select></td>  
    </tr>  
</table> 


