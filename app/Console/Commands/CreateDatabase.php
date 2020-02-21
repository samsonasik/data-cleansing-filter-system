<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $database = env('DB_DATABASE');

        $pdo = new PDO(sprintf('mysql:host=%s;port=%d;', env('DB_HOST'), env('DB_PORT')), env('DB_USERNAME'), env('DB_PASSWORD'));
        $pdo->exec(sprintf('CREATE DATABASE IF NOT EXISTS %s', $database));

        $this->info(sprintf('Successfully created %s database', $database));
    }
}
