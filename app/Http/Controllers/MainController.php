<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questions;
use App\Partners;
use App\Conditions;
use Validator;
use Mail;

/**
 * Class MainController
 * @package App\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $questions = Questions::where('active', 1)->get();
        $partners = Partners::where('active', 1)->get();
        $conditions = Conditions::where('active', 1)->get();

        return view('lp', compact('questions', 'partners', 'conditions'));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function sendData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return json_encode(['error' => $validator->errors()->keys()]);
        } else {

            $form = $request->all();
            $email = $request->get('email');
            $to = array('info@topcredit.md', settings()->getOption('support::email'));
            $send = Mail::send('email.form', compact('form'), function ($message) use ($to, $form, $email) {
                $message->to($to, sprintf('%s', $email))->subject("Topcredit Message");
            });

            return json_encode(['succes' => 'Uraa']);
        }
    }

}