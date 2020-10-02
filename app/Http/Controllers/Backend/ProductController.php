<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Model\Product;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Model\Category;
use App\Model\Tag;
use App\Components\RecursiveCategory;
use App\Model\Brand;
use App\Model\Image;
use Exception;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;

class ProductController extends Controller
{
    const PAGE = 5;
    public function info($info)
    {
        return Auth::guard('manager_admin')->user()->$info;
    }
    public function index(Request $request)
    {
        $page = self::PAGE;

        $categories     = Category::all();
        $recursive      = new RecursiveCategory($categories);

        $titlePage      = 'Danh sách sản phẩm';

        if (!empty($request->category) && empty($request->p_name)) {
            $products = Product::where('p_category_id', $request->category)->orderByDesc('id')->paginate($page);
            $htmlOption = $recursive->recursiveCategory($request->category);
        } elseif (empty($request->category) && !empty($request->p_name)) {
            $products = Product::where('p_name', 'like', "%" . trim($request->p_name) . "%")->orderByDesc('id')->paginate($page);
            $htmlOption     = $recursive->recursiveCategory('');
        } elseif (!empty($request->category) && !empty($request->p_name)) {
            $products = Product::where('p_category_id', $request->category)
                ->where('p_name', 'like', "%" . trim($request->p_name) . "%")->orderByDesc('id')->paginate($page);
            $htmlOption     = $recursive->recursiveCategory($request->category);
        } else {
            $products     = Product::orderByDesc('id')->paginate($page);
            $htmlOption     = $recursive->recursiveCategory('');
        }
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->info('adminName')),
            'products'    => $products,
            'htmlOption'  => $htmlOption,
            'request'     => $request
        ];
        return view('admin.product.list', $data);
    }

    public function create(Brand $brand)
    {
        $nameAdmin      = $this->info('adminName');
        $avatarAdmin    = $this->info('avatar');

        $categories     = Category::all();
        $brands         = $brand->all();
        $recursiveCategory      = new RecursiveCategory($categories);

        $titlePage      = 'Tạo Mới Sản Phẩm';
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($nameAdmin),
            'htmlOption'  => $recursiveCategory,
            'brands'      => $brands
        ];
        return view('admin.product.create', $data);
    }

    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();

            //Chuyển các mảng thành các String.
            $p_promotions = $this->arrayToString($request->p_promotion);
            $p_technicals = $this->arrayToString($request->name_p_technical, $request->value_p_technical);

            // Xử lí file ảnh.
            if ($request->p_avatar) {
                $p_avatar = $this->storeFile($request->p_avatar);
            }

            // Dữ liệu nhập vào cho product.
            $data = [
                'p_name'        => $request->p_name,
                'p_number'      => $request->p_number,
                'p_active'      => $request->p_active,
                'p_price'       => $request->p_price,
                'p_sale'        => $request->p_sale,
                'p_hot'         => $request->p_hot,
                'p_category_id' => $request->p_category_id,
                'p_brand_id'    => $request->p_brand_id,
                'p_avatar'      => $p_avatar,
                'p_title'       => $request->p_title,
                'p_promotion'   => $p_promotions,
                'p_technical'   => $p_technicals,
                'p_created_by'  => $this->info('id')
            ];
            $product = Product::create($data);

            //insert to table images.
            if ($request->p_image_detail) {
                foreach ($request->p_image_detail as $file_image) {
                    $path = $this->storeFile($file_image);
                    $product->images()->create([
                        'path_image' => $path
                    ]);
                }
            }
            // insert to table tags.
            foreach ($request->p_keyword_seo as $tag) {
                $tagInstance = Tag::firstOrCreate(['tg_name' => $tag]);
                $tagInstanceId[] = $tagInstance->id;
            }
            //insert to table product_tag.
            $product->tags()->attach($tagInstanceId);

            DB::commit();
            return redirect()->to(route('admin.product.list'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Tạo mới sản phẩm thất bại')->withInput();
        }
    }
    public function storeFile($request)
    {
        $file = $request;
        $namefile = time() . $request->getClientOriginalName();
        $store_file =  $file->move('uploads/images/products/phones', $namefile);
        $path_image = 'uploads/images/products/phones/' . $namefile;

        return $path_image;
    }
    /**
     * Chuyển mảng thành string để upload lên database.
     *
     */
    public function arrayToString($arr_1, $arr_2 = null)
    {
        $strings = '';

        for ($i = 0; $i < count($arr_1); $i++) {
            if ($arr_2 == null) {
                $string =
                    '{
                        "name" : "' . $arr_1[$i] . '"
                    },';
            } else {
                $string =
                    '{
                        "name" : "' . $arr_1[$i] . '",
                        "value" : "' . $arr_2[$i] . '" 
                    },';
            }
            $strings .= $string;
        }
        return "[" . rtrim($strings, ',') . "]";
    }

    public function edit($id)
    {
        $nameAdmin      = $this->info('adminName');
        $avatarAdmin    = $this->info('avatar');

        $categories     = Category::all();
        $brands         = Brand::all();
        $product        = Product::with(['images', 'tags', 'category'])->find($id);
        $recursiveCategory   = new RecursiveCategory($categories);
        $titlePage      = 'Edit Sản Phẩm';


        $p_technicals = json_decode($product->p_technical, true); // return array
        $p_promotion  = json_decode($product->p_promotion, true); // return array

        $data = [
            'titlePage'    => $titlePage,
            'nameAdmin'    => ucwords($nameAdmin),
            'p_technicals' => $p_technicals,
            'p_promotion'  => $p_promotion,
            'product'      => $product,
            'brands'       => $brands,
            'htmlOption'   => $recursiveCategory
        ];

        return view('admin.product.edit', $data);
    }

    public function update(ProductUpdateRequest $request, $id, Image $image)
    {
        try {
            DB::beginTransaction();

            //Chuyển các mảng thành các String.
            $p_promotions   = $this->arrayToString($request->p_promotion);
            $p_technicals   = $this->arrayToString($request->name_p_technical, $request->value_p_technical);

            // Dữ liệu nhập vào cho product.
            $data = [
                'p_name'        => $request->p_name,
                'p_number'      => $request->p_number,
                'p_active'      => $request->p_active,
                'p_price'       => $request->p_price,
                'p_sale'        => $request->p_sale,
                'p_hot'         => $request->p_hot,
                'p_category_id' => $request->p_category_id,
                'p_brand_id'    => $request->p_brand_id,
                'p_title'       => $request->p_title,
                'p_promotion'   => $p_promotions,
                'p_technical'   => $p_technicals,
                'p_update_by'   => $this->info('id'),
                'updated_at'    => now()
            ];

            // Xử lí file ảnh.
            if ($request->p_avatar_new != null) {
                $p_avatar_new   = $this->storeFile($request->p_avatar_new); // trả về  tên đường dẫn đến file ảnh.
                $data           = array_merge($data, ['p_avatar' => $p_avatar_new]);
            }

            Product::find($id)->update($data);

            $product = Product::find($id);

            // Delete images deleted.
            if ($request->images_no_delete) {
                $images_existed = $image->where('product_id', $id)->pluck('id');
                $id_image_remove = array_diff($images_existed->toArray(), $request->images_no_delete);
                foreach ($id_image_remove as $id_image) {
                    $image->where('id', $id_image)->delete();
                }
            }
            // Add images added.
            if ($request->p_image_detail_new) {
                foreach ($request->p_image_detail_new as $p_image) {
                    $path_image = $this->storeFile($p_image);
                    $image->create([
                        'path_image'   => $path_image,
                        'product_id'   => $id
                    ]);
                }
            }

            // update to table tags.
            foreach ($request->p_keyword_seo as $tag) {
                $tagInstance = Tag::firstOrCreate(['tg_name' => $tag]);
                $tagInstanceId[] = $tagInstance->id;
            }

            //update to table product_tag.
            $product->tags()->sync($tagInstanceId);

            DB::commit();
            return redirect()->to(route('admin.product.list'));
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
            return redirect()->back()->with('error_update', 'Thay đổi nội dung sản phẩm thất bại')->withInput();
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return back();
    }
}