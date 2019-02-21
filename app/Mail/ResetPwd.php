<?php

namespace App\Mail;

use App\AdminUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPwd extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * 后台管理员实例
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(AdminUser $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $attachPath=public_path() . $this->user->avatar;
        return $this->view('admin.emails.resetPwd')
            ->attach($attachPath);
    }
}
