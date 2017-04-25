<?php

namespace Domain\Tests
{

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
            $middleware1 = Mockery::mock(Middleware::class);
            $middleware1->shouldReceive('execute')->andReturnUsing(
                function ($command, $next) use (&$executionOrder) {
                    $executionOrder[] = 1;
                    return $next($command);
                }
            );
            $middleware2 = Mockery::mock(Middleware::class);
            $middleware2->shouldReceive('execute')->andReturnUsing(
                function ($command, $next) use (&$executionOrder) {
                    $executionOrder[] = 2;
                    return $next($command);
                }
            );
            $middleware3 = Mockery::mock(Middleware::class);
            $middleware3->shouldReceive('execute')->andReturnUsing(
                function () use (&$executionOrder) {
                    $executionOrder[] = 3;
                    return 'foobar';
                }
            );
            $commandBus = new CommandBus([$middleware1, $middleware2, $middleware3]);
            $this->assertEquals('foobar', $commandBus->execute(new AddTask()));
            $this->assertEquals([1, 2, 3], $executionOrder);
        }

        public function testSingleMiddlewareWorks()
        {
            $middleware = Mockery::mock(Middleware::class);
            $middleware->shouldReceive('execute')->once()->andReturn('foobar');
            $commandBus = new CommandBus([$middleware]);
            $this->assertEquals(
                'foobar',
                $commandBus->execute(new AddTask())
            );
        }
    }

}