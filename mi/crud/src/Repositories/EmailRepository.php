<?php
namespace mi\crud\Repositories;

use Maatwebsite\Excel\Facades\Excel;
use mi\crud\Contracts\Repositories\EmailRepositoryInterface;
use mi\crud\Imports\ImportEmail;
use mi\crud\Models\Email;
use mi\crud\Requests\Email\EditRequest;
use Yajra\DataTables\DataTables;


class EmailRepository implements EmailRepositoryInterface{

    protected $options = ['shoppe', 'lazada', 'tiktok'];
    protected $status = ['public', 'pending', 'in-active'];

    public function getOptions(){
        return $this->options;
    }
    public function getStatus(){
        return $this->status;
    }
    public function all()
    {
        // TODO: Implement all() method.
        return Email::all();
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
        $email->fill($request->validated());
        $email->save();
    }

    public function update(EditRequest $request, $id)
    {
        // TODO: Implement update() method.
        $email = $this->find($id);
        $email->fill($request->validated());
        $email->save();
    }

    public function findByUserId($id)
    {
        // TODO: Implement findByUserId() method.
        return Email::where('created_by',$id);
    }

    public function importEmail($request)
    {
        // TODO: Implement importEmail() method.
        Excel::import(new ImportEmail(), $request->file('file')->store('files'));
    }

    public function deleteAll($request)
    {
        // TODO: Implement deleteAll() method.
        $ids = $request->ids;
        Email::whereIn('id',$ids)->delete();
    }

    public function dataTable(){
        return DataTables::of(Email::query())->make(true);
    }

}
