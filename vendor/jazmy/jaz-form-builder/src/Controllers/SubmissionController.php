<?php
/*--------------------
https://github.com/jazmy/laravelformbuilder
Licensed under the GNU General Public License v3.0
Author: Jasmine Robinson (jazmy.com)
Last Updated: 12/29/2018
----------------------*/
namespace jazmy\FormBuilder\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use jazmy\FormBuilder\Helper;
use jazmy\FormBuilder\Models\Form;
use App\Http\Controllers\Controller;
use jazmy\FormBuilder\Models\Submission;
use App\Notifications\DeleteSubmissionNotification;

class SubmissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param integer $form_id
     * @return \Illuminate\Http\Response
     */
    public function index($form_id, Request $request)
    {
        $user = auth()->user();

        $form = Form::where(['user_id' => $user->id, 'id' => $form_id])
                    ->with(['user'])
                    ->firstOrFail();

        $submissions = $form->submissions()
                            ->with('user')
                            ->latest()
                            ->get();

        if($request->has('view_deleted'))
        {
            $submissions = Submission::onlyTrashed()->get();
        }
        
        // get the header for the entries in the form
        $form_headers = $form->getEntriesHeader();

        $pageTitle = "{$form->name}";

        return view(
            'admin.submissions.index',
            compact('form', 'submissions', 'pageTitle', 'form_headers')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $form_id
     * @param integer $submission_id
     * @return \Illuminate\Http\Response
     */
    public function show($form_id, $submission_id)
    {
        $submission = Submission::with('user', 'form')->where([
                                'form_id' => $form_id,
                                'id' => $submission_id,
                            ])->firstOrFail();

        $form_headers = $submission->form->getEntriesHeader();

        $pageTitle = "View Submission";

        return view('admin.submissions.show', compact('pageTitle', 'submission', 'form_headers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $form_id
     * @param int $submission_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($form_id, $submission_id)
    {
        $submission = Submission::where(['form_id' => $form_id, 'id' => $submission_id])->firstOrFail();
        $notification = User::where('role', 'admin')->get();
        $submission->delete();
        $notification->each->notify(new DeleteSubmissionNotification($submission));

        return redirect()
                    ->route('formbuilder::forms.submissions.index', $form_id)
                    ->with('success', 'Submission successfully deleted.');
    }

    public function restore($id)
    {
        Submission::withTrashed()->find($id)->restore();

        return back()->with('success', 'Submission restored successfully');
    }  
    
    public function restore_all()
    {
        Submission::onlyTrashed()->restore();

        return back()->with('success', 'All Submission restored successfully');
    }

    public function pdf($id){
        $submission = Submission::where('id', $id)->firstOrFail();
        $form_headers = $submission->form->getEntriesHeader();
        return view('admin.submissions.pdf', compact('submission', 'form_headers'));
    }
}
