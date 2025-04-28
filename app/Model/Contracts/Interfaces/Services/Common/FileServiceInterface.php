<?php

namespace App\Model\Contracts\Interfaces\Services\Common;

interface FileServiceInterface
{

    public function uploadAvatar($request, $userId);

    public function uploadArticleThumbnail($data, $articleId);

    public function uploadSponsorLogo($data, $sponsorId);

    public function uploadEarnPlayDollarLogo($data, $prizeId);

    public function uploadRewardLogo($data, $rewardId);

    public function deleteArticleThumbnails($articleId);

    public function deleteSponsorLogos($sponsorId);

    public function deleteEarnPlayDollarLogos($prizeId);

    public function deleteRewardLogos($rewardId);

    public function uploadCover($request, $userId);

    public function uploadCompetitionLogo($data, $competitionId);
    
    public function uploadCompetitionCover($data, $competitionId);

    public function uploadTempCover($request);

    public function uploadTechnicalAnalysis($request, $userId);

    public function uploadCkEditorImage($image);

    public function getFileType($filename);

}