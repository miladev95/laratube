<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\NewVideoUploaded;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyAdminUsersForNewVideoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private User $user)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $adminRole = 'admin';
        $adminUsers = User::whereHas('roles', function ($query) use ($adminRole){
            $query->where('name',$adminRole);
        })->get();

        foreach ($adminUsers as $adminUser)
        {
            if($adminUser->roles()->where('name',$adminRole)->exists()) {
                $adminUser->notify(new NewVideoUploaded($this->user));
            }
        }
    }
}
