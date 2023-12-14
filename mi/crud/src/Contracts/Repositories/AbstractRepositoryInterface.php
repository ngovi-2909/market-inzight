<?php
namespace mi\crud\Contracts\Repositories;


interface AbstractRepositoryInterface{
    public function all();
    public function find($id);
    public function destroy($id);
}
