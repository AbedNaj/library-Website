<?php
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = require_once __DIR__ . '/../config/database.php';
        
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                // منع الاتصالات المستمرة
                PDO::ATTR_PERSISTENT => false
            ];

            $this->connection = new PDO($dsn, $config['username'], $config['password'], $options);
        } catch (PDOException $e) {
            // تسجيل الخطأ في ملف log
            error_log("Database Connection Error: " . $e->getMessage());
            // رسالة خطأ عامة للمستخدم
            throw new Exception("Something Went Wrong , Please Try Again Later... " );
        }
    }

    // منع نسخ الكائن
    private function __clone() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    // دالة للتحقق من حالة الاتصال
    public function checkConnection() {
        try {
            $this->connection->query('SELECT 1');
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}

// للاستخدام في بقية الملفات
try {
    $database = Database::getInstance();
    $pdo = $database->getConnection();
} catch (Exception $e) {
    // معالجة الخطأ بشكل مناسب
    die($e->getMessage());
}