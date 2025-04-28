<?php

namespace App\Model\Contracts\Interfaces\Data;

interface UserRepositoryInterface
{

    public function all();
    public function getUsersForCSV(); 
    public function confirm($id);
    public function createUser($args);
    public function get($id);
    public function getByEmail($email);
    public function getByHandle($handle);
    public function getByKey($key);
    public function topUsers($limit, $criteria);
    public function latestUsers($limit, $id);
    public function updateUser($userId, $args);
    public function paginate($limit); 
    public function getCodeCount($code);
    public function getUsersWithBadges($badges);
    public function getUsersThatParticipateIn($competitions);
    public function getByRefCode($refCode);
    public function getByIds($ids);
    public function searchByKeyword($keyword);
    public function getUnverifiedUsers();

}