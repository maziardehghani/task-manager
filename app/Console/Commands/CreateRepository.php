<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create repository by artisan command';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        if (!is_dir(app_path('Repositories/'))) {
            mkdir(app_path('Repositories/'));
        }


        if (file_exists(app_path('Repositories/' . $this->argument('name') . '/' . $this->argument('name') . 'Repository.php'))) {
            $this->error('repository already exists!');
            return CommandAlias::FAILURE;
        }

        if (!is_dir(app_path('Repositories/' . $this->argument('name') . '/'))) {
            mkdir(app_path('Repositories/' . $this->argument('name') . '/'));
        }

        try {
            $filename = app_path('Repositories/' . $this->argument('name') . '/') .$this->argument('name') . 'Repository.php';

            $className = $this->argument('name') . 'Repository';

            $file = fopen($filename, "w");

            $content = "<?php

namespace App\Repositories\\{$this->argument('name')};

class {$className} extends Repository {

      public function __construct()
      {
          // to do define model for this repository
      }

}

            ";
            fwrite($file, $content);

            fclose($file);
            $this->info('repository successfully created!.');
            return CommandAlias::SUCCESS;

        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return CommandAlias::FAILURE;
        }

    }
}
