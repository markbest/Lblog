<?php

namespace App\Listeners;

use App\Events\BlogView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class BlogViewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BlogView  $event
     * @return void
     */
    public function handle(BlogView $event)
    {
        $article = $event->article;
        $article->increment('views');
    }
}
