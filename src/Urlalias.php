<?php

namespace dmcdenissen\urlalias;

use Illuminate\Database\Eloquent\Model;

class Urlalias extends Model
{
        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'urlalias';

        /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['slug', 'controller', 'method', 'arguments'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'arguments' => 'array',
    ];

    // /**
    // *  Return Url alias Slug
    // *
    // * @param int $id controller id
    // * @param str controller
    // * @return str  $slug
    // */
    // static function getSlug($controller, $method = null, $id = null) {
        
    //     $urlaliasObj = selF::where([['controller', '=', $controller],['method', '=', $method], ['arguments', '=', $id]])->first();
    //     if(isset($urlaliasObj) && isset($urlaliasObj->slug)) {
    //         return $urlaliasObj->slug;
    //     } 
    //     return false;
    // }

    /**
    *  Return Urlalias collection by slug
    *
    * @param str $slug url
    * @return Collection $UrlaliasObject
    */
    static function getSlug($slug) {
        $urlaliasObj = selF::where('slug', '=', trim($slug))->first();
        if(isset($urlaliasObj) && count($urlaliasObj) > 0) {
            return $urlaliasObj;
        } 
        return false;
    }


    static function setSlug($arr) {
        // check if controller exists
        if(isset($arr['controller']) && class_exists($arr['controller'])) {
            if(!isset($arr['method']) || (isset($arr['method']) && $arr['method']!='')) {
                $arr['method'] = 'show';
                if(!isset($arr['arguments']) || (isset($arr['arguments']) && count($arr['arguments']) < 1)) {
                    $arr['method'] = 'index';
                    $arr['arguments'] = null;
                }
            }
            if(method_exits($arr['controller'],$arr['method'])) {
                $validator = Validator::make($arr, ['slug' => ['required','unique:urlalias']]);
                if($validator->passes()) {
                    return Self::create($arr);
                }
            }
        }
        return false;
    }

}
