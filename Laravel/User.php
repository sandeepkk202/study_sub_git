<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,SoftDeletes,HasTranslations;
    public $translatable = ['name'];
    protected $guard_name = "web";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'decoded_password'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'is_wishlist',
        'is_subscription_active',
        'is_vendor_rated',
    ];

    public function revokeDeviceTokens()
    {
        return $this->fill(["device_token"=>null])->save();
    }
    public function getNearBy($lat, $lng, $distance,$distanceIn = 'miles')
    {
        if ($distanceIn == 'km') {
            $results = self::select(['*', DB::raw('( 0.621371 * 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(latitude) ) ) ) AS distance')])->havingRaw('distance < '.$distance);
        } else {
            $results = self::select(['*', DB::raw('( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(latitude) ) ) ) AS distance')])->havingRaw('distance < '.$distance);
        }
        return $results;
    }
    public function getCoupon(){
        return $this->hasMany(Coupon::class,'vendor_id')->where('status','active')->where('admin_approval','Approved');
    }
    public function Category(){
        return $this->belongsTo(UserCategory::class,'id','vendor_id');
    }
    public function SubCategory(){
        return $this->belongsTo(UserSubCategory::class,'id','vendor_id');
    }
    public function IsSaved(){
        $data=null;
        // $data = $this->hasOne(Wishlist::class,'vendor_id');
        if(Auth::check()){
            $data= Wishlist::where('vendor_id',$this->id)->where('user_id',Auth::user()->id)->first();
        }
        return $data;
    }
    public function getIsWishlistAttribute(){
        $data=$this->IsSaved();
        if($data){
            return true;
        }
        return false;
    }
    public function IsSubscribed(){
        $data=null;
        // $data = $this->hasOne(Wishlist::class,'vendor_id');
        if(Auth::check()){
            $data= UserSubscription::where('user_id',$this->id)->where('end_date','>',\Carbon\Carbon::now()->format('Y-m-d'))->first();
        }
        // dd(\Carbon\Carbon::now()->format('Y-m-d'));
        return $data;
    }
    public function getIsSubscriptionActiveAttribute(){
        $data=$this->IsSubscribed();
        if($data){
            return true;
        }
        return false;
    }
    public function getSubscriptionDetail(){
        // return $this->hasOne(UserSubscription::class,'user_id')->latest();
        $subscription=UserSubscription::where('user_id',$this->id)->latest()->first();
        return $subscription;
    }
    public function menuList(){
        return $this->hasMany(Image::class,'vendor_id');
    }
    public function reviewList(){
        return $this->hasMany(Rating::class,'vendor_id')->with('userDetails');
    }
    public function IsVendorRated(){
        $data=null;
        // $data = $this->hasOne(Wishlist::class,'vendor_id');
        if(Auth::check()){
            $data= Rating::where('user_id',Auth::user()->id)->where('vendor_id',$this->id)->first();
        }
        // dd(\Carbon\Carbon::now()->format('Y-m-d'));
        return $data;
    }
    public function getIsVendorRatedAttribute(){
        $data=$this->IsVendorRated();
        if($data){
            return true;
        }
        return false;
    }
}
