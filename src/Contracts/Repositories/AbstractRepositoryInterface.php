<?php
namespace MI\Crud\Contracts\Repositories;


interface AbstractRepositoryInterface{
    public function all();
    public function find($id);
    public function destroy($id);
}
