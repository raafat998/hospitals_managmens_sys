<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserApprovedNotification extends Notification
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
                ->subject('حسابك قد تم تفعيله!') // عنوان البريد باللغة العربية
                ->greeting('مرحبًا ' . $this->user->name . ',') // التحية باللغة العربية
                ->line('يسعدنا أن نبلغك بأن حسابك قد تم تفعيله بنجاح.') // محتوى الرسالة باللغة العربية
                ->line('الآن يمكنك تسجيل الدخول إلى حسابك والوصول إلى ميزاتنا الرائعة.')
                ->action('تسجيل الدخول', route('login')) // زر تسجيل الدخول باللغة العربية
                ->line('إذا كان لديك أي أسئلة، فلا تتردد في الاتصال بنا.')
                ->line('---') // خط للفصل بين اللغتين
                ->line('Hello ' . $this->user->name . ',') // التحية باللغة الإنجليزية
                ->line('We are pleased to inform you that your account has been successfully activated.') // محتوى الرسالة باللغة الإنجليزية
                ->line('You can now log in to your account and access our great features.')
                ->action('Log In', route('login')) // زر تسجيل الدخول باللغة الإنجليزية
                ->line('If you have any questions, please do not hesitate to contact us.')
                ->salutation('أطيب التحيات، / Best Regards,') // توقيع ثنائي اللغة
                ->line('فريق الدعم لدينا / Your Support Team'); // توقيع ثنائي اللغة
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
