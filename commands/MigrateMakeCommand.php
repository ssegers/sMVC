<?php

namespace cmd;

/**
 * Description of MigrateMakeCommand
 *
 * @author seger
 */

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use core\Application;
use Dotenv\Dotenv;

class MigrateMakeCommand extends Command
{
    protected static $defaultName = 'make:migration';

    protected function configure()
    {
        $this
            ->setDescription('Create new migration')
            ->setHelp('This command creates a new migration with the given name')
            ->addArgument('migration_name', InputArgument::REQUIRED, 'Name of the migration.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!isset($_ENV['DB_HOST'])) {
            $dotenv = Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->safeLoad();
        }

        $output->writeln([
            '',
            '<info>Create new database migration</info>',
            '<info>=============================</info>',
        ]);

        $config = [
            'application' => [
                'directory' => dirname(__DIR__) . '/application',
            ],
            'db' => [
                'active' => $_ENV['DB_ACTIVE'] ?? false,
                'host' => $_ENV['DB_HOST'] ?? null,
                'name' => $_ENV['DB_NAME'] ?? null,
                'user' => $_ENV['DB_USER'] ?? '',
                'password' => $_ENV['DB_PASSWORD'] ?? '',
            ],
        ];

        $app = new Application($config);

        if ($app->db === null) {
            $output->writeln("<error>No database connection.</error>");
            return Command::FAILURE;
        }

        $migration = $input->getArgument('migration_name');
        $migrationFileName = $app->db->createNewMigration($migration);

        if ($migrationFileName === false) {
            $output->writeln("<error>$migration already exists</error>");
            return Command::FAILURE;
        }

        $output->writeln("<info>Migration created: $migrationFileName</info>");

        return Command::SUCCESS;
    }
}