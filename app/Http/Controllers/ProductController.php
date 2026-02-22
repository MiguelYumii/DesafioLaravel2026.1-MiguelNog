<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth; 

class ProductController extends Controller
{

    public function show($id)
    {
    $produto = \App\Models\Product::findOrFail($id);
    
    return view('Pagina_Individual', compact('produto'));
    }


    public function inicio() 
    {

        $destaques = Product::inRandomOrder()->take(18)->get();
        $user = Auth::user();
        $users = User::all();
        $products = Product::paginate(18); 
        return view('Pagina_Inicial', compact('products', 'user', 'users')); 
    }



    public function buscar(Request $request)
    {
    $product_category = $request->input('product_category');
    $termo = $request->input('termo');
    $destaques = Product::inRandomOrder()->take(18)->get(); 
    $query = Product::query();



    if (!empty($product_category)) {
        $query->where('product_category', $product_category);
    }

    if (!empty($termo)) {
        $query->where('product_name', 'like', '%' . $termo . '%');
    }

    $products = $query->paginate(30);

    return view('Pagina_Inicial', compact('products', 'destaques')); 
    }




    public function index()  // CRUD Produtos
    {
        $products = Product::all();
        $products = \App\Models\Product::paginate(50);
        
        return view('CRUD_Produtos', compact('products')); 
        
    }
    

    //criar
    public function store(Request $request)
    {
        $user_pf = '';

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $file = $request->file('foto');
            $nomeimagem = sha1(uniqid($file->getClientOriginalName(), true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/UsuarioPF'), $nomeimagem);
            $user_pf = 'assets/UsuarioPF/' . $nomeimagem;
        }

        // forcecreate por conta do erro do adm, resolver isso depois na integração
        $produto = Product::forceCreate([
            'product_image' => $user_pf,
            'product_autor' => Auth::id(),
            'product_AutorPhone' => Auth::user()->phone,
            'product_name' => $request->input('Produto_Nome'),
            'product_value' => $request->input('Produto_Preco'),
            'product_stock' => $request->input('Produto_Estoque'),
            'product_description' => $request->input('Produto_Descricao'),
            'product_category' => $request->input('Produto_Categoria'),
            ]); 

        return redirect()->route('index')->with('success', 'Produto criado com sucesso!');
    }


    //apagar
    public function destroy($product_id)
    {
        $product = Product::findOrFail($product_id);
        $product->delete();
        
        if($product->product_image && File::exists(public_path($product->product_image))) {
             File::delete(public_path($product->product_image)); 
        }

        return redirect()->route('index')->with('success', 'Produto deletado com sucesso!');
    }



    //editar
    public function update(Request $request, $product_id)
    {


        $product = Product::findOrFail($product_id);
        $data = $request->all();

        


        $updateData = [
            'foto'     => $data['produto_foto'] ?? $product->foto,
            'nome'     => $data['produto_nome'] ?? $product->nome,
            'preco'    => $data['produto_preco'] ?? $product->preco,
            'estoque'  => $data['produto_estoque'] ?? $product->estoque,
            'descricao' => $data['produto_descricao'] ?? $product->descricao,
            'categoria' => $data['produto_categoria'] ?? $product->categoria,
        ];

       

        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            if($product->foto && File::exists(public_path($product->foto))) {
                File::delete(public_path($product->foto)); 
            }

            $file = $request->file('foto');
            $nomeimagem = sha1(uniqid($file->getClientOriginalName(), true)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/Produtos'), $nomeimagem);
            $updateData['foto'] = 'assets/Produtos/' . $nomeimagem;
        }
        
    
  
        $product->update($updateData);
        return redirect()->route('index');
    }
}