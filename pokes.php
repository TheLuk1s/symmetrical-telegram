<?php
include('header.php');
require_once 'includes/dbh.inc.php';

if (isset($_SESSION["useruid"])) {
    //echo "<p>Hello there " . $_SESSION["useruid"] . "</p>";







    if (isset($_SESSION["useruid"])) {
        ?>
        <?php $query = ("
SELECT CONCAT( from_user.user_first, \" \", from_user.user_last ) AS user_from, 
       CONCAT( to_user.user_first, \" \", to_user.user_last ) AS user_to, 
       from_uid, the_date, to_uid FROM pokes
        INNER JOIN users as from_user on from_user.user_id = pokes.from_uid
        INNER JOIN users as to_user on to_user.user_id = pokes.to_uid
        ");
        $result = $conn->query($query);
        ?>
        <section class="main-section pokes">
            <div class="mdl-dialog__content">
                <h4 class="page-title">Poke istorija</h4>
                <!-- Search box. -->
                <input type="text" id="search" placeholder="Search" class="search-bar" />
                <!-- Suggestions will be displayed in below div. -->
                <div id="display"></div>
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--3-col">
                        <p class="user-title">Data</p>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col">
                        <p class="user-title">Siuntėjas</p>
                    </div>
                    <div class="mdl-cell mdl-cell--5-col">
                        <p class="user-title">Gavėjas</p>
                    </div>
                </div>
                <?php
                while ($rowtwo = mysqli_fetch_array($result)) {

                    ?>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--3-col">
                            <?php echo $rowtwo['the_date']; ?>
                        </div>
                        <div class="mdl-cell mdl-cell--4-col">
                            <?php echo $rowtwo['user_from']; ?>
                        </div>
                        <div class="mdl-cell mdl-cell--5-col">
                            <?php echo $rowtwo['user_to']; ?>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </section>
        <?php
    }


} else {

}
?>
<?php
include 'footer.php'
    ?>