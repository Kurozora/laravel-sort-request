<?php

namespace musa11971\SortRequest\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;

class SorterMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sort-request:make
                            {name* : Filter name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Sort Request sorter';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Sorter[s]';

    /**
     * Execute the console command.
     *
     * @throws FileNotFoundException
     *
     * @return mixed
     */
    public function handle(): void
    {

        $filters = $this->argument('name');

        foreach ($filters as $filter) {
            $filter = $this->sanitizeNameInput($filter);
            $name = $this->qualifyClass($filter);
            $path = $this->getPath($name);
            $this->makeDirectory($path);
            $this->files->put($path, $this->buildClass($name));
        }

        $this->info($this->type.' created successfully.');
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/sorter.stub';
    }

    /**
     * @param $name
     *
     * @return string
     */
    protected function sanitizeNameInput($name): string
    {
        return Str::studly(trim($name)) . 'Sorter';
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return 'App\Http\Sorters';
    }
}
