<?php
/**
 * Created by PhpStorm.
 * User: yaro
 * Date: 12.03.19
 * Time: 8:04
 */

namespace Tests\Feature;


use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class TrendingThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        Redis::del('trending_threads');
    }

    /**
     * @test
     */
    public function trending_thread()
    {
        $this->assertEmpty(Redis::zrevrange('trending_threads', 0 , -1));

        $thread = create(Thread::class);

        $this->call('GET',$thread->path());

        $this->assertCount(1 , Redis::zrevrange('trending_threads', 0 , -1));
    }
}