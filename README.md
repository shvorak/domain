# Domain

PHP library for managing domain logic

# Why?

- Why CommandBus and QueryBus throws exception if handler for message not found?

    - If you execute message and handler not found it's not good. But you can handle this case in your middlewares
    
# CommandBus Example

Create CommandBus

```php
<?php require_once __DIR__ . '/../vendor/autoload.php';

$commandBus = \Domain\Bus\CommandBusBuilder::make()
    // Let's define method name resolver.
    // In this case CreateTodo command will handled with handleCreateTodo() method 
    ->usingHandlerMethodResolver(new \Domain\Handler\Method\NamedMethodResolver())
    
    // Let's define handler class resolver (see below)
    // In this case we use PHP-DI with autowiring for creating our handler
    ->usingHandlerResolver(new \Domain\Handler\ContainerResolver($container))
    
    // Register command handlers via providers (see below)
    ->register(new TodoCommandsHandlerProvider())
    
    // Finally build our CommandBus
    ->build()
;

```

Create your first command message 

```php
<?php

class CreateTodo
{

    protected $subject;
    
    public function getSubject() : string 
    {
        return $this->subject;
    }
    
    public function setSubject(string $subject)
    {
        $this->subject = $subject;    
    }
    
}

```

Additionally you can implement some interfaces in messages and handle this contracts in custom middlewares.

For example in my case i have:
 - StoryInterface for mark some messages like one history line
 - PersistentInterface for automatically save message with payload in event store


Example of command handler

```php
<?php

class TodoCommandsHandler
{
    
    private $table;
    
    private $eventBus;
    
    public function __construct(TodoGateway $table, EventBusInterface $eventBus) 
    {
        $this->table = $table;
        $this->eventBus = $eventBus;
    }
    
    public function handleCreateTodo(CreateTodo $command)
    {
        $todo = new Todo();
        $todo->setSubject($command->getSubject());
        $todo->setCompleted(false);
        
        try {
            // Save todo
            $this->table->create($todo);
            
            // Emit successful event
            $this->eventBus->emit(new TodoCreated($todo));
            
        } catch (DatabaseException $exception) {
            // TODO : Write error log
            throw $exception;
        }
        
        // Yes, you can return newly created todo
        return $todo;
    }
    
}
```

Create command handler provider and register previously created handler for Todo commands

```php
<?php


class TodoCommandsHandlerProvider implements \Domain\Handler\HandlersProvider
{
    
    public function register(\Domain\Handler\HandlersMap $handlers)
    {
        // Tell handler class name which contains method to handle this command
        $handlers->handle(CreateTodo::class, TodoCommandsHandler::class);    
    }
    
}

```
