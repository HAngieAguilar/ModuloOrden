<?php

class Database {
    public static function connect() {
        $host = 'localhost';
        $db   = 'runnercar';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        // Conexión remota (opcional)
        // $host = 'sql208.byethost7.com';
        // $db   = 'b7_38984310_loginapp';
        // $user = 'b7_38984310';
        // $pass = 'Eileen123456789*';
        // $charset = 'utf8mb4';

        // Conexión remota InfinityFree (opcional)
        // $host = 'sql105.infinityfree.com';
        // $db   = 'if0_38984570_loginapp';
        // $user = 'if0_38984570';
        // $pass = 'Eileen123456789';
        // $charset = 'utf8mb4';

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            return new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);
        } catch (\PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
}




?>