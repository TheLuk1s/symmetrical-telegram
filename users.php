<?php
require_once 'includes/dbh.inc.php';
include('header.php');




if (isset($_SESSION["useruid"])) {
    echo "<p>Vartotojai</p>";
    ?>
    <section>
        <div class="mdl-dialog__content">
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--2-col">
                  <p class="user-title">Vardas</p>
                    <?php $query = ("SELECT user_first FROM users");
                    $result = $conn->query($query);
                    while ($rowtwo = mysqli_fetch_array($result)) {
                        echo $rowtwo['user_first'];
                        echo "<br>";
                    }
                    ?>
                </div>
                <div class="mdl-cell mdl-cell--2-col">
                <p class="user-title">Pavardė</p>
                    <?php $query = ("SELECT user_last FROM users");
                    $result = $conn->query($query);
                    while ($rowtwo = mysqli_fetch_array($result)) {
                        echo $rowtwo['user_last'];
                        echo "<br>";
                    }
                    ?>
                </div>
                <div class="mdl-cell mdl-cell--2-col">
                <p class="user-title">El. Paštas</p>
                    <?php $query = ("SELECT user_email FROM users");
                    $result = $conn->query($query);
                    while ($rowtwo = mysqli_fetch_array($result)) {
                        echo $rowtwo['user_email'];
                        echo "<br>";
                    }
                    ?>
                </div>
                </div>
                <div class="mdl-cell mdl-cell--2-col">Poke skaičius</div>
                <div class="mdl-cell mdl-cell--2-col">Button</div>
            </div>
        </div>
    </section>
    <?php
}
?>