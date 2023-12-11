<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Email\EditRequest;
use App\Http\Requests\Email\StoreRequest;
use App\Models\Email;
use App\Models\User;
use App\Repositories\EmailRepository;
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
            $data = $this->emailRepository->find(auth()->user()->id);
        }else{
            $data = $this->emailRepository->all();
        }
        return view('admin.emails.index', [
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
