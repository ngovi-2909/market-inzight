<?php
namespace App\Repositories;

use App\Contracts\Repositories\EmailRepositoryInterface;
use App\Http\Requests\Email\EditRequest;
use App\Http\Requests\Email\StoreRequest;
use App\Models\Email;
use Illuminate\Support\Facades\DB;


class EmailRepository implements EmailRepositoryInterface{

    public function all()
    {
        // TODO: Implement all() method.
        return Email::paginate(15);
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        return Email::findOrFail($id)->paginate(15);
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
        return Email::destroy($id);
    }

    public function store($request, $id)
    {
        // TODO: Implement store() method.
        $email = new Email();
        $email->created_by = $id;
        $email->setIsActiveAttribute($request->get('is_active'));
        $email->fill($request->validated());
        $email->save();
    }

    public function update(EditRequest $request, $id)
    {
        $email = Email::findOrFail($id);
        $email->fill($request->validated());
        $email->setIsActiveAttribute($request->get('is_active'));
        $email->save();
    }

}
