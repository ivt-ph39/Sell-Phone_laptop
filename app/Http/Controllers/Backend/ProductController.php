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
use App\Model\Order;
use Exception;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;

class ProductController extends Controller
{
    const PAGE = 5;
    public function info($info)
    {
        return Auth::user()->$info;
    }
    public function index(Request $request)
    {
        $page = self::PAGE;

        $categories     = Category::all();
        $recursive      = new RecursiveCategory($categories);

        $titlePage      = 'Danh sách sản phẩm';
        $query = Product::orderByDesc('id');
        $htmlOption     = $recursive->recursiveCategory('');

        if (!empty($request->category)) {
            $query = $query->where('category_id', $request->category);
            $htmlOption = $recursive->recursiveCategory($request->category);
        }
        if (!empty($request->name)) {
            $products = $query->where('name', 'like', "%" . trim($request->name) . "%");
        }
        $products     = $query->paginate($page);
        $data = [
            'titlePage'   => $titlePage,
            'nameAdmin'   => ucwords($this->info('name')),
            'products'    => $products,
            'htmlOption'  => $htmlOption,
            'request'     => $request
        ];
        return view('admin.product.list', $data);
    }

    public function create(Brand $brand)
    {
        $nameAdmin      = $this->info('name');

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
            $promotions = $this->arrayToString($request->promotion);
            $technicals = $this->arrayToString($request->name_technical, $request->value_technical);

            // Xử lí file ảnh.
            if ($request->avatar) {
                $avatar = $this->storeFile($request->avatar);
            }

            // Dữ liệu nhập vào cho product.
            $data = [
                'name'        => $request->name,
                'quantity'    => $request->quantity,
                'active'      => $request->active,
                'price'       => $request->price,
                'sale'        => $request->sale,
                'hot'         => $request->hot,
                'category_id' => $request->category_id,
                'brand_id'    => $request->brand_id,
                'avatar'      => $avatar,
                'title'       => $request->title,
                'promotion'   => $promotions,
                'technical'   => $technicals,
                'description' => $request->description,
                'created_by'  => $this->info('id')
            ];
            $product = Product::create($data);

            //insert to table images.
            if ($request->image_detail) {
                foreach ($request->image_detail as $file_image) {
                    $path = $this->storeFile($file_image);
                    $product->images()->create([
                        'path' => $path
                    ]);
                }
            }
            // insert to table tags.
            foreach ($request->tag as $tag) {
                $tagInstance = Tag::firstOrCreate(['name' => $tag]);
                $tagInstanceId[] = $tagInstance->id;
            }
            //insert to table product_tag.
            $product->tags()->attach($tagInstanceId);

            DB::commit();
            return redirect()->route('admin.product.list')->with('success', 'Tạo mới sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
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
        $nameAdmin      = $this->info('name');
        $avatarAdmin    = $this->info('avatar');

        $categories     = Category::all();
        $brands         = Brand::all();
        $product        = Product::with(['images', 'tags', 'category'])->find($id);
        $recursiveCategory   = new RecursiveCategory($categories);
        $titlePage      = 'Edit Sản Phẩm';


        $technicals = json_decode($product->technical, true); // return array
        $promotion  = json_decode($product->promotion, true); // return array

        $data = [
            'titlePage'    => $titlePage,
            'nameAdmin'    => ucwords($nameAdmin),
            'technical' => $technicals,
            'promotion'  => $promotion,
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
            $promotions   = $this->arrayToString($request->promotion);
            $technicals   = $this->arrayToString($request->name_technical, $request->value_technical);

            // Dữ liệu nhập vào cho product.
            $data = [
                'name'        => $request->name,
                'quantity'    => $request->quantity,
                'active'      => $request->active,
                'price'       => $request->price,
                'sale'        => $request->sale,
                'hot'         => $request->hot,
                'category_id' => $request->category_id,
                'brand_id'    => $request->brand_id,
                'title'       => $request->title,
                'promotion'   => $promotions,
                'technical'   => $technicals,
                'description' => $request->description,
                'updated_at'    => now()
            ];

            // Xử lí file ảnh.
            if ($request->avatar_new != null) {
                $avatar_new   = $this->storeFile($request->avatar_new); // trả về  tên đường dẫn đến file ảnh.
                $data['avatar'] = $avatar_new;
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
            //insert to table images.
            if ($request->image_detail_new) {
                foreach ($request->image_detail_new as $file_image) {
                    $path = $this->storeFile($file_image);
                    $product->images()->create([
                        'path' => $path
                    ]);
                }
            }

            // update to table tags.
            foreach ($request->tag as $tag) {
                $tagInstance = Tag::firstOrCreate(['name' => $tag]);
                $tagInstanceId[] = $tagInstance->id;
            }

            //update to table product_tag.
            $product->tags()->sync($tagInstanceId);

            DB::commit();
            return redirect()->to(route('admin.product.list'))->with('success', 'Thay đổi nội dung sản phẩm thành công');
        } catch (Exception $e) {
            DB::rollback();
            // dd($e->getMessage());
            return redirect()->back()->with('error', 'Thay đổi nội dung sản phẩm thất bại')->withInput();
        }
    }

    public function destroy($id)
    {
        $product = Product::with('orders')->find($id);
        $orders = $product->orders()->where('status', '<>', 2)->count();
        if ($orders == 0) {
            $product->delete();
            return back()->with('success', 'Bạn đã xóa sản phẩm thành công');
        } else {
            return back()->with('error', 'Sản phẩm này đang tồn tại trong ' . $orders . ' đơn hàng chưa hoàn thành');
        }
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/' . $filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}