<?php
function cleanInput($value) {
    return trim($value);
}

function displayValue($value) {
    return htmlspecialchars($value);
}
?>