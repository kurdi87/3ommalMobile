<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;

use DB;
use Auth;
use Crypt;

use App\Http\Controllers\GalleryHelper;

use App\Models\GalleryModel;
use App\Models\GalleryMediaModel;
use App\Models\SystemLookupModel;
use App\Models\GalleryLanguageModel;
use App\Models\GalleryMediaLanguageModel;

use Illuminate\Http\Request;
use App\Models\AirportsModel;
use App\Models\AirlinesModel;
use App\Models\GooglePlaceLanguage;

use Intervention\Image\ImageManager;

class AjaxController extends SuperAdminController
{
    public function __construct()
    {
        parent::__construct();
    }
	
	/*public function postUpload(Request $request)
	{
		$GallMed_GalleryID = Crypt::decrypt($request->get('gallery_id'));
		$GallMed_MediaType = SystemLookupModel::getIdByKey('GALLERY_MEDIA_TYPE_IMAGE');
		$GallMed_Order = 1;
		
		$images = $request->file('files');
		
		$filename = "";
				
		if($request->hasFile('files'))
		{
			foreach($images as $image)
			{
				$destinationPath = 'uploads/media/';
				$filename = 'media_' . strtotime(date("Y-m-d H:i:s")) . mt_rand(10,1000) . '.' . $image->getClientOriginalExtension();
				$uploadSuccess = $image->move($destinationPath, $filename);
				
				$galleryMediaObj = new GalleryMediaModel();
		
				$galleryMediaObj->GallMed_GalleryID = $GallMed_GalleryID;
				$galleryMediaObj->GallMed_MediaType = $GallMed_MediaType;
				$galleryMediaObj->GallMed_Link = $filename;
				$galleryMediaObj->GallMed_Order = $GallMed_Order;
				
				$add = $galleryMediaObj->save();
								
				return response()->json($galleryMediaObj);
			}
		}
	}*/
	
    public function getAirports(Request $request)
    {
        return AirportsModel::getAirports($request->input('q'));
    }

    public function getAirlines(Request $request)
    {
        return AirlinesModel::getAirlines($request->input('q'));
    }

    public function getCity(Request $request)
    {
        return GooglePlaceLanguage::getCities($request->input('q'));
    }
}
