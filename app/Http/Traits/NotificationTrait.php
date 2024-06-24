<?php

namespace App\Http\Traits;

use App\Models\User;

trait NotificationTrait
{
    public function sendNotification(String $title, String $body, array $data = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        // جلب جميع رموز الأجهزة المسجلة
        $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $serverKey = env('FIRE_BASE_SERVER_KEY'); // احرص على تعيين هذا المفتاح في ملف .env الخاص بك

        $notificationData = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ],
            "data" => $data // إضافة البيانات الإضافية إلى الإشعار
        ];

        $encodedData = json_encode($notificationData);

        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // تنفيذ الطلب
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // غلق الاتصال
        curl_close($ch);

        return $result; // إرجاع نتيجة FCM
    }
}
