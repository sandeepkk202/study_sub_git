<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\{PhoneVerification,User,Coupon,UserRequest,Rating,Subscription};
use Auth;
use Carbon;
class UserController extends Controller
{
    /**
     * @OA\Post(
     ** path="/api/update-profile",
     *   tags={"Users"},
     *   summary="update profile",
     *   operationId="updateProfile",
     *   security={ {"bearer": {} }},
     *  @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="email",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="gender",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string",
     *          enum={"Male", "Female","Others"}
     *      )
     *   ),
     *  @OA\Parameter(
     *      name="address_one",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="address_two",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="profile_image",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * * @OA\Parameter(
     *      name="latitude",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * * @OA\Parameter(
     *      name="longitude",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),

     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function updateProfile(Request $request,String $locale){

        $rules=[
            'profile_image' => 'sometimes|required',
            'email' => 'sometimes|required|email',
            // 'gender' => 'sometimes|required',
            // 'address_one' => 'sometimes|required',
            'name' => 'sometimes|required',
            'latitude' => 'sometimes|required',
            'longitude' => 'sometimes|required',
            'phone_number' => 'sometimes|required|regex:/^\d{10,}$/',
            'dob' => 'sometimes|required|date_format:Y-m-d|before:today',
        ];
        $validator = Validator::make($request->all(), $rules);
        // return $request->all();
        if ($validator->fails()) {
            return $this->sendResponse(400, $validator->messages());
        }
        try {
            //->whereNotNull('deleted_at')
            $users=User::where('id','!=',Auth::user()->id);
            if($request->has('email')){
                $users=$users->where('email',$request->email)->exists();
                if($users){
                    return $this->sendResponse(400, trans('common.email_exist',[],$locale));
                }
            }
            $user=Auth::user();
            if($request->has('name')){
                $user->name = $request->name;
            }
            if($request->hasFile('profile_image')){
                $upload =uploadImage($request->profile_image);
                $user->profile_image=$upload['orig_path_url'];
            }
            // if($request->has('profile_image')){
            //     $user->profile_image = $request->profile_image;
            // }
            if($request->has('gender')){
                $user->gender = $request->gender;
            }
            if($request->has('address_one')){
                $user->address_one = $request->address_one;
            }
            if($request->has('address_two')){
                $user->address_two = $request->address_two;
            }
            if($request->has('email')){
                $user->email = $request->email;
            }
            if($request->has('latitude')){
                $user->latitude = $request->latitude;
            }
            if($request->has('longitude')){
                $user->longitude = $request->longitude;
            }
            $user->save();
            $user=Auth::user();
            return $this->sendSuccessResponse(trans('common.records',[],$locale),$user);

        } catch (\Throwable $th) {
            return $this->sendResponse(422, $th->getMessage());
        }
    }
    // public function getFacilitiesDetails($id){
    //     $facilities=User::where('id',$id)->with('pricelist')->first();
    //     return $this->sendSuccessResponse(trans('common.successful', ['attribute' => 'Data fetch']),$facilities);
    // }


    /**
     * @OA\Get(
     ** path="/api/get-vendor-coupon",
     *   tags={"Coupon Api"},
     *   summary="get(without token)/post(with token) vendors coupon list",
     *   operationId="getCoupon",
     *  @OA\Parameter(
     *      name="vendor_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function getCoupon(Request $request,String $locale){
        $rules=[
            'vendor_id' => 'bail|required',
        ];
        $validator = Validator::make($request->all(), $rules);
        // return $request->all();
        if ($validator->fails()) {
            return $this->sendResponse(400, $validator->messages()->first());
        }
        try {
            $userId=$request->vendor_id;
            $user=User::where('id',$userId)->whereHas('getCoupon',function($query){
                return $query->where('end_date','>=',\Carbon\Carbon::now()->format('Y-m-d'));
            })->with('getCoupon','menuList')->first();
            return $this->sendSuccessResponse(trans('common.found',[],$locale),$user);
        } catch (\Throwable $th) {
            return $this->sendResponse(422, $th->getMessage());
        }


    }
    /**
     * @OA\Get(
     ** path="/api/get-coupon-details",
     *   tags={"Coupon Api"},
     *   summary="get coupon details",
     *   operationId="getCouponDetail",
     *  @OA\Parameter(
     *      name="coupon_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function getCouponDetail(Request $request,String $locale){
        $rules=[
            'coupon_id' => 'bail|required',
        ];
        $validator = Validator::make($request->all(), $rules);
        // return $request->all();
        if ($validator->fails()) {
            return $this->sendResponse(400, $validator->messages()->first());
        }
        try {
            $coupon=Coupon::where('id',$request->coupon_id)->with('vendorDetail')->first();
            $coupon['plan']=Subscription::where('type',0)->where('status',1)->first();
            return $this->sendSuccessResponse(trans('common.found',[],$locale),$coupon);
        } catch (\Throwable $th) {
            return $this->sendResponse(422, $th->getMessage());
        }

    }

    /**
     * @OA\Get(
     ** path="/api/get-my-profile",
     *   tags={"User"},
     *   summary="get my/user profile",
     *   operationId="getMyProfile",
     *   security={ {"bearer": {} }},
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function getMyProfile(String $locale){
        $user=User::where('id',Auth::user()->id)->first();
        if($user){
            $count1 = UserRequest::where('user_id',$user->id)->where('claim_type','claimed')->whereMonth('created_at',"=",Carbon\Carbon::now()->month)->sum('total_discount');
            $count2 = UserRequest::where('user_id',$user->id)->where('claim_type','claimed')->whereMonth("created_at","=", Carbon\Carbon::now()->startOfMonth()->subMonths()->month)->sum('total_discount');
            $count3 = UserRequest::where('user_id',$user->id)->where('claim_type','claimed')->whereMonth("created_at","=", Carbon\Carbon::now()->startOfMonth()->subMonths(2)->month)->sum('total_discount');
            $total_saving=$count1+$count2+$count3;
            $user['total_saving']=$total_saving;
            $user['get_subscription_detail']=$user->getSubscriptionDetail();
            $user['plan']=Subscription::where('type',0)->where('status',1)->first();
            $user['monthly_saving']=array(
                'first_month'=>$count3,
                'second_month'=>$count2,
                'third_month'=>$count1,
            );
        }
        return $this->sendSuccessResponse(trans('common.found',[],$locale),$user);
    }

    /**
     * @OA\Post(
     ** path="/api/save-vendor-ratings",
     *   tags={"Rating"},
     *   summary="rating vendor",
     *   operationId="addReview",
     *   security={ {"bearer": {} }},
     *  @OA\Parameter(
     *      name="vendor_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *       name="rating",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     * @OA\Parameter(
     *      name="comments",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string",
     *      )
     *   ),
     * * @OA\Parameter(
     *      name="reviews",
     *      in="query",
     *      required=false,
     *      @OA\Schema(
     *           type="string",
     *      )
     *   ),
     *   @OA\Response(
     *      response=201,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function addReview(Request $request,String $locale){
        $rules=[
            'rating' => 'bail|required',
            'comments' => 'bail|required',
            'vendor_id'=> 'bail|required'
        ];
        $validator = Validator::make($request->all(), $rules);
        // return $request->all();
        if ($validator->fails()) {
            return $this->sendResponse(400, $validator->messages()->first());
        }
        try {
            $data=Rating::where('user_id',Auth::user()->id)->where('vendor_id',$request->vendor_id)->first();
            if($data){
                return $this->sendResponse(422, trans('common.exist_ratings',[],$locale));
            }else{
                $add = new Rating;
                $add->vendor_id=$request->vendor_id;
                $add->user_id = Auth::user()->id;
                $add->rating = $request->rating;
                $add->comments = $request->comments;
                if($request->has('reviews')){
                    $add->reviews = $request->reviews;
                }
                if($add->save()){
                    $user=User::where('id',$request->vendor_id)->first();
                    $rating=Rating::where('vendor_id',$request->vendor_id)->pluck('rating')->toArray();
                    $count=count($rating);
                    if($count==0){
                        $count==1;
                    }
                    $total=array_sum($rating);
                    $avg=$total/$count;
                    $user->total_rating=round($avg);
                    $user->save();

                    return $this->sendSuccessResponse(trans('common.records',[],$locale),$add);
                }
            }
        } catch (\Throwable $th) {
            return $this->sendResponse(422, $th->getMessage());
        }
    }

    /**
     * @OA\Get(
     ** path="/api/get-vendor-ratings",
     *   tags={"Rating"},
     *   summary="get ratings",
     *   operationId="getVendorReviews",
     *   security={ {"bearer": {} }},
     * * @OA\Parameter(
     *      name="vendor_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string",
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/

    public function getVendorReviews(Request $request,String $locale){
        $rules=[
            'vendor_id' => 'bail|required',
        ];
        $validator = Validator::make($request->all(), $rules);
        // return $request->all();
        if ($validator->fails()) {
            return $this->sendResponse(400, $validator->messages()->first());
        }
        try {
            $data=User::where('id',$request->vendor_id)->with('reviewList')->first();
            if($data){
                return $this->sendSuccessResponse(trans('common.records',[],$locale),$data);
            }else{
                return $this->sendResponse(422, trans('common.user_not_found',[],$locale));
            }

        } catch (\Throwable $th) {
            return $this->sendResponse(422, $th->getMessage());
        }
    }

    public function deleteAccount(String $locale){
        User::where('id',Auth::user()->id)->delete();
        return $this->sendSuccessResponse(trans('common.delete_account',[],$locale),[]);
    }
}
