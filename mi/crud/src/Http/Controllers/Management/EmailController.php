<?php

namespace mi\crud\Http\Controllers\Management;

use mi\crud\Http\Controllers\Controller;
use mi\crud\Requests\Email\EditRequest;
use mi\crud\Requests\Email\StoreRequest;
use mi\crud\Models\Email;
use mi\crud\Repositories\EmailRepository;


class EmailController extends Controller
{
    protected $emailRepository;
    public function __construct(EmailRepository $emailRepository)
    {
        $this->emailRepository = $emailRepository;
        $this->middleware('auth');
    }
    public function index(){
        if(!auth()->user()->is_super_user){
            $data = $this->emailRepository->findByUserId(auth()->user()->id);
        }else{
            $data = $this->emailRepository->all();
        }
        return view('crud::admin.emails.index', [
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
