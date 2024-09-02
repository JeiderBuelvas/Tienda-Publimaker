<?php

class Productos extends Controller
{

    private $productosModel;
    public function __construct()
    {
        $this->productosModel = $this->model('ProductosModel');
    }

    public function index()
    {
        $etiqueta = $_GET['etiqueta'] ?? null;

        $title = 'Productos';
        $script = 'productos.js';

        if ($etiqueta) {
            $productos = $this->productosModel->getProductosByEtiqueta($etiqueta);
        } else {
            $productos = $this->productosModel->getProductos();
        }

        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 12;

        $data = $this->paginate($productos, $currentPage, $perPage);

        $this->view('principal/productos', compact('title', 'script', 'productos', 'data'));
    }

    public function categoria($id_cat = null)
    {
        $title = 'Productos';
        $script = 'productos.js';

        $productos = $this->productosModel->getProductosByCategoria($id_cat);

        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 12;

        $data = $this->paginate($productos, $currentPage, $perPage);

        $this->view('principal/productos', compact('title', 'script', 'productos', 'data'));
    }
    public function subcategoria($id_cat = null, $id_subcat = null)
    {
        $title = 'Productos';
        $script = 'productos.js';

        $productos = $this->productosModel->getProductosBySubcategoria($id_cat, $id_subcat);

        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 12;

        $data = $this->paginate($productos, $currentPage, $perPage);

        $this->view('principal/productos', compact('title', 'script', 'productos', 'data'));
    }

    public function detalle($id)
    {
        $producto = $this->productosModel->getProducto($id);
        header('Content-Type: application/json');
        echo json_encode($producto);
    }

    public function prueba()
    {
        header('Content-Type: application/json');
        $datos = $this->productosModel->getCategorias();
        echo json_encode($datos);
    }

    private function paginate($items, $currentPage, $perPage)
    {
        $total = count($items);
        $lastPage = ceil($total / $perPage);
        $offset = ($currentPage - 1) * $perPage;

        $data = array_slice($items, $offset, $perPage);

        $start_item = ($currentPage - 1) * $perPage + 1;
        $end_item = min($start_item + $perPage - 1, $total);

        $uri = $_GET['uri'];

        $last_page_url = BASE_URL . "/{$uri}?page=" . $lastPage;
        $first_page_url = BASE_URL . "/{$uri}?page=1";

        $next_page_url = $currentPage < $lastPage ? BASE_URL . "/{$uri}?page=" . min($lastPage, $currentPage + 1) : null;
        $prev_page_url = $currentPage > 1 ? BASE_URL . "/{$uri}?page=" . max(1, $currentPage - 1) : null;

        $start_page = max($currentPage - 1, 1);
        $end_page = min($start_page + 2, $lastPage);
        $start_page = max($end_page - 2, 1);

        return [
            'total' => $total,
            'current_page' => $currentPage,
            'per_page' => $perPage,
            'start_item' => $start_item,
            'end_item' => $end_item,
            'data' => $data,
            'first_page_url' => $first_page_url,
            'last_page' => $lastPage,
            'last_page_url' => $last_page_url,
            'next_page_url' => $next_page_url,
            'prev_page_url' => $prev_page_url,
            'start_page' => $start_page,
            'end_page' => $end_page,
        ];
    }

}
