<?php


namespace App\Repository;


interface UserRepositoryInterface
{
    public function ban($id);

    public function total_ban_user();
    public function total_active_user();
    public function total_user();

    public function pagination($search_key,$filter);
}
