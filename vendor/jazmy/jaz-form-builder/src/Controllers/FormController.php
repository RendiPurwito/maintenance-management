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
use PDF;
use Illuminate\Http\Request;
use jazmy\FormBuilder\Helper;
use Illuminate\Support\Facades\DB;
use jazmy\FormBuilder\Models\Form;
use App\Http\Controllers\Controller;
use App\Notifications\NewFormNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DeleteFormNotification;
use App\Notifications\UpdateFormNotification;
use jazmy\FormBuilder\Events\Form\FormCreated;
use jazmy\FormBuilder\Events\Form\FormDeleted;
use jazmy\FormBuilder\Events\Form\FormUpdated;
use jazmy\FormBuilder\Requests\SaveFormRequest;


class FormController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = "Forms";

        $forms = Form::getForUser(auth()->user());
        if($request->has('view_deleted'))
        {
            $forms = Form::onlyTrashed()->get();
        }
        // $submissions_count = Submission::

        return view('admin.forms.index', compact('pageTitle', 'forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create New Form";

        $saveURL = route('formbuilder::forms.store');

        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = Helper::getConfiguredRoles();

        return view('admin.forms.create', compact('pageTitle', 'saveURL', 'form_roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  jazmy\FormBuilder\Requests\SaveFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFormRequest $request)
    {
        $user = $request->user();

        $input = $request->merge(['user_id' => $user->id])->except('_token');
        // $creation = Form::first();
        
        DB::beginTransaction();
        
        // generate a random identifier
        $input['identifier'] = $user->id.'-'.Helper::randomString(20);
        $form = Form::create($input);
        
        try {
            // dispatch the event
            event(new FormCreated($form));
            // Notification::send($admins, new NewFormNotification($created));
            $notification = User::where('role', 'admin')->get();
            $notification->each->notify(new NewFormNotification($form));
            // $creation->notify(new NewFormNotification($created));
            DB::commit();

            return response()
                    ->json([
                        'success' => true,
                        'details' => 'Form successfully created!',
                        'dest' => route('formbuilder::forms.index'),
                    ]);
        } catch (Throwable $e) {
            info($e);

            DB::rollback();

            return response()->json(['success' => false, 'details' => 'Failed to create the form.']);
        }
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
        $form = Form::where('id', $id)->with('user')
                    ->withCount('submissions')
                    ->firstOrFail();

        $pageTitle = "Preview Form";

        return view('admin.forms.show', compact('pageTitle', 'form'));
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

        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();

        $pageTitle = 'Edit Form';

        $saveURL = route('formbuilder::forms.update', $form);

        // get the roles to use to populate the make the 'Access' section of the form builder work
        $form_roles = Helper::getConfiguredRoles();

        return view('admin.forms.edit', compact('form', 'pageTitle', 'saveURL', 'form_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  jazmy\FormBuilder\Requests\SaveFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFormRequest $request, $id){
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();
        
        $input = $request->except('_token');
        
        if ($form->update($input)) {
            // dispatch the event
            event(new FormUpdated($form));
            $notification = User::where('role', 'admin')->get();
            $notification->each->notify(new UpdateFormNotification($form));

            return response()
                    ->json([
                        'success' => true,
                        'details' => 'Form successfully updated!',
                        'dest' => route('formbuilder::forms.index'),
                    ]);
        } else {
            response()->json(['success' => false, 'details' => 'Failed to update the form.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $user = auth()->user();
        $form = Form::where(['user_id' => $user->id, 'id' => $id])->firstOrFail();
        $form->delete();
        
        // dispatch the event
        event(new FormDeleted($form));
        $notification = User::where('role', 'admin')->get();
        $notification->each->notify(new DeleteFormNotification($form));

        return back()->with('success', "'{$form->name}' deleted.");
    }

    public function formList(){
        $forms = Form::all();
        return view('user.dashboard', [
            'forms' => $forms
        ]);
    }

    public function pdf($identifier){
        $form = Form::where('identifier', $identifier)->firstOrFail();
        return view('admin.forms.form-pdf', compact('form'));
    }
}
