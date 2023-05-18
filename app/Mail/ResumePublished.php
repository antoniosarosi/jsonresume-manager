<?php

namespace App\Mail;

use App\Models\Resume;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResumePublished extends Mailable
{
    use Queueable, SerializesModels;

    public $resume;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com', 'Example')
                    ->view('emails.resumes.published');
    }
}
