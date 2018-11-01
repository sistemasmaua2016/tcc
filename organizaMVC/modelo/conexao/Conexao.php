<?php

abstract class Conexao {

    private static $instancia;

    public static function getConexao() {
        try {
            if (!isset(self::$instancia)) {
                $usuario = "root";
                $senha = "";
                self::$instancia = new PDO("mysql:host=localhost;dbname=controle_financeiro;charset=UTF8", $usuario, $senha);
            }
            return self::$instancia;
        } catch (PDOException $e) {
            echo "Erro ao conectar no banco de dados: " . $e->getMessage();
        }
    }

}
