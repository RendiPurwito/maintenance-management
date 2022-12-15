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
use Illuminate\Http\Request;
use jazmy\FormBuilder\Helper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use jazmy\FormBuilder\Models\Submission;
use App\Notifications\UpdateSubmissionNotification;
use Illuminate\Support\Str;

class MySubmissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // only allow submission edit on forms that allow it
        $this->middleware('submisson-editable')->only(['edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $submissions = Submission::getForUser($user);

        $pageTitle = "My Submissions";

        return view('user.my_submissions.index', compact('submissions', 'pageTitle'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $submission = Submission::where(['user_id' => $user->id, 'id' => $id])
                            ->with('form')
                            ->firstOrFail();

        $form_headers = $submission->form->getEntriesHeader();

        $pageTitle = "View Submission";

        return view('user.my_submissions.show', compact('submission', 'pageTitle', 'form_headers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        $submission = Submission::where(['user_id' => $user->id, 'id' => $id])
                            ->with('form')
                            ->firstOrFail();

        // load up my current submissions into the form json data so that the
        // form is pre-filled with the previous submission we are trying to edit.
        $submission->loadSubmissionIntoFormJson();

        $pageTitle = "Edit My Submission for '{$submission->form->name}'";

        return view('user.my_submissions.edit', compact('submission', 'pageTitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $submission = Submission::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();
        $notification = User::first();

        DB::beginTransaction();

        try {
            $input = $request->except(['_token', '_method']);

            // check if files were uploaded and process them
            $uploadedFiles = $request->allFiles();
            foreach ($uploadedFiles as $key => $file) {
                // store the file and set it's path to the value of the key holding it
                if ($file->isValid()) {
                    $input[$key] = $file->store('fb_uploads', 'public');
                }
            }

            $submission->update(['content' => $input]);
            $notification->notify(new UpdateSubmissionNotification($submission));
            DB::commit();

            return redirect()
                        ->route('formbuilder::my-submissions.index')
                        ->with('success', 'Submission updated.');
        } catch (Throwable $e) {
            info($e);

            DB::rollback();

            return back()->withInput()->with('error', Helper::wtf());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $submission = Submission::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();
        $submission->delete();

        return redirect()
                    ->route('formbuilder::my-submissions.index')
                    ->with('success', 'Submission deleted!');
    }
}
