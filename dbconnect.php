<?php
try {
    $connection = new PDO(
        'mysql:host=localhost:3306;dbname=session_identification',
        'root',
        ''
    );
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $error) {
    echo $error->getMessage();
}
