<?php

namespace Tests\Feature;

use App\Events\EventForLoggingFired;
use App\Post;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Mockery;

class PostTest extends TestCase
{

    public function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * A example feature test with event fired.
     *
     * @return void
     */
    public function testItWillFireEvent()
    {
        Event::fake();

        $post = Post::first();

        $response = $this->get('/posts/'.$post->id);
        $response->assertStatus(200);

        Event::assertDispatched(EventForLoggingFired::class);
    }
}
