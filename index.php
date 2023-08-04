<?php
include('header.php');
require_once 'includes/dbh.inc.php';

if (isset($_SESSION["useruid"])) {
?>
    <?php $query = ("SELECT user_id, user_first, user_last, user_email FROM users");
    $result = $conn->query($query);
    ?>
    <section class="main-section">
        <div class="mdl-dialog__content">
            <div class="input-group search-div">
                <input type="text" class="form-control search-bar" placeholder="Ieškoti pagal vardą" id="keyword">
                <span class="input-group-btn">
                    <button class="search-submit" type="button" id="btn-search" >SEARCH</button>
                    <!-- <a href="" class="btn btn-warning">RESET</a> -->
                </span>
            </div>
            <div class="mdl-grid  display-d-flex">
                <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-phone">
                    <p class="user-title">Vardas</p>
                </div>
                <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-phone">
                    <p class="user-title">Pavardė</p>
                </div>
                <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone">
                    <p class="user-title">El. Paštas</p>
                </div>
                <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-phone">
                    <p class="user-title">Poke skaičius</p>
                </div>
                <!-- <div class="mdl-cell mdl-cell--2-col"> -->
                    <!-- <p class="user-title">Send Poke</p> -->
                <!-- </div> -->
            </div>
            <div id="view">
                <?php include "includes/view.php"; ?>
            </div>
            
            <script>

            </script>
            <div id="display"></div>



        </div>
        </div>
    </section>
<?php
} else {
    echo '
    <section class="intro wrapper register_login_section login">
    <div class="mdl-dialog__content">
        <h4 class="page-title">Prisijungimas</h4>
        <form action="includes/login.inc.php" method="post" >
        <input  class="input" type="text" name="uid" placeholder="Prisijungimo vardas">
        <input  class="input" type="password" name="pwd" placeholder="Slaptažodis">
    <div class="login_register mt-4 mb-5">
        <button type="submit" name="submit" class="submit-btn">Prisijungimas</button>
    <div class="sgn-btn"><a href="signup.php">Registracija</a> </div>
    </div>
    </div>
    </section>';
}

if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "<p>Užpildykite visus laukus</p>";
    } else if ($_GET["error"] == "wronglogin") {
        echo "<p>Blogi prisijungimo duomenys</p>";
    }
}
    
'</form>';

   

include "footer.php";

?>
