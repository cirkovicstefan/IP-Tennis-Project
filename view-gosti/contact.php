<?php
require_once './partials/navigacija.php';

$podsetnik = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ 
    $podsetnik = Provera_unosa($_POST["podsetnik"]);

} 
function Provera_unosa($data) 
{ 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
}
?>

<div class="container" style="background-image: url('./images/image-tenis.jpg'); overflow:scroll; background-repeat: no-repeat; background-size: cover;text-align: center">
<div style="border: 1px solid red; background-color:white; border-radius: 10px;padding: 1rem; margin:2rem">
<h1 >Kontakt</h1>
    <div class="row mt-4" style="width: 90%;margin-left:auto;margin-right:auto">
        
           
            <h4>Lokacija: Svetog Save 66, Čačak</h4>
            <h4>Broj telefona: 062/242424</h4>
            <h4>Email: <a href="mailto:rekeativnitenis@gmail.com">rekreativnitenis@gmail.com</a></h4>

    </div>
    <a href="home.php"><img src="./images/reket.png"  alt="logo-reket"></a>

    <div>
     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
         Podsetnik:<input type="text" name="podsetnik"><br><br> 
         <input type="submit" value="Pošalji"> 
     </form><br>
     
     <small>Upozorenje: Sadržaj iz podsetnika se briše napuštanjem stranice.</small>
     <div style="border: 2px solid red; background-color:white; border-radius: 10px;padding: 1rem; margin:2rem; text-align:left">
     <p><?php echo "<h5>Vaš podsetnik:</h5>"; echo $podsetnik; ?></p>
     </div>
</div>
</div>

</div>
<?php
require_once './partials/podnozije.php';
?>