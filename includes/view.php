<?php
session_start();
include "dbh.inc.php";

$limit = 10;
$page = 1;

// if (isset($_GET['pageno'])) {
//     $pageno = $_GET['pageno'];
// } else {
//     $pageno = 1;
// }

// $total_pages_sql = "SELECT COUNT(*) FROM users";
// $result = mysqli_query($conn,$total_pages_sql);
// $total_rows = mysqli_fetch_array($result)[0];
// $total_pages = ceil($total_rows / $no_of_records_per_page);

if (isset($_POST['page']) && is_numeric($_POST['page'])) {
    $page = max((int)$_POST['page'], 1);
}
$offset = ($page > 1) ? ($limit * ($page - 1)) : 0;
$query = " FROM users WHERE 1=1 ";
if (isset($_POST['keyword']) && strlen($_POST['keyword']) > 0) {
    $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);
    $query .= "and (users.user_first LIKE \"%" . $keyword . "%\" ";
    $query .= "or users.user_last LIKE \"%" . $keyword . "%\" ";
    $query .= "or users.user_email LIKE \"%" . $keyword . "%\") ";
}
$query .= "";
//$query .= "LIMIT $limit OFFSET $offset";

$queryItems = "SELECT user_id, user_first, user_last, user_email, 
       (SELECT count(*) from pokes where to_uid = user_id
and pokes.from_uid = \"" . mysqli_real_escape_string($conn, $_SESSION['userid']) . "\" 
) as pokes_count " . $query .
    " GROUP BY users.user_id  LIMIT $limit OFFSET $offset ";
$queryCount = 'select count( DISTINCT users.user_id) as count' . $query;
$result = $conn->query($queryCount);
$count = mysqli_fetch_assoc($result)['count'];
$resultItems = $conn->query($queryItems);
$total_pages = ceil($count / $limit);
?>
<?php
while ($rowtwo = mysqli_fetch_array($resultItems)) {
    ?>
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-phone">
            <?php echo $rowtwo['user_first']; ?>
        </div>
        <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-phone">
            <?php echo $rowtwo['user_last']; ?>
        </div>
        <div class="mdl-cell mdl-cell--4-col mdl-cell--12-col-phone">
            <?php echo $rowtwo['user_email']; ?>
        </div>
        <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-phone">
            <?php echo $rowtwo['pokes_count']; ?>
        </div>
        <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-phone">
            <button class="sendPoke" data-poketo="<?php echo $rowtwo['user_id']; ?>">
                Poke
            </button>
        </div>
    </div>


    <?php

}
?>

    <ul class='pagination'>
<?php
if ($page > 1)
    echo "<li><a href='#' data-searchpagination='keyword=" . $_POST['keyword'] . "&page=" . ($page - 1) . "' class='button'>Previous</a></li>";

for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
        echo "<li class='active'> <span>" . $page . "</span></li>";
    } else {
        echo "<li><a href='#' data-searchpagination='keyword=" . $_POST['keyword'] . "&page=" . $i . "'>" . $i . "</a></li>";
    }

};

if ($page < $total_pages) //only show next if current page is less than total page
    echo "<li><a href='#' data-searchpagination='keyword=" . $_POST['keyword'] . "&page=" . ($page + 1) . "' class='button'>NEXT</a></li>";

echo "</ul>";