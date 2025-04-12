<?php

namespace app\libs;

use app\libs\DB;

class MigrationRunner {

    protected $db;
    protected $migrationPath;

    public function __construct($migrationPath = __DIR__ . '/../../migrations') {

        $this->migrationPath = $migrationPath;
        $this->db            = new DB();

        $this->createMigrationsTable();
    }

    public function createMigrationsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            filename VARCHAR(255) NOT NULL,
            applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";

        $this->db->query($sql);
    }

    public function runAll(): array {
        $messages = [];

        $applied = $this->getAppliedMigrations();
        $files = glob($this->migrationPath . '/*.php');
        sort($files);

        foreach ($files as $file) {
            $filename = basename($file);
            if (in_array($filename, $applied)) {
                $messages[] = "Skipping already applied: $filename";
                continue;
            }

            require_once $file;

            if (!function_exists('up')) {
                $messages[] = "❌ Migration file $filename does not define 'up' function.";
                continue;
            }

            try {
                $callable = 'up';
                if (is_callable($callable)) {
                    $callable($this->db);
                }
                $this->saveMigration($filename);
                $messages[] = "✅ Applied: $filename";
            } catch (\Throwable $e) {
                $messages[] = "❌ Error in $filename: " . $e->getMessage();
            }
        }

        return $messages;
    }

    protected function getAppliedMigrations(): array {
        $rows = $this->db->row("SELECT filename FROM migrations");
        return array_column($rows, 'filename');
    }

    protected function saveMigration(string $filename): void {
        $this->db->query("INSERT INTO migrations (filename) VALUES (:filename)", [
            'filename' => $filename
        ]);
    }


}