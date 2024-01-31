<section class="ListeIngredient_pizza"> 
 <form>
    <ul>
    <?php
        foreach ($pizza as $ingredient) { 
            $id = $ingredient->get('id_ingredient');
    ?>
        <li>
            <div> 
                <?php 

                     echo "<h3> ". $ingredient->get('nom_ingredient'). "</h3>";
                     echo "<h3>". $ingredient->get('quantite_ingredient'). "/<h3>";
                 ?> 
            </div>

            </a>
        </li> 
    <?php   
        }
    ?>
    </ul>
   </form>
</section>
