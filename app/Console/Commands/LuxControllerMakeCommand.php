<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class LuxControllerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller and view';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */

    public function handle()
    {
        parent::handle();

        $name = $this->qualifyClass($this->getNameInput());

        $path = $this->getResourcePath($name);

        $this->makeDirectory($path . '/index.blade.php');

        if ($this->files->exists($path . '/index.blade.php')) {
            $this->error('View [index] already exists!');
        } else {
            $this->files->put($path . '/index.blade.php' , $this->buildView($name, __DIR__ . '/stubs/views.index.stub'));
            $this->info('Views [index] created successfully.');
        }
        if ($this->files->exists($path . '/show.blade.php')) {
            $this->error('View [show] already exists!');
        } else {
            $this->files->put($path . '/show.blade.php' , $this->buildView($name, __DIR__ . '/stubs/views.show.stub'));
            $this->info('Views [show] created successfully.');
        }
        if ($this->files->exists($path . '/form.blade.php')) {
            $this->error('View [form] already exists!');
        } else {
            $this->files->put($path . '/form.blade.php' , $this->buildView($name, __DIR__ . '/stubs/views.form.stub'));
            $this->info('Views [form] created successfully.');
        }
        
    }

    protected function getResourcePath($name)
    {
        $dir_name =  $this->namespaceSnakeCase();
        return $this->laravel['path.resources'] . "/views/" . $dir_name;
    }

    protected function namespaceSnakeCase($separator = '/')
    {
        $modelClass = $this->parseModel($this->option('model'));
        $paths = explode("/", $this->getNameInput());
        array_pop($paths);
        $resourcePath = "";
        foreach($paths as $path) {
            $resourcePath .= Str::snake($path) . $separator;
        }
        
        $resourcePath .= Str::plural(Str::snake(class_basename($modelClass)));
        return $resourcePath;
    }

    protected function getControllerNamespace()
    {
        $paths = explode("/", $this->getNameInput());
        array_pop($paths);
        return implode('/', $paths);
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildView($name, $stub)
    {
        $stub = $this->files->get($stub);

        $replace = [];
        $replace = $this->buildViewReplacements($replace);

        return str_replace(
            array_keys($replace), array_values($replace), $stub
        );
    }

    protected function buildViewReplacements($replace) {
        $modelClass = $this->parseModel($this->option('model'));

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            'DummyModelVariables' => Str::plural(Str::snake(class_basename($modelClass))),
            'DummyModelVariable' => Str::snake(class_basename($modelClass)),
            'DummyModelHumanizes' => Str::plural($this->HumanizeCamel(class_basename($modelClass))),
            'DummyModelHumanize' => $this->HumanizeCamel(class_basename($modelClass)),
            'DummyViewNamespace' => $this->namespaceSnakeCase('.'),
            'DummyControllerNamespaceSnake' => Str::snake($this->getControllerNamespace()),
            'DummyControllerNamespace' => $this->getControllerNamespace(),
        ]);
    }

    
    protected function getStub()
    {
        $stub = null;

        if ($this->option('parent')) {
            $stub = '/stubs/controller.nested.stub';
        } elseif ($this->option('model')) {
            $stub = '/stubs/controller.model.stub';
        } elseif ($this->option('resource')) {
            $stub = '/stubs/controller.stub';
        }

        if ($this->option('api') && is_null($stub)) {
            $stub = '/stubs/controller.api.stub';
        } elseif ($this->option('api') && ! is_null($stub)) {
            $stub = str_replace('.stub', '.api.stub', $stub);
        }

        $stub = $stub ? : '/stubs/controller.plain.stub';

        return __DIR__.$stub;
        
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers';
    }

    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = $this->getNamespace($name);

        $replace = [];

        if ($this->option('parent')) {
            $replace = $this->buildParentReplacements();
        }

        if ($this->option('model')) {
            $replace = $this->buildModelReplacements($replace);
        }

        $replace["use {$controllerNamespace}\Controller;\n"] = '';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    /**
     * Build the replacements for a parent controller.
     *
     * @return array
     */
    protected function buildParentReplacements()
    {
        $parentModelClass = $this->parseModel($this->option('parent'));

        if (! class_exists($parentModelClass)) {
            if ($this->confirm("A {$parentModelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $parentModelClass]);
            }
        }

        return [
            'ParentDummyFullModelClass' => $parentModelClass,
            'ParentDummyModelClass' => class_basename($parentModelClass),
            'ParentDummyModelVariable' => Str::snake(class_basename($parentModelClass)),
            'ParentDummyModelVariables' => Str::plural(Str::snake(class_basename($parentModelClass))),
        ];
    }

    /**
     * Build the model replacement values.
     *
     * @param  array  $replace
     * @return array
     */
    protected function buildModelReplacements(array $replace)
    {
        $modelClass = $this->parseModel($this->option('model'));

        if (! class_exists($modelClass)) {
            if ($this->confirm("A {$modelClass} model does not exist. Do you want to generate it?", true)) {
                $this->call('make:model', ['name' => $modelClass]);
            }
        }

        return array_merge($replace, [
            'DummyFullModelClass' => $modelClass,
            'DummyModelClass' => class_basename($modelClass),
            'DummyModelVariables' => Str::plural(Str::snake(class_basename($modelClass))),
            'DummyModelVariable' => Str::snake(class_basename($modelClass)),
            'DummyModelHumanizes' => Str::plural($this->HumanizeCamel(class_basename($modelClass))),
            'DummyModelHumanize' => $this->HumanizeCamel(class_basename($modelClass)),
            'DummyViewNamespace' => $this->namespaceSnakeCase('.'),
            'DummyControllerNamespaceSnake' => Str::snake($this->getControllerNamespace()),
            'DummyControllerNamespace' => $this->getControllerNamespace(),
        ]);
    }

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');
        if (! Str::startsWith($model, $rootNamespace = $this->getDefaultModelNamespace($this->laravel->getNamespace()))) {
            $model = $rootNamespace.$model;
        }

        return $model;
    }

    protected function getDefaultModelNamespace($rootNamespace)
    {
        return "{$rootNamespace}Models\\";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'Generate a resource controller for the given model.'],

            ['resource', 'r', InputOption::VALUE_NONE, 'Generate a resource controller class.'],

            ['parent', 'p', InputOption::VALUE_OPTIONAL, 'Generate a nested resource controller class.'],

            ['api', null, InputOption::VALUE_NONE, 'Exclude the create and edit methods from the controller.'],
        ];
    }

    private function HumanizeCamel($input)
    {
        return preg_replace(array('/(?<=[^A-Z])([A-Z])/', '/(?<=[^0-9])([0-9])/'), ' $0', $input);
    }
}
