<?php
include ('header.php');
?>

    <section class="intro wrapper">
        <h1>Prisijungimas</h1>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submit">Prisijungimas</button>
            <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Užpildykite visus laukus</p>";
            }
            else if ($_GET["error"] == "wronglogin") {
                echo "<p>Blogi prisijungimo duomenys</p>";
            }
        }
        ?>
        </form>
       
    </section>
<?php
include 'footer.php' 
?>