<?php 

namespace App\Model\Services\Common;

use App\Model\Contracts\Interfaces\Services\Common\FileServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Strings;

class FileService implements FileServiceInterface
{

    public function uploadAvatar($request, $userId)
    {

        Storage::disk('public')->deleteDirectory('images/avatars/'.$userId);

        $interventionFile = Image::make($request->file('file'));
        $background = Image::canvas($interventionFile->width()-4, $interventionFile->height()-4);
        $background->fill('#fff');
        $background->insert($interventionFile, 'top-right', 0, -4);
        $resized = $background->fit(256, 256)->encode('jpg');
        $fullSizeName = Strings::sanitizeForUrl($request->file('file')->getClientOriginalName()).'-full-size.jpg';
        $resizedName = 'images/avatars/'.$userId.'/'.Strings::sanitizeForUrl($request->file('file')->getClientOriginalName()).time().'.jpg';
        $fullSizePath = $request->file('file')->storeAs('images/avatars/'.$userId, $fullSizeName, 'public');
        Storage::disk('public')->put($resizedName, $resized->__toString());

        return [
            'fullSizePath' => 'images/avatars/'.$userId . '/' . $fullSizeName,
            'path' => $resizedName
        ];
        
    }

    public function uploadArticleThumbnail($thumbnail, $articleId)
    {

        Storage::disk('public')->deleteDirectory('images/article_thumbnails/'.$articleId);

        return $thumbnail->storeAs('images/article_thumbnails/'.$articleId, Strings::sanitizeForUrl($thumbnail->getClientOriginalName()).time().'.jpg', 'public');       

    }

    public function uploadSponsorLogo($logo, $sponsorId)
    {

        Storage::disk('public')->deleteDirectory('images/sponsors/'.$sponsorId);

        return $logo->storeAs('images/sponsors/'.$sponsorId, Strings::sanitizeForUrl($logo->getClientOriginalName()).time().'.jpg', 'public');       

    }

    public function uploadEarnPlayDollarLogo($logo, $prizeId)
    {

        Storage::disk('public')->deleteDirectory('images/prizes/'.$prizeId);

        return $logo->storeAs('images/prizes/'.$prizeId, Strings::sanitizeForUrl($logo->getClientOriginalName()).time().'.jpg', 'public');       

    }

    public function uploadRewardLogo($logo, $rewardId)
    {

        Storage::disk('public')->deleteDirectory('images/rewards/'.$rewardId);

        return $logo->storeAs('images/rewards/'.$rewardId, Strings::sanitizeForUrl($logo->getClientOriginalName()).time().'.jpg', 'public');       

    }

    public function uploadCompetitionLogo($logo, $competitionId)
    {

        Storage::disk('public')->deleteDirectory('images/competitions/'.$competitionId);

        return $logo->storeAs('images/competitions/'.$competitionId, Strings::sanitizeForUrl($logo->getClientOriginalName()).time().'.jpg', 'public');       

    }


    public function uploadCompetitionCover($cover, $competitionId)
    {

        Storage::disk('public')->deleteDirectory('images/competitions_cover/'.$competitionId);

        return $cover->storeAs('images/competitions_cover/'.$competitionId, Strings::sanitizeForUrl($cover->getClientOriginalName()).time().'.jpg', 'public');       

    }        

    public function deleteArticleThumbnails($articleId)
    {

        Storage::disk('public')->deleteDirectory('images/article_thumbnails/'.$articleId);

    }

    public function deleteSponsorLogos($sponsorId)
    {

        Storage::disk('public')->deleteDirectory('images/sponsors/'.$sponsorId);

    }

    public function deleteEarnPlayDollarLogos($prizeId)
    {

        Storage::disk('public')->deleteDirectory('images/prizes/'.$prizeId);

    }

    public function deleteRewardLogos($rewardId)
    {

        Storage::disk('public')->deleteDirectory('images/rewards/'.$rewardId);

    } 

    public function deleteUserAvatars($userId)
    {

        Storage::disk('public')->deleteDirectory('images/avatars/'.$userId);

    }  
    
    public function deleteUserCovers($userId)
    {

        Storage::disk('public')->deleteDirectory('images/covers/'.$userId);

    }   

    public function getFileType($file)
    {

        $extension = $file->getClientOriginalExtension();
        switch($extension) {
            case 'pdf':
                return 'pdf';
            case 'xls':
                return 'excel';
            case 'docx':
                return 'word';
            case 'pptx':
                return 'presentation'; 
            case 'mp4':
            case 'mpeg':
                return 'video';
            case 'jpg':
            case 'png':
                return 'image';               
        }
        return 'image';

    }
 
    public function uploadTempCover($request)
    {

        return $request->file('file')->storeAs('images/temp/', Strings::sanitizeForUrl($request->file('file')->getClientOriginalName()).time().'.jpg', 'public');

    }    

    public function uploadCover($request, $userId)
    {

        Storage::disk('public')->deleteDirectory('images/covers/'.$userId);
        $path = $request->file('file')->storeAs('images/covers/'.$userId, Strings::sanitizeForUrl($request->file('file')->getClientOriginalName()).time().'.jpg', 'public');

        return $path;
        
    }    

    public function uploadTechnicalAnalysis($request, $tradeId)
    {

        Storage::disk('public')->deleteDirectory('images/analysis/'.$tradeId);

        if($request->file('analysis'))
        {

            return $request->file('analysis')->storeAs('images/analysis/'.$tradeId, Strings::sanitizeForUrl($request->file('analysis')->getClientOriginalName()).'.jpg', 'public');        
        
        }

        return null;

    }

    public function uploadCkEditorImage($image)
    {

        $name = Strings::sanitizeForUrl($image->getClientOriginalName());
        $name = $name.time().'.jpg';
        $path = $image->storeAs('images/uploads/editor', $name, 'public');
        
		return json_encode([
			'uploaded' => 1,
			'fileName' => $name,
			'url'      => Storage::disk('public')->url($path),
			'response' => Storage::disk('public')->url($path)
		]);        

    }

    public function uploadCkEditorFile($request)
    {

        $name = str_replace(' ', '', $request->upload->getClientOriginalName()) . time().'.jpg';
            
        $request->upload->move(public_path('images/uploads/'), $name);
        
        return json_encode([
            'uploaded' => 1,
            'fileName' => $name,
            'url'      => url('/'). "/images/uploads/" . $name,
            'response' => url('/'). "/images/uploads/" . $name
        ]);

    }
	
}