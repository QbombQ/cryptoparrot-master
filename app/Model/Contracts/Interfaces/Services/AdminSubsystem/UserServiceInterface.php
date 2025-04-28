<?php

namespace App\Model\Contracts\Interfaces\Services\AdminSubsystem;

interface UserServiceInterface
{

    public function all();

    public function allNoFormat();

    public function paginate($perPage);

    public function getForEdit($handle);

    public function edit($data);

    public function getUnverifiedUsers();

    public function updateMainPortfolio($portfolioId, $userId);

    public function updateCurrentPortfolio($portfolioId, $userId);

    public function getLastYearStats();

    public function getStats();
    
    public function getUsersForCSV();

    public function deleteUser($id);

    public function banUser($id);

    public function unBanUser($id);

    public function getTodayUserActivity();

    public function getThisWeekUserActivity();

    public function getUserActivity();

    public function followRandomUsers();



}