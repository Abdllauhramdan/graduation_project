<?php


namespace App\Http\Traits;

use App\Mail\SendMedicineExpirationMail;
use Illuminate\Support\Facades\Mail;

trait MedicineNotificationTrait
{
    public function sendNotificationAndEmailBeforeExpiration($medicineName, $expirationDate)
    {
        // احتساب تاريخ انتهاء الصلاحية قبل 15 يومًا
        $notificationDate = date('Y-m-d', strtotime('-15 days', strtotime($expirationDate)));
        $today = date('Y-m-d');

        if ($today >= $notificationDate) {
            // إرسال الإشعار
            $title = "Medicine Expiration Alert";
            $body = "The medicine '$medicineName' will expire in 15 days.";
            $this->sendNotification($title, $body);

            // إرسال بريد إلكتروني
            $email = "example@example.com"; // تعيين البريد الإلكتروني الذي يجب إرسال الإشعار إليه
            $url = "https://example.com/login"; // تعيين الرابط الذي يتم من خلاله تسجيل الدخول
            Mail::to($email)->send(new SendMedicineExpirationMail($medicineName, $expirationDate, $url));
        }
    }

    public function sendNotification($title, $body)
    {
        // قم بإرسال الإشعار هنا باستخدام الوظائف المناسبة مثل Firebase Cloud Messaging (FCM) أو غيرها
    }
}
