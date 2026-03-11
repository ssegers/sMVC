<?php

namespace cmd;

/**
 * executes migrations
 *
 * @author seger
 */

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use core\Application;
use Dotenv\Dotenv;

class MigrateCommand extends Command
{
    protected string $commandName = 'migrate';
    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription('Execute database migrations')
            ->setHelp('This command executes the database migrations');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();

        $output->writeln([
            '',
            '<info>Database Migrations</info>',
            '<info>===================</info>',
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

        try {
            if ($app->db !== null) {
                $app->db->migrate();
                $output->writeln('<info>Migrations completed successfully.</info>');
            } else {
                $output->writeln("<error>Can't execute migrations, no database connection.</error>");
                return Command::FAILURE;
            }
        } catch (\Throwable $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}