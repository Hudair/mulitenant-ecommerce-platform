<?php

namespace App\Imports;

use App\Term;
use Maatwebsite\Excel\Concerns\ToModel;
use Str;
use Auth;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Attribute;
use App\Stock;
use App\Meta;
use App\Media;
use App\Postmedia;
use App\Models\Price;
class ProductImport implements ToCollection
{
    protected $user_id;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
       ini_set('max_execution_time', '0');
       $auth_id= Auth::id();
        $limit=user_limit();
        $posts_count=Term::where('user_id',Auth::id())->count();
        
       $this->user_id=$auth_id;
       foreach ($rows as $key => $row) {

           if ($limit['product_limit'] <= $posts_count) {

             \Session::flash('error', 'Maximum posts limit exceeded');
             return back();
             break;
             
           }
           $posts_count++;

           $term=new Term;
           $term->title = $row[0];
           $term->user_id = $auth_id;
           $term->status = 1;
           $term->type = 'product';
           $term->slug = Str::slug($row[0]);
           $term->save();

           $price=new Price;
           $price->term_id=$term->id;
           $price->price=$row[1];
           $price->regular_price=$row[1];
           $price->save();
           

           $stc=new Stock;
           $stc->term_id = $term->id;
           $stc->stock_manage = 1;
           $stc->stock_status = 1;
           $stc->stock_qty = $row[2];
           $stc->sku = $row[3];
           $stc->save();

           $dta['content']=$row[4];
           $dta['excerpt']=$row[5];

           $meta=new Meta;
           $meta->term_id =$term->id;
           $meta->key ='content';
           $meta->value =json_encode($dta);
           $meta->save();

           $data='{"meta_title":"'.$row[0].'","meta_description":"'.$row[5].'","meta_keyword":""}';
           $meta=new Meta;
           $meta->term_id =$term->id;
           $meta->key ='seo';
           $meta->value =$data;
           $meta->save();

           

       }
    }

    public function media($url,$id)
    {
      $imageSizes= json_decode(imageSizes());
            if (!empty($url)) {
              
              $data=explode('/', $url);
              $name=end($data);

              $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg', 'svgz', 'cgm', 'djv', 'djvu', 'ico', 'ief','jpe', 'pbm', 'pgm', 'pnm', 'ppm', 'ras', 'rgb', 'tif', 'tiff', 'wbmp', 'xbm', 'xpm', 'xwd','webp'];

              $explodeImage = explode('.', $name);
              $extension = end($explodeImage);

              if(!in_array(strtolower($extension), $imageExtensions))
              {
                return false;
              }

              $file=file_get_contents($url);
              $path='uploads/'.$this->user_id.date('/y/').date('m').'/'.rand(20,60).$name;
              $filename = 'uploads/'.$this->user_id.date('/y/').date('m').'/';

              $pathArr=explode('/', $path);
              $name=end($pathArr);
              if(!\File::exists($filename)) {
                mkdir($filename, 0777,true);
              }
              file_put_contents($path, $file);
              $imgArr=explode('.', $name);
              
              foreach ($imageSizes as $size) {
               $img=\Image::make($path);
               $img->fit($size->width,$size->height);
               $img->save($filename.$imgArr[0].$size->key.'.'.$imgArr[1]);

             }


             $schemeurl=parse_url(url('/'));
             if ($schemeurl['scheme']=='https') {
               $url=substr(url('/'), 6);
             }
             else{
               $url=substr(url('/'), 5);
             }

            $url=$url.'/'.$path;

            $media=new Media;
            $media->name=$path;
            $media->user_id= $this->user_id;
            $media->url=$url;
            $media->save();

            $post=new Postmedia;
            $post->media_id = $media->id;
            $post->term_id = $id;
            $post->save();
        }

    }



}
