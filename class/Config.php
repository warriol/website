<?php

namespace class;

class Config
{
    private $debug = true;
    private $sessionName;
    private $DB_Host;
    private $DB_User;
    private $DB_Pass;
    private $DB_Name;
    private $conexion;
    private $QVcred = 'SELECT * FROM usuarios WHERE email = :email AND password = :password';
    private $QGNE = 'SELECT nombre FROM usuarios WHERE email = :email';
    public function __construct($envPath) {
        $this->debug("INICIO", "------------------------------------------------------//////");
        $this->debug("Config", "Constructor de Config");
        $this->sessionName = 'wda';
        $this->loadEnv($envPath);
        $this->dbConnect();
    }
    private function loadEnv($filePath): void {
        $this->debug("ApiConf", "Cargando variables de entorno");

        if (!file_exists($filePath)) {
            throw new Exception(".env file not found");
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);

            $this->setEnvVariable(trim($name), trim($value));
        }
    }
    private function setEnvVariable($name, $value): void {
        switch ($name) {
            case 'DB_HOST':
                $this->DB_Host = $value;
                break;
            case 'DB_USER':
                $this->DB_User = $value;
                break;
            case 'DB_PASS':
                $this->DB_Pass = $value;
                break;
            case 'DB_NAME':
                $this->DB_Name = $value;
                break;
        }
    }
    private function dbConnect(): void
    {
        /**
         * TODO:
         * para fines de prueba, se guardan los tokens en una base de datos local y las credenciales en un archivo .env
         * los datos de acceso a la BD estan sin encriptar por lo mismo
         */
        $this->debug("ApiConf", "Conectando a la base de datos");
        try	{
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            );
            $this->conexion = new PDO("mysql:host=".$this->DB_Host.";dbname=".$this->DB_Name."",$this->DB_User,$this->DB_Pass, $options);

            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conexion->exec("SET CHARACTER SET utf8");

            $this->debug("ApiConf", "Conexión exitosa a la base de datos");

        } catch (PDOException $e) {
            $msj = $e->getMessage();

            die("Connection failed: " . $msj);
        }
    }
    public function debug($var, $val = '-') {
        if ($this->debug) {
            $file = fopen("./debug.log", "a") or die("Error creando archivo");
            $texto = '[' . date("Y-m-d H:i:s") . ']::[' . $var . ']:-> [' . $val . ']';
            fwrite($file, $texto . PHP_EOL) or die("Error escribiendo en el archivo");
            fclose($file);
        }
    }
    function __destruct() {
        $this->debug("ApiConf", "Destructor de ApiClientConf");
    }
    public function verificarCredenciales($email, $password): false|string
    {
        $res = [];
        $this->debug("ApiConf", "Verificando credenciales");
        try {
            // Consulta preparada para prevenir inyección SQL
            $stmt = $this->conexion->prepare($this->QVcred);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $user = $stmt->fetch();

            if ($user) {
                // Usuario encontrado, iniciar sesión
                $this->debug("ApiConf", "Usuario encontrado, iniciando sesión");
                $_SESSION['iniciado'] = 'true';
                $_SESSION['user_id'] = $user['id'];
                $res = json_encode(['status' => 'success', 'message' => 'Login exitoso', 'data' => $this->getNombrePorEmail($email)]);
            } else {
                // Usuario no encontrado
                $this->debug("ApiConf", "Usuario no encontrado");
                $res = json_encode(['status' => 'error', 'message' => 'Email o contraseña incorrectos']);
            }
        } catch (PDOException $e) {
            $res = json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        return $res;
    }
    public function getSesionName()
    {
        return $this->sessionName;
    }
    private function getNombrePorEmail($email)
    {
        $stmt = $this->conexion->prepare($this->QGNE);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $nombre = $stmt->fetchColumn();
        return $nombre;
    }

}