<section class="Liste_pizza"> 
 <form class="form_ListePizza">
    <ul>
    <?php
        foreach ($pizzas as $pizza) { 
            $id = $pizza->get('id_pizza');
    ?>
        <li>
            <a href = "index.php?objet=pizza&action=getIngredientList&id=<?php $id ?>">
            <div> 
                <?php 

                     echo "<h3> ". $pizza->get('nom_pizza'). "</h3>";
                     echo   $pizza->get('prix_pizza');
                 ?> 
            </div>

            </a>
        </li> 
    <?php   
        }
    ?>
    </ul>

    <a href="index.php?objet=pizza&action=create"><button> Nouvelle pizza</button></a>
   </form>
</section>
