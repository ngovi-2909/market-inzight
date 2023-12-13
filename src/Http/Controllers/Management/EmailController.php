<?php

namespace MI\Crud\Http\Controllers\Management;

use MI\Crud\Http\Controllers\Controller;
use MI\Crud\Requests\Email\EditRequest;
use MI\Crud\Requests\Email\StoreRequest;
use MI\Crud\Models\Email;
use MI\Crud\Models\User;
use MI\Crud\Repositories\EmailRepository;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $emailRepository;
    public function __construct(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }
    public function index(){
        if(!auth()->user()->is_super_user){
            $data = $this->emailRepository->findByUserId(auth()->user()->id);
        }else{
            $data = $this->emailRepository->all();
        }
        return view('Crud::admin.emails.index', [
            'datas'=>$data,
        ]);
    }
    public function store(StoreRequest $request){
        $id = auth()->user()->id;
        $this->emailRepository->store($request, $id);
        return redirect(route('emails.index'));
    }

    public function update(EditRequest $request, $id){
        $this->emailRepository->update($request, $id);
        return redirect(route('emails.index'));
    }
    public function destroy($id){
        $this->emailRepository->destroy($id);
        return redirect(route('emails.index'));
    }


}
