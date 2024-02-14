<?php

// namespace Mdevoldere\PhpLibrary\Db;
namespace Nrobson\MachineAVoter\src\Db;

use Exception;
use PDO;

/**
 * Connexion à la base de données (SINGLETON)
 */
class DbConnect
{
    private $cfg;
    private static $config;
    /**
     * Constructeur privé (la classe n'est pas instanciable)
     */
    private function __construct()
    {
    }

    /** @var PDO $instance l'instance PDO unique */
    private static ?PDO $instance = null;

    /** @var PDO $instances tableau d'instances PDO */
    private static ?PDO $instances = null;

    /**
     * Récupère l'instance unique de PDO
     * La crée si elle n'existe pas encore
     * @return PDO l'instance de PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            self::$instance = new PDO(
                'mysql:host=' . self::$config['db_host'] . ';port=' . self::$config['db_port'] . ';dbname=' . self::$config['db_name'] . ';charset=utf8',
                self::$config['db_user'],
                self::$config['db_password'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        }
        return self::$instance;
    }

    public static function setCurrentInstance($newPath): PDO
    {
        if (is_file($newPath)) {
            $c = require $newPath;

            // ==============================================================================
            self::$instance = new PDO(
                'mysql:host=' . self::$config['db_host'] . ';port=' . self::$config['db_port'] . ';dbname=' . self::$config['db_name'] . ';charset=utf8',
                self::$config['db_user'],
                self::$config['db_password'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        }
        return self::$instance;
    }

    public static function setConfiguration(string $chemin): void
    {
        if (is_file($chemin)) {
            self::$config = require $chemin;
        } else {
            throw new Exception('Configuration base de données invalide');
        }
    }
}
