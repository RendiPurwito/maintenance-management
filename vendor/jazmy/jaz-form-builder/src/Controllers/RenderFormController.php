<?php
/*--------------------
https://github.com/jazmy/laravelformbuilder
Licensed under the GNU General Public License v3.0
Author: Jasmine Robinson (jazmy.com)
Last Updated: 12/29/2018
----------------------*/
namespace jazmy\FormBuilder\Controllers;

use Throwable;
use App\Models\User;
use App\Events\Submitted;
use Illuminate\Http\Request;
use jazmy\FormBuilder\Helper;
use Illuminate\Support\Facades\DB;
use jazmy\FormBuilder\Models\Form;
use App\Http\Controllers\Controller;
use jazmy\FormBuilder\Models\Submission;
use App\Notifications\NewSubmissionNotification;

class RenderFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('public-form-access');
    }

    /**
     * Render the form so a user can fill it
     *
     * @param string $identifier
     * @return Response
     */
    public function render($identifier)
    {
        $form = Form::where('identifier', $identifier)->firstOrFail();

        $pageTitle = "{$form->name}";

        return view('formbuilder::render.index', compact('form', 'pageTitle'));
    }

    /**
     * Process the form submission
     *
     * @param Request $request
     * @param string $identifier
     * @return Response
     */
    public function submit(Request $request, $identifier)
    {
        $form = Form::where('identifier', $identifier)->firstOrFail();

        DB::beginTransaction();
        // $submission = User::first();
        $notification = User::first();

        try {
            $input = $request->except('_token');

            // check if files were uploaded and process them
            $uploadedFiles = $request->allFiles();
            foreach ($uploadedFiles as $key => $file) {
                // store the file and set it's path to the value of the key holding it
                if ($file->isValid()) {
                    $input[$key] = $file->store('fb_uploads', 'public');
                }
            }

            $user_id = auth()->user()->id ?? null;

            $submitted = $form->submissions()->create([
                'user_id' => $user_id,
                'content' => $input,
            ]);

            // $submission->notify(new NewSubmissionNotification($submitted));
            $notification->notify(new NewSubmissionNotification($submitted));
            DB::commit();
            return redirect()->route('formbuilder::form.feedback', $identifier)->with('success', 'Form successfully submitted.');
        }catch (Throwable $e){
            info($e);

            DB::rollback();

            return back()->withInput()->with('error', Helper::wtf());
        }
    }

    /**
     * Display a feedback page
     *
     * @param string $identifier
     * @return Response
     */
    public function feedback($identifier)
    {
        $form = Form::where('identifier', $identifier)->firstOrFail();

        $pageTitle = "Form Submitted!";

        return view('formbuilder::render.feedback', compact('form', 'pageTitle'));
    }
}
