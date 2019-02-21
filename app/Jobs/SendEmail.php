<?php

namespace App\Jobs;

use App\AdminUser;
use App\Mail\ResetPwd;
use Illuminate\Support\Facades\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    public $tries = 5;  //任务可以尝试的最大次数
    public $timeout = 60; //超时时间，优先级高于命令行

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AdminUser $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user=$this->user;
        $adminUserEmial = config('constants.ADMIN_EMAIL');
//        Mail::to('luozhiqun@welltrend.com.cn')->cc('lixiaowang@welltrend.com.cn')->send(new ResetPwd($user));
        Mail::to($user->email)->cc($adminUserEmial)->send(new ResetPwd($user));
    }

    /**
     * 执行失败的任务。
     *
     * @param  Exception $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        // 给用户发送失败的通知等等...
        dd('failed sendEmail');
    }
}
