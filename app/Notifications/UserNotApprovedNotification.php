<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UserNotApprovedNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     * @param User $user
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('حسابك قد تم تعطيله! / Your Account Has Been Deactivated!') 
                    ->greeting('مرحبًا ' . $this->user->name) 
                    ->line('نأسف لإبلاغك بأن حسابك قد تم تعطيله.')
                    ->line('نرجو منك الاتصال بفريق الدعم إذا كنت بحاجة إلى مساعدة.') 
                    ->line('---------------') 
                    ->line('Hello ' . $this->user->name . ',') 
                    ->line('We regret to inform you that your account has been deactivated.') 
                    ->line('Please contact our support team if you need assistance.'); 
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
