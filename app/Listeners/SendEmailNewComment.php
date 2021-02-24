<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NewCommentEmail;
use Illuminate\Support\Facades\Mail;
use \Laravelista\Comments\Events\CommentCreated;

class SendEmailNewComment
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
     * @param  CommentCreated  $event
     * @return void
     */
    public function handle(CommentCreated $event)
    {
        Mail::to('eduardongua@hotmail.com')->send(new NewCommentEmail);
    }
}
