<?php

namespace App\Http\Controllers\Backend\adminAuth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ManagerAdmin;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordAdmin;
use App\User;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('admin.authAdmin.password.reset');
    }
    public function store(Request $request, User $user)
    {
        $email = $request->email;

        $admin = $user->where('email', $email)->first();

        if ($admin) {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]);

            $token = DB::table('password_resets')->where('email', $email)->orderByDesc('created_at')->first()->token;
            $expiration = Carbon::now()->addMinute(15);
            $link = URL::temporarySignedRoute('admin.showFormReset', $expiration, $token);
            if ($this->sendMail($email, $link)) {
                $mess_succ = 'Chúng tôi đã gửi link reset password đến email của bạn!';
                return view('admin.authAdmin.password.reset', ['mess_succ' => $mess_succ]);
            }
        } else {
            $mess_false = "Chúng tôi không tìm thấy địa chỉ email của bạn.";
            return view('admin.authAdmin.password.reset', ['mess_false' => $mess_false]);
        }
    }


    public function sendMail($email, $link)
    {
        // dd($email);
        $details = [
            'title' => 'Click Link bênh dưới để reset password.',
            'link' => $link
        ];
        Mail::to($email)
            ->send(new ResetPasswordAdmin($details));
        return true;
    }

    public function showFormReset($token)
    {
        $__token = substr($token, 0, 60);

        $email = DB::table('password_resets')->where('token', $__token)->first()->email;
        $data = [
            'token' => $token,
            'email' => $email
        ];
        return view('admin.authAdmin.password.confirm', $data);
    }

    public function storeFormReset(Request $request, User $user)
    {
        $email = $request->email;
        $token = $request->token;
        $validateData = $request->validate([
            'password' => 'required|min:8',
            'password_confirm' => 'required|same:password'
        ]);
        $password = $request->password;
        $admin = $user->where('email', $email)->first();

        $admin->password = bcrypt($password);
        $admin->save();

        return back()->with('status_succ', 'Password đã được reset');
    }
}