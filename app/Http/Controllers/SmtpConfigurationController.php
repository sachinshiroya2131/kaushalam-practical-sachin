<?php

namespace App\Http\Controllers;

use App\Mail\SendMessage;
use App\Models\SmtpConfiguration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Expectation;

class SmtpConfigurationController extends Controller
{
    public function save_configuration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required|min:2',
            'smtp_driver' => 'required|min:2',
            'smtp_host' => 'required|min:2',
            'smtp_port' => 'required|integer|min:2',
            'user_name' => 'required|min:2',
            'password' => 'required|min:2',
            'from_name' => 'required|min:2',
            'smtp_encryption' => 'required',
            'from_email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
            //return redirect()->back()->with(Input::all());
        }

        $SmtpConfiguration = SmtpConfiguration::first();
        if (!$SmtpConfiguration) {
            $SmtpConfiguration = new SmtpConfiguration();
        }

        $SmtpConfiguration->site_name = $request->site_name;
        $SmtpConfiguration->smtp_driver = $request->smtp_driver;
        $SmtpConfiguration->smtp_host = $request->smtp_host;
        $SmtpConfiguration->smtp_port = $request->smtp_port;
        $SmtpConfiguration->user_name = $request->user_name;
        $SmtpConfiguration->password = $request->password;
        $SmtpConfiguration->from_name = $request->from_name;
        $SmtpConfiguration->smtp_encryption = $request->smtp_encryption;
        $SmtpConfiguration->from_email = $request->from_email;
        $SmtpConfiguration->save();

        return redirect()->back()->with('message', 'Configuration save successfully');
    }
    public function smtp()
    {
        $SmtpConfiguration = SmtpConfiguration::first();
        return view('welcome', compact('SmtpConfiguration'));
    }

    public function sendEmailFrom()
    {
        $SmtpConfiguration = SmtpConfiguration::first();
        return view('mailform', compact('SmtpConfiguration'));
    }

    public function send_email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'to_mail' => 'required|email',
            'subject' => 'required|min:2',
            'content' => 'required|min:2',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        }

        $SmtpConfiguration = SmtpConfiguration::first();
        if (!$SmtpConfiguration) {
            return redirect()->back()->with('error_message', 'Please configure SMTP first')->withInput($request->input());
        }


        try {
            config(['mail.default' => $SmtpConfiguration->smtp_driver]);
            config(['mail.mailers.smtp.host' => $SmtpConfiguration->smtp_host]);
            config(['mail.mailers.smtp.port' => $SmtpConfiguration->smtp_port]);
            config(['mail.mailers.smtp.encryption' => $SmtpConfiguration->smtp_encryption]);
            config(['mail.mailers.smtp.username' => $SmtpConfiguration->user_name]);
            config(['mail.mailers.smtp.password' => $SmtpConfiguration->password]);
            config(['mail.from.address' => $SmtpConfiguration->from_email]);
            config(['mail.from.name' => $SmtpConfiguration->from_name]);


            $dataemail['from_email'] = $SmtpConfiguration->from_email;
            $dataemail['content'] = $request->content;
            $dataemail['subject'] = $request->subject;

            \Mail::to('sachinpatel2131@gmail.com')->send(new SendMessage($dataemail));

            return redirect()->back()->with('message', 'Send Message Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage())->withInput($request->input());
        }
    }
}
