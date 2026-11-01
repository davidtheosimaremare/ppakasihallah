<?php
if (function_exists('mysqli_connect')) {
    echo "Ekstensi MySQL diaktifkan di PHP.";
} else {
    echo "Ekstensi MySQL tidak diaktifkan di PHP.";
}
?>
