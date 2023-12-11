<?php
namespace App\Contracts\Repositories;


interface AbstractRepositoryInterface{
    public function all();
    public function find($id);
    public function destroy($id);
}
