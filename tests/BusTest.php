<?php

namespace Domain\Tests
{

    use Domain\Bus\CommandBus;
    use Domain\Handler\HandlersMap;
    use Domain\Handler\Method\MessageNameResolver;
    use Domain\Handler\SimpleResolver;
    use Domain\Message\MessageClassResolver;
    use Domain\Middleware;

    use Domain\Tests\Fixtures\Commands\AddTask;

    use Mockery;
    use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

    use PHPUnit\Framework\TestCase;

    class BusTest extends TestCase
    {

        use MockeryPHPUnitIntegration;



        public function testMiddlewares()
        {
            $executionOrder = [];
            $middleware1 = Mockery::mock('Domain\Middleware');
            $middleware1->shouldReceive('execute')->andReturnUsing(
                function ($command, $next) use (&$executionOrder) {
                    $executionOrder[] = 1;
                    return $next($command);
                }
            );
            $middleware2 = Mockery::mock('Domain\Middleware');
            $middleware2->shouldReceive('execute')->andReturnUsing(
                function ($command, $next) use (&$executionOrder) {
                    $executionOrder[] = 2;
                    return $next($command);
                }
            );
            $middleware3 = Mockery::mock('Domain\Middleware');
            $middleware3->shouldReceive('execute')->andReturnUsing(
                function () use (&$executionOrder) {
                    $executionOrder[] = 3;
                    return 'foobar';
                }
            );

            $commandBus = $this->makeCommandBus([$middleware1, $middleware2, $middleware3]);

            $this->assertEquals('foobar', $commandBus->execute(new AddTask()));
            $this->assertEquals([1, 2, 3], $executionOrder);
        }

        public function testSingleMiddlewareWorks()
        {
            $middleware = Mockery::mock('Domain\Middleware');
            $middleware->shouldReceive('execute')->once()->andReturn('foobar');
            $commandBus = $this->makeCommandBus([$middleware]);
            $this->assertEquals(
                'foobar',
                $commandBus->execute(new AddTask())
            );
        }

        private function makeCommandBus(array $middlewares)
        {
            return new CommandBus(
                new HandlersMap(),
                new MessageClassResolver(),
                new SimpleResolver(),
                new MessageNameResolver(),
                $middlewares
            );
        }
    }

}