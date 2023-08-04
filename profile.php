<?php
include('header.php');
?>
<?php
if (isset($_SESSION["useruid"])) {
   
    ?>
    <section class="intro wrapper register_login_section register">
        <?php    echo "<p>Hello there " . $_SESSION["useruid"] . "</p>"; ?>
        <?php    echo "<p>Hello there " .  $_SESSION["userid"] . "</p>"; ?>
        <br>
        
        
        <div class="mdl-dialog__content">
            <h4 class="page-title">Profilio atnaujinimas</h4>
            <form action="includes/update.inc.php" method="post">
                <div class="input">
                    <div class="label">
                        <p class="input-name"> Vardas</p>
                    </div>
                    <div class="really-input-div"><input type="text" name="name"></div>
                </div>
                <div class="input">
                    <div class="label">
                        <p class="input-name"> Pavardė</p>
                    </div>
                    <div class="really-input-div"><input type="text" name="lastname"></div>
                </div>
                <div class="input">
                    <div class="label">
                        <p class="input-name"> El. Paštas</p>
                    </div>
                    <div class="really-input-div"><input type="text" name="email"></div>
                </div>
                <div class="input">
                    <div class="label">
                        <p class="input-name"> Slaptažodis</p>
                    </div>
                    <div class="really-input-div"><input type="password" name="pwd"></div>
                </div> 
                 <div class="input">
                    <div class="label">
                        <p class="input-name">Slaptažodžio pakartojimas</p>
                    </div>
                    <div class="really-input-div"><input type="password" name="pwdRepeat"></div>
                </div>
                <div class="submit-btn-div">
                <button class="submit-btn" type="submit" name="submit">Atnaujinti</button>
            </div>
            </form>
        </div>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p>Fill in all fields!</p>";
            } else if ($_GET["error"] == "invalidemail") {
                echo "<p>Choose a proper email!</p>";
            } else if ($_GET["error"] == "passwordsdontmatch") {
                echo "<p>Passwords doesn't match!</p>";
            } else if ($_GET["error"] == "invalidpassword") {
                echo "<p>Slaptažodį turi sudaryti bent viena didžioji raidė ir bent vienas skaičius!</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p>Something went wrong, try again</p>";
            } else if ($_GET["error"] == "usernametaken") {
                echo "<p>Username already taken!</p>";
            } else if ($_GET["error"] == "none") {
                echo "<p>Profilio duomenys buvo atnaujinti</p>";
            }
        }
        ?>
    </section>
    <?php


} else {
    echo "<section class='intro'>
                <h1>Baksnotojas 2000</h1>
            </section>";

}
?>
<?php
include 'footer.php'
    ?>