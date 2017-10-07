<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Facades\PathManager;
use Folklore\Image\Facades\Image as FolkloreImage;

/**
 * App\Http\Models\Images
 *
 * @property int $id
 * @property string $name
 * @property string $hash_name
 * @property string|null $dir
 * @property string|null $title
 * @property string|null $alt
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Images whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Images whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Images whereDir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Images whereHashName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Images whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Images whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Images whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Http\Models\Images whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Images extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';
    private $placeholder = 'placeholder.png';
    private $dir = 'public'; //default dir

    protected $fillable = [
        'name',
        'hash_name',
        'path',
        'title',
        'alt',
    ];

    /**
     * Storage image
     *
     * @param array $params
     * @param UploadedFile $image
     * @return $this
     */
    public function storage(UploadedFile $image, array $params = [])
    {
        //Set default parameters
        $data = [
            'name' => $image->getClientOriginalName(),
            'hash_name' => $image->hashName(),
            'dir' => $this->dir,
            'title' => '',
            'alt' => ''
        ];

        //Write get parameters
        foreach($params as $key => $value){
            $data[$key] = $value;
        }

        //Storage get file
        Storage::disk('images')->putFile(PathManager::publicReference($data['dir']), $image);

        //Check if exist in DB
        $storeImage = $this->where('hash_name', $image->hashName())->where('dir', $data['dir'])->first();

        //Write if not exist in DB
        if(empty($storeImage)){
            $storeImage = $this->create($data);
            $storeImage->save();
        }

        return $storeImage;
    }

    /**
     * Delete image from disk
     *
     * @return boolean
     */
    public function delete()
    {
        $path = PathManager::publicReference($this->dir, $this->hash_name);
        Storage::disk('images')->delete($path);
        $this->delete();
    }

    /**
     * Return original image url
     *
     * @return string
     */
    public function original()
    {
//        if(! $this->existOrm()){
//            return $this->placeholder();
//        }

        $path = PathManager::publicReference($this->dir, $this->hash_name);
        if(Storage::disk('images')->exists($this->hash_name)) {
            return Storage::disk('images')->url($path);
        } else {
            return $this->placeholder();
        }
    }


    /**
     * Return thumbnail url
     *
     * @param int $width
     * @param int $height
     * @return string
     */
    public function thumbnail(int $width, int $height)
    {
        //Check if exist ORM
//        if (!$this->existOrm()) {
//            return $this->placeholder($width, $height);
//        } else {
            return $this->resize($this->hash_name, $this->dir, $width, $height);
//        }
    }

    /**
     * Get placeholder
     *
     * @param int|null $width
     * @param int|null $height
     * @return string
     */
    public function placeholder(int $width = null, int $height = null)
    {
        $placeholderPath = $this->placeholder;

        //Check if image exist end return if true
        if(! Storage::disk('images')->exists($placeholderPath)) { return ''; }

        $name = PathManager::getFileNameByPath($placeholderPath);
        $dir = PathManager::getDirByPath($placeholderPath);

        //Warning!!! Possible recursion in resize method!
        if($width && $height){
            return $this->resize($name, $dir, $width, $height);
        } else {
            return Storage::disk('images')->url($placeholderPath);
        }
    }


    /**
     * Resize image
     *
     * @param string $fileName
     * @param string $dir
     * @param int $width
     * @param int $height
     * @return string
     */
    private function resize(string $fileName, string $dir, int $width, int $height)
    {
        $params = ['width' => $width, 'height' => $height];

        //Init cache dir to image
        $cachePath = PathManager::getCachePath($fileName, $params);
        //Check if image exist end return if true
        if(Storage::disk('cache')->exists($cachePath)) {
            return Storage::disk('cache')->url($cachePath);
        }

        //Resize image
        try {
            FolkloreImage::make(PathManager::publicReference($dir, $fileName), $params)
                ->save(PathManager::publicPath('storage/cache', $cachePath));
            return Storage::disk('cache')->url($cachePath);
        } catch (\Exception $e) {
            //Get placeholder
//            return $this->placeholder($width, $height);
        }
    }

    /*
     * Mutators
     */

    public function getDirAttribute($value)
    {
        if(empty($value)){
            return '';
        } else {
            return $value;
        }
    }
}
