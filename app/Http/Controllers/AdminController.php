<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

class AdminController extends Controller
{

    public function saveAdmin(Request $request)
    {
        $admin = User::all()->first();

        $email = $request->email;
        $username = $request->username;
        $password = $request->password;

        if ($email != null) {
            $admin->update([
                'email' => $email,
            ]);
        }

        if ($username != null) {
            $admin->update([
                'username' => $username,
            ]);
        }

        if ($password != null && strlen($password) > 8) {
            $admin->update([
                'password' => Hash::make($password),
            ]);
        }

        return response()->json($admin);
    }

    public function getAdmin()
    {
        $admin = User::all()->first();

        return response()->json($admin);
    }

    public function getEmailToken()
    {
        // Cookie::queue('emailToken', Str::random(16), 5);
        $cookie = cookie('emailToken', Str::random(), 5, null, null, null, false);
        $response = new Response();
        $response->withCookie($cookie);
        return $response;
    }

    public function sendEmail(Request $request)
    {

        $emailToken = Cookie::get('emailToken');

        if (!isset($emailToken) || $emailToken == null) {
            return response()->json(['status' => 'false']);
        }

        if ($request->cookie('emailToken') == null || $request->cookie('emailToken') != $emailToken) {
            return response()->json(['status' => 'false']);
        }

        $name = $request->input('name');
        $phone = $request->input('phone');
        $clock = $request->input('clock');
        // $description = $request->input('description');
        $datetime = $request->input('datetime');
        // $images = $request->input('images');

        if (!isset($name) && !isset($clock) && !isset($phone) && !isset($datetime)) {
            return response()->json(['status' => 'false']);
        }


        $mail = new PHPMailer(true);

        $mail->isSMTP();

        // Enable SMTP authentication
        $mail->Host       = 'smtp.yandex.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'public@kdpost.ru';                     //SMTP username
        $mail->Password   = 'Globalpro2023';                               //SMTP password
        $mail->SMTPSecure = 'ssl';         
        $mail->Port       = 465;
        $mail->setFrom('public@kdpost.ru', 'Your Name');
        // $mail->addAddress('public@kdpost.ru', 'Новая Заявка');
        $mail->addAddress('nurlitan.berikbol@yandex.ru', 'Новая Заявка');
        $mail->Subject = 'Новая Заявка';
        $mail->Body = "На сайте была оставлена заявка через форму. \r\n Данные заявки: \r\n Имя: {$name} \r\n Телефон: {$phone} \r\n Удобное время: {$clock} \r\n Было отправлено: {$datetime}";
        $mail->SMTPDebug = true;
        $mail->Debugoutput = function ($str, $level) {
            // echo "$level: $str\n";
        };
        try {
            $mail->send();
            Cookie::queue(Cookie::forget('emailToken'));
            return response()->json(['status' => 'true']);
            // echo 'Email sent successfully!';
        } catch (Exception $e) {
            return response()->json(['status' => 'false','message' => $e->getMessage()]);
            return response()->json(['status' => 'false']);
            // echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        }
        exit;
    }
}
