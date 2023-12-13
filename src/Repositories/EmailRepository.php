<?php
namespace MI\Crud\Repositories;

use MI\Crud\Contracts\Repositories\EmailRepositoryInterface;
use MI\Crud\Models\Email;
use MI\Crud\Requests\Email\EditRequest;


class EmailRepository implements EmailRepositoryInterface{

    public function all()
    {
        // TODO: Implement all() method.
        return Email::paginate(15);
    }

    public function find($id)
    {
        // TODO: Implement find() method.
        $email = Email::all();
        return $email->find($id);
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
        // TODO: Implement update() method.
        $email = $this->find($id);
        $email->setIsActiveAttribute($request->get('is_active'));
        $email->fill($request->validated());
        $email->save();
    }

    public function findByUserId($id)
    {
        // TODO: Implement findByUserId() method.
        return Email::where('created_by',$id)->paginate(15);
    }
}
