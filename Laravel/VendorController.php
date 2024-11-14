<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\{Category,Image,User,VendorChangeRequest};
use Illuminate\Http\Request;
use Auth;
class ProfileController extends Controller
{
    public function editProfile(Request $request){
        try {
            $data = Auth::user();
            $pages='profile';
            $category=Category::isActive()->get();
            $changedProfileImage = VendorChangeRequest::where(['user_id'=>$data->id,'field_name'=>'profile_image','is_approved'=>VendorChangeRequest::STATE_PENDING])->first();
            $changedNameEn = VendorChangeRequest::where(['user_id'=>$data->id,'field_name'=>'name_english','is_approved'=>VendorChangeRequest::STATE_PENDING])->first();
            $changedNameAr = VendorChangeRequest::where(['user_id'=>$data->id,'field_name'=>'name_arabic','is_approved'=>VendorChangeRequest::STATE_PENDING])->first();
            $changedPhoneNumber = VendorChangeRequest::where(['user_id'=>$data->id,'field_name'=>'phone_number','is_approved'=>VendorChangeRequest::STATE_PENDING])->first();
            $changedAddress = VendorChangeRequest::where(['user_id'=>$data->id,'field_name'=>'address','is_approved'=>VendorChangeRequest::STATE_PENDING])->first();
            return view('facilities.subscription.edit',compact('pages','category','changedProfileImage','changedNameEn','changedNameAr','changedPhoneNumber','changedAddress'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server Error');
        }

    }

    public function updateProfile(Request $request){
        try {
            $data = Auth::user();
            $existingChangeRequests = VendorChangeRequest::where('user_id', $data->id)->get();

            $updatedFields = [];
            if($request->hasFile('image')){
                $upload=uploadImage($request->image);
                $updatedFields[] = ['field_name' => 'profile_image', 'new_value' => $upload['orig_path_url']];
            }

            if ($request->filled('name_en') && $request->name_en !== $data->getTranslation('name', 'en')) {
                $updatedFields[] = ['field_name' => 'name_english', 'new_value' => $request->name_en];
            }

            if ($request->filled('name_ar') && $request->name_ar !== $data->getTranslation('name', 'ar')) {
                $updatedFields[] = ['field_name' => 'name_arabic', 'new_value' => $request->name_ar];
            }

            if ($request->filled('phone') && $request->phone !== $data->phone_number) {
                $updatedFields[] = ['field_name' => 'phone_number', 'new_value' => $request->phone];
            }

            if ($request->filled('address') && $request->address !== $data->location) {
                $updatedFields[] = ['field_name' => 'address', 'new_value' => $request->address];
                $updatedFields[] = ['field_name' => 'latitude', 'new_value' => $request->latitude];
                $updatedFields[] = ['field_name' => 'longitude', 'new_value' => $request->longitude];
            }

            foreach ($updatedFields as $field) {
                $existingRequest = $existingChangeRequests->where('field_name', $field['field_name'])->first();

                if ($existingRequest) {
                    $existingRequest->new_value = $field['new_value'];
                    $existingRequest->is_approved = false;
                    $existingRequest->save();
                } else {
                    // Create a new change request entry
                    $changeRequest = new VendorChangeRequest();
                    $changeRequest->user_id = $data->id;
                    $changeRequest->field_name = $field['field_name'];
                    $changeRequest->new_value = $field['new_value'];
                    $changeRequest->is_approved = false;
                    $changeRequest->save();
                }
            }

            return redirect()->route('vendor.profile')->with('success',__('Profile changes requested. Waiting for admin approval'));

        } catch (\Throwable $th) {
            return redirect()->back()->with('error',__('Something went wrong. Try Again!'));
        }
    }

    // public function updateProfile(Request $request){
    //     try {
    //         $data=Auth::user();
    //         if($data){
    //             $data
    //                 ->setTranslation('name', 'en', $request->name_en)
    //                 ->setTranslation('name', 'ar', $request->name_ar);
    //             $data->name = $request->name ?? $data->name;
    //             $data->country_code = $request->country_code ?? $data->country_code;
    //             $data->phone_number = $request->phone ?? $data->phone;
    //             $data->location = $request->address ?? $data->address;
    //             $data->latitude = $request->latitude ?? $data->latitude;
    //             $data->longitude = $request->longitude ?? $data->longitude;
    //             if($request->has('email')){
    //                 $data->email = $request->email ?? $data->email;
    //             }
    //             if($request->hasFile('image')){
    //                 $upload=uploadImage($request->image);
    //                 $data->profile_image=$upload['orig_path_url'];
    //             }
    //             $data->save();
    //             return redirect()->route('vendor.profile')->with('success',__('Profile updated successfully'));
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error',__('Something went wrong.Try Again!'));
    //     }
    // }
    public function getMenus(){
        $pages='menus';
        $menu = Image::where('vendor_id',Auth::user()->id)->where('type',1)->orderBy('id','DESC')->get();
        return view('facilities.menuIndex',compact('pages','menu'));
    }
    public function addMenus(Request $request){
        try {
            $data=new Image;
            $data->vendor_id=Auth::user()->id;
            if($request->hasFile('image')){
                $upload=uploadImage($request->image);
                $data->image=$upload['orig_path_url'];
                $data->description=$request->description;
                $data->status=Image::STATE_PENDING;
            }
            if($data->save()){
                return redirect()->back()->with('success',__('Menu added success'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',__('Something went wrong.Try Again!'));
        }
    }
    public function deleteMenus($id){
        Image::where('id',$id)->delete();
        return redirect()->back()->with('success',__('Menu deleted sucessfully'));
    }


    public function getAllMenus(){
        $pages='menus';
        $menu = Image::where('type',1)->orderBy('id','DESC')->get();
        return view('admin.admin-menu',compact('pages','menu'));
    }

    public function approveMenus($id){
        $menu = Image::find($id);
        if (!$menu) {
            return redirect()->back()->with('error', __('Menu not found'));
        }
        $menu->status = Image::STATE_APPROVED;
        $menu->save();
        return redirect()->back()->with('success', __('Menu approved successfully'));
    }

    public function vendorChangeRequest(Request $request){
        try {
            $vendorChangeRequest = VendorChangeRequest::where('is_approved',0)
            ->whereNotIn('field_name', ['latitude', 'longitude'])
            ->get();
            return view('admin.vendor.vendor-change-request',compact('vendorChangeRequest'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Server Error');
        }
    }
    public function approveChangeRequest($id){
        $changeRequestData = VendorChangeRequest::find($id);

        if (!$changeRequestData) {
            return redirect()->back()->with('error', __('Change Request not found'));
        }

        $user = User::find($changeRequestData->user_id);

        if (!$user) {
            return redirect()->back()->with('error', __('User not found'));
        }
        $latitudeChangeRequest = VendorChangeRequest::where([
            'user_id' => $changeRequestData->user_id,
            'field_name' => 'latitude'
        ])->first();
        $longitudeChangeRequest = VendorChangeRequest::where([
            'user_id' => $changeRequestData->user_id,
            'field_name' => 'longitude'
        ])->first();
        switch ($changeRequestData->field_name) {
            case 'profile_image':
                $user->profile_image = $changeRequestData->new_value;
                break;
            case 'name_english':
                $user->setTranslation('name', 'en', $changeRequestData->new_value);
                break;
            case 'name_arabic':
                $user->setTranslation('name', 'ar', $changeRequestData->new_value);
                break;
            case 'address':
                $user->location = $changeRequestData->new_value;
                $user->latitude = $latitudeChangeRequest->new_value;
                $user->longitude = $longitudeChangeRequest->new_value;
                break;
            case 'phone_number':
                $user->phone_number = $changeRequestData->new_value;
                break;
            default:
                $user->setAttribute($changeRequestData->field_name, $changeRequestData->new_value);
                break;
        }
        $user->save();
        $changeRequestData->is_approved = VendorChangeRequest::STATE_APPROVED;
        if($latitudeChangeRequest){
            $latitudeChangeRequest->is_approved = VendorChangeRequest::STATE_APPROVED;
            $latitudeChangeRequest->save();
        }
        if($longitudeChangeRequest){
            $longitudeChangeRequest->is_approved = VendorChangeRequest::STATE_APPROVED;
            $longitudeChangeRequest->save();
        }
        $changeRequestData->save();


        return redirect()->back()->with('success', __('Change Request approved successfully'));
    }

    public function rejectChangeRequest($id){
        $changeRequestData = VendorChangeRequest::find($id);
        if (!$changeRequestData) {
            return redirect()->back()->with('error', __('Change Request not found'));
        }
        $latitudeChangeRequest = VendorChangeRequest::where([
            'user_id' => $changeRequestData->user_id,
            'field_name' => 'latitude'
        ])->first();
        $longitudeChangeRequest = VendorChangeRequest::where([
            'user_id' => $changeRequestData->user_id,
            'field_name' => 'longitude'
        ])->first();
        $changeRequestData->is_approved = VendorChangeRequest::STATE_REJECTED;
        if($latitudeChangeRequest){
            $latitudeChangeRequest->is_approved = VendorChangeRequest::STATE_REJECTED;
            $latitudeChangeRequest->save();
        }
        if($longitudeChangeRequest){
            $longitudeChangeRequest->is_approved = VendorChangeRequest::STATE_REJECTED;
            $longitudeChangeRequest->save();
        }
        $changeRequestData->save();
        return redirect()->back()->with('success', __('Change Request rejected successfully'));
    }
}
