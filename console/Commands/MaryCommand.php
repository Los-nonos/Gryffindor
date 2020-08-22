<?php
declare(strict_types=1);

namespace Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;

final class MaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gorgory:usecase {action : The name of the use case}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator of architectural bases that a use case needs';

    private Filesystem $fileSystem;
    private Composer $composer;

    public function __construct(
        Filesystem $fileSystem,
        Composer $composer
    ) {
        parent::__construct();

        $this->fileSystem = $fileSystem;
        $this->composer = $composer;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $useCaseType = $this->ask('Do you need a query (q) o a command (c)? Put "q" or "c"');
        $attributes = $this->ask('What attributes do you need? Format: name-type (Ex.: name-Object,userId-int,age-?string)');
        $grouping = $this->ask('If you have a specific grouping, write it down (Ex.: /Grouping/Example)');
        $action = trim($this->argument('action'));

        $isCommand = $useCaseType === 'c';

        $actionFilePath = $this->buildActionFilePath($action, $grouping);
        $adapterFilePath = $this->buildAdapterFilePath($action, $grouping);
        $inputFilePath = $this->buildInputFilePath($action, $grouping, $isCommand);
        $handlerFilePath = $this->buildHandlerFilePath($action, $grouping, $isCommand);
        if (! $isCommand) $resultFilePath = $this->buildResultFilePath($action, $grouping);

        $this->info("\n1. File paths was built!\n");

        $actionClass = $this->buildActionClass($action, $grouping, $isCommand);
        $adapterClass = $this->buildAdapterClass($action, $grouping, $isCommand);
        $inputClass = $this->buildInputClass($action, $grouping, $attributes, $isCommand);
        $handlerClass = $this->buildHandlerClass($action, $grouping, $isCommand);
        if (! $isCommand) $resultClass = $this->buildResultClass($action, $grouping);

        $this->info("2. Classes was built!\n");

        $this->makeDirectory($actionFilePath);
        $this->makeDirectory($adapterFilePath);
        $this->makeDirectory($inputFilePath);
        $this->makeDirectory($handlerFilePath);
        if (! $isCommand) $this->makeDirectory($resultFilePath);

        $this->info("3. Directories was checked!\n");

        $this->fileSystem->put($actionFilePath, $actionClass);
        $this->comment(' >>> File "' . $actionFilePath . '" was created');
        $this->fileSystem->put($adapterFilePath, $adapterClass);
        $this->comment(' >>> File "' . $adapterFilePath . '" was created');
        $this->fileSystem->put($inputFilePath, $inputClass);
        $this->comment(' >>> File "' . $inputFilePath . '" was created');
        $this->fileSystem->put($handlerFilePath, $handlerClass);
        $this->comment(' >>> File "' . $handlerFilePath . '" was created');

        if (! $isCommand) {
            $this->fileSystem->put($resultFilePath, $resultClass);
            $this->comment(' >>> File "' . $resultFilePath . '" was created');
        }

        $this->info("4. Files was created!\n");

        $this->composer->dumpAutoloads();

        $this->info("5. Composer autoloader files was regenerated!\n");
    }

    private function makeDirectory(string $path): void
    {
        if (!$this->fileSystem->isDirectory(dirname($path))) {
            $this->fileSystem->makeDirectory(dirname($path), 0755, true);

            $this->comment(' >>> Directory "'.dirname($path).'" was created');
        }
    }

    private function buildActionFilePath(string $action, ?string $grouping): string
    {
        $path = str_replace(
            ['{{action}}', '{{grouping}}'],
            [$action, $grouping],
            base_path() . '/presentation/Http/Actions{{grouping}}/{{action}}Action.php'
        );

        if ($this->fileSystem->exists($path)) {
            throw new FileExistsException($path);
        }

        return $path;
    }

    private function buildActionClass(string $action, ?string $grouping, bool $isCommand): string
    {
        $replacements = [
            '{{action}}'   => $action,
            '{{grouping}}' => $grouping ? str_replace('/', "\\", $grouping) : null,
        ];

        $stub = $isCommand ?
            resource_path('/stubs/ActionForCommand.stub') :
            resource_path('/stubs/ActionForQuery.stub');

        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            file_get_contents($stub)
        );
    }

    private function buildAdapterFilePath(string $action, ?string $grouping): string
    {
        $path = str_replace(
            ['{{action}}', '{{grouping}}'],
            [$action, $grouping],
            base_path() . '/presentation/Http/Adapters{{grouping}}/{{action}}Adapter.php'
        );

        if ($this->fileSystem->exists($path)) {
            throw new FileExistsException($path);
        }

        return $path;
    }

    private function buildAdapterClass(string $action, ?string $grouping, bool $isCommand): string
    {
        $replacements = [
            '{{action}}'   => $action,
            '{{grouping}}' => $grouping ? str_replace('/', "\\", $grouping) : null,
        ];

        $stub = $isCommand ?
            resource_path('/stubs/CommandHttpAdapter.stub') :
            resource_path('/stubs/QueryHttpAdapter.stub');

        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            file_get_contents($stub)
        );
    }

    private function buildInputFilePath(string $action, ?string $grouping, bool $isCommand): string
    {
        $pathToReplace = $isCommand ?
            base_path() . '/application/Commands/Command{{grouping}}/{{action}}Command.php' :
            base_path() . '/application/Queries/Query{{grouping}}/{{action}}Query.php';

        $path = str_replace(
            ['{{action}}', '{{grouping}}'],
            [$action, $grouping],
            $pathToReplace
        );

        if ($this->fileSystem->exists($path)) {
            throw new FileExistsException($path);
        }

        return $path;
    }

    private function buildInputClass(
        string $action,
        ?string $grouping,
        ?string $attributes,
        bool $isCommand
    ): string {
        $attributes = $attributes ? explode(',', trim($attributes)) : [];

        $classAttributes = '';

        $constructorParameters = '';
        $constructorAssignment = '';

        $getMethods = '';

        foreach ($attributes as $index => $attribute) {
            list($name, $type) = explode('-', trim($attribute));

            $classAttributes .= '    private ' . $type . ' $' . $name .
                ($this->isNullable($type) ? ' = null' : '') . ";\n";

            $constructorParameters .= '        ' . $type . ' $' . $name .
                ($this->isNullable($type) ? ' = null' : '') .
                ($this->isLastElement($index, $attributes) ? '' : ",\n");
            $constructorAssignment .= '        $this->' . $name . ' = $' . $name .
                ($this->isLastElement($index, $attributes) ? ';' : ";\n");

            $getMethods .= ($this->isFirstElement($index) ? "\n" : "\n\n");
            $getMethods .= '    public function get' . ucfirst($name) . '(): ' . $type . "\n";
            $getMethods .= '    {' . "\n";
            $getMethods .= '        return $this->' . $name . ";\n";
            $getMethods .= '    }';
        }

        $replacements = [
            '{{action}}'   => $action,
            '{{grouping}}' => $grouping ? str_replace('/', "\\", $grouping) : null,
            '{{class_attributes}}' => $classAttributes,
            '{{constructor_parameters}}'  => $constructorParameters,
            '{{constructor_assignments}}' => $constructorAssignment,
            '{{get_methods}}' => $getMethods,
        ];

        $stub = $isCommand ?
            resource_path('/stubs/Command.stub') :
            resource_path('/stubs/Query.stub');

        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            file_get_contents($stub)
        );
    }

    private function buildHandlerFilePath(
        string $action,
        ?string $grouping,
        bool $isCommand
    ): string {
        $pathToReplace = $isCommand ?
            base_path() . '/application/Commands/Handler{{grouping}}/{{action}}Handler.php' :
            base_path() . '/application/Queries/Handler{{grouping}}/{{action}}Handler.php';

        $path = str_replace(
            ['{{action}}', '{{grouping}}'],
            [$action, $grouping],
            $pathToReplace
        );

        if ($this->fileSystem->exists($path)) {
            throw new FileExistsException($path);
        }

        return $path;
    }

    private function buildHandlerClass(
        string $action,
        ?string $grouping,
        bool $isCommand
    ): string {
        $replacements = [
            '{{action}}'   => $action,
            '{{grouping}}' => $grouping ? str_replace('/', "\\", $grouping) : null,
        ];

        $stub = $isCommand ?
            resource_path('/stubs/CommandHandler.stub') :
            resource_path('/stubs/QueryHandler.stub');

        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            file_get_contents($stub)
        );
    }

    private function buildResultFilePath(string $action, ?string $grouping): string
    {
        $path = str_replace(
            ['{{action}}', '{{grouping}}'],
            [$action, $grouping],
            base_path() . '/application/Queries/Result{{grouping}}/{{action}}Result.php'
        );

        if ($this->fileSystem->exists($path)) {
            throw new FileExistsException($path);
        }

        return $path;
    }

    private function buildResultClass(string $action, ?string $grouping): string
    {
        $replacements = [
            '{{action}}'   => $action,
            '{{grouping}}' => $grouping ? str_replace('/', "\\", $grouping) : null,
        ];

        return str_replace(
            array_keys($replacements),
            array_values($replacements),
            file_get_contents(resource_path('/stubs/QueryResult.stub'))
        );
    }

    private function isNullable(string $type): bool
    {
        return (strpos($type, '?') !== false);
    }

    private function isFirstElement(int $index): bool
    {
        return ($index === 0);
    }

    private function isLastElement(int $index, array $elements): bool
    {
        return ((count($elements) - 1) === $index);
    }
}
