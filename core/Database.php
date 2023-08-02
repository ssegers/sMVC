<?php

namespace core;

use PDO;
use PDOException;

/**
 * sMVC database class
 *
 * @author     sedasoft stefan.segers@telenet.be
 * @package    sMVC\core
 * @version    1.0.0
 * @since      Class available since Release 1.0.0
 */
class Database
{
    public \PDO $pdo;
    protected string $migrationPath;

    /**
     * @param array<mixed> $dbConfig
     * @return void
     */
    public function __construct(array $dbConfig = []) : void
    {
        $this->migrationPath = (Application::$ROOT_DIR . '\database\migrations\\');
        $dbDsn = 'mysql:host=' . $dbConfig['host'] . ';port=3306;dbname=' . $dbConfig['name'];
        $username = $dbConfig['user'] ?? '';
        $password = $dbConfig['password'] ?? '';
        try {
            $this->pdo = new \PDO($dbDsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (\PDOException $e) {
            echo "connection to the database could not be established" ;
            exit;
        }
    }

    /**
     * executes the new migrations
     * 
     * @return void
     */
    public function migrate(): void
    {
        $this->createMigrationsTable();
        $migrated = $this->getExecutedMigrations();

        $newMigrations = [];
        $directoryTree = scandir($this->migrationPath);
        if ($directoryTree) {
            $allMigrations = array_slice($directoryTree, 2);//removes . and .. from the directory tree
            $toMigrate = array_diff($allMigrations, $migrated);
            if (!empty($toMigrate)) {
                foreach ($toMigrate as $migration) {
                    require_once $this->migrationPath . $migration;
                    $filename = pathinfo($migration, PATHINFO_FILENAME);
                    $classname = $this->getClassname($filename);
                    $instance = new $classname();
                    $this->showMessage("migrating $migration");
                    $sql = $instance->up();
                    try {
                        $this->pdo->exec($sql);
                        $this->showMessage("migrated $migration");

                        $this->saveMigration($migration);
                    } catch (PDOException $error) {
                        $this->showMessage("There is an error in your migration code: " . $error->getMessage());
                    }
                }
            } else {
                $this->showMessage("There are no migrations to execute");
            }
        } else {
            $this->showMessage("There are no migrations to execute");
        }
    }
    
    /**
     * creates the migrations table in the database if not exists 
     * 
     * @return void
     */
    protected function createMigrationsTable(): void
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )  ENGINE=INNODB;");
    }
    
    /**
     * gets all the executed migrations from the migrations table in the database
     * 
     * @return array<string> names of executed migrations
     */
    protected function getExecutedMigrations(): array
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();
        $executedMigrations = $statement->fetchAll(\PDO::FETCH_COLUMN);
        return $executedMigrations;
    }

    /**
     * saves the given migration into the database
     * 
     * @parm string $newMigration
     * @return void
     */
    protected function saveMigration(string $newMigration): void
    {
        //create string to insert
        //"('migration_file_name1'),('migration_file_name2'), ..."
        //$str = implode(',', array_map(fn($m) => "('$m')", $newMigrations));
        $str = "('" . $newMigration . "')";
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES 
            $str
        ");
        $statement->execute();
    }

    /**
     * gets the classname from the filename
     * 
     * @parm string $fileName
     * @return string
     */
    protected function getClassname(string $fileName): string
    {
        $parts = explode('_', $fileName);
        $classname = "";
        for ($partnum = 4; $partnum < count($parts); $partnum++) {
            $classname .= ucfirst($parts[$partnum]);
        }
        return $classname;
    }

    /**
     * shows a message in the console
     * 
     * @parm string $message
     * @return void
     */
    protected function showMessage(string $message): void
    {
        echo "[" . date("Y-m-d H:i:s") . "] - " . $message . PHP_EOL;
    }

   /**
     * Create a new migration in the /database/migrations folder.
     *
     * @param  string  $migrationName
     * @return mixed
     */
    public function createNewMigration(string $migrationName) : mixed
    {
        $migrationClassName = $this->createMigrationClassName($migrationName);
        if ($this->checkIfMigrationAlreadyExist($migrationClassName)) {
            return false;
        } else {
            $fileName = $this->getDatePrefix() . "_" . $migrationName . ".php";
            $data = $this->migrationClassData($migrationClassName);
            file_put_contents($this->migrationPath . $fileName, $data);
            return $fileName;
        }
    }
    /**
     * Ensure that a migration with the given name doesn't already exist.
     *
     * @param  string  $migrationName
     * @return bool
     */
    protected function checkIfMigrationAlreadyExist(string $migrationName): bool
    {
        if (! empty($this->migrationPath)) {
            $directoryTree = scandir($this->migrationPath);
            if ($directoryTree){
                $migrationFiles = array_slice($directoryTree, 2);//removes . and .. from the directory tree
                foreach ($migrationFiles as $migrationFile) {
                    require_once($this->migrationPath . $migrationFile);
                }
            }
        }

        if (class_exists($migrationName)) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * Get the date prefix for the migration.
     *
     * @return string
     */
    protected function getDatePrefix(): string
    {
        return date('Y_m_d_His');
    }

    /**
     * creates UperCamelCase ClassName based on the migrations name.
     *
     * @param string $migrationName
     * @return string
     */
    protected function createMigrationClassName(string $migrationName): string
    {
        $migrationClassName = "";
        $migrationNameParts = explode("_", $migrationName);
        foreach ($migrationNameParts as $part) {
            $migrationClassName .= ucfirst($part);
        }
        return $migrationClassName;
    }

    /**
     * return predefined content for the migration class.
     *
     * @param string $classname
     * @return string
     */
    protected function migrationClassData(string $classname): string
    {
        $data = <<<EOF
        <?php

        /**
         * Description of $classname
         *
         */
        class $classname {
            public function up()
            {

            }
            public function down() {

            }
        }
        EOF;
        return $data;
    }
}
