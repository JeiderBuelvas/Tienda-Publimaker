<?php
require_once 'BaseModel.php';
class ProductosModel extends BaseModel
{

    public function getProductos()
    {
        $endpoint = '/materialesAPI';
        $response = $this->makeRequest('GET', $endpoint, null, true);
        return $response['results'];
    }

    public function getProductosByCategoria($categoriaId)
    {
        $endpoint = '/materialesAPI';
        $response = $this->makeRequest('GET', $endpoint, null, true);
        $data = $response['results'];

        $productos = [];

        foreach ($data as $producto) {
            $found = false;

            if (isset($producto['subcategoria_1']) && $producto['subcategoria_1']['categoria'] == $categoriaId) {
                $found = true;
            }

            if (isset($producto['subcategoria_2']) && $producto['subcategoria_2']['categoria'] == $categoriaId) {
                $found = true;
            }

            if (isset($producto['subcategoria_3']) && $producto['subcategoria_3']['categoria'] == $categoriaId) {
                $found = true;
            }

            if ($found) {
                $productos[] = $producto;
            }
        }

        return $productos;
    }

    public function getProductosBySubcategoria($categoriaId, $subcategoriaId)
    {
        $endpoint = "/materialesAPI";
        $response = $this->makeRequest('GET', $endpoint, null, true);
        $data = $response['results'];

        $productos = [];

        foreach ($data as $producto) {
            // Verificar subcategoria_1
            if (isset($producto['subcategoria_1']) && $producto['subcategoria_1']['categoria'] == $categoriaId && $producto['subcategoria_1']['jerarquia'] == $subcategoriaId) {
                $productos[] = $producto;
            }

            // Verificar subcategoria_2
            if (isset($producto['subcategoria_2']) && $producto['subcategoria_2']['categoria'] == $categoriaId && $producto['subcategoria_2']['jerarquia'] == $subcategoriaId) {
                $productos[] = $producto;
            }

            // Verificar subcategoria_3
            if (isset($producto['subcategoria_3']) && $producto['subcategoria_3']['categoria'] == $categoriaId && $producto['subcategoria_3']['jerarquia'] == $subcategoriaId) {
                $productos[] = $producto;
            }
        }

        return $productos;
    }

    public function getProductosByEtiqueta($etiquetaId)
    {
        $endpoint = "/materialesAPI";
        $response = $this->makeRequest('GET', $endpoint, null, true);
        $data = $response['results'];

        $productos = [];

        foreach ($data as $producto) {
            if (isset($producto['etiquetas']) && is_array($producto['etiquetas'])) {
                foreach ($producto['etiquetas'] as $etiqueta) {
                    if ($etiqueta['id'] == $etiquetaId) {
                        $productos[] = $producto;
                        break; // Salimos del bucle interno ya que encontramos la etiqueta
                    }
                }
            }
        }

        return $productos;
    }

    public function getProducto($id)
    {
        $endpoint = "/materialesAPIByProducto?producto=$id";
        $response = $this->makeRequest('GET', $endpoint, null, false);
        return $response;
    }

    public function getCategorias()
    {
        $endpoint = '/materialesAPI';
        $response = $this->makeRequest('GET', $endpoint, null, true);
        $data = $response['results'];

        $categorias = [];

        foreach ($data as $value) {
            // Procesar subcategoria_1
            if ($value['subcategoria_1']) {
                $this->procesarSubcategoria($categorias, $value['subcategoria_1']);
            }

            // Procesar subcategoria_2 si existe
            if ($value['subcategoria_2']) {
                $this->procesarSubcategoria($categorias, $value['subcategoria_2']);
            }

            // Procesar subcategoria_3 si existe
            if ($value['subcategoria_3']) {
                $this->procesarSubcategoria($categorias, $value['subcategoria_3']);
            }
        }

        // Convertir el array asociativo en un array indexado y ordenar
        $categorias = array_values($categorias);
        foreach ($categorias as &$categoria) {
            $categoria['subcategorias'] = array_values($categoria['subcategorias']);

            // Ordenar subcategorias por nombre
            usort($categoria['subcategorias'], function ($a, $b) {
                return strcmp($a['nombre'], $b['nombre']);
            });
        }

        // Ordenar categorias por nombre
        usort($categorias, function ($a, $b) {
            return strcmp($a['nombre'], $b['nombre']);
        });

        return $categorias;
    }

    private function procesarSubcategoria(&$categorias, $subcategoria)
    {
        $categoriaId = $subcategoria['categoria'];
        $categoriaNombre = $subcategoria['nombre_categoria'];
        $subcategoriaId = $subcategoria['jerarquia'];
        $subcategoriaNombre = $subcategoria['nombre'];

        if (!isset($categorias[$categoriaId])) {
            $categorias[$categoriaId] = [
                'id' => $categoriaId,
                'nombre' => $categoriaNombre,
                'subcategorias' => [],
            ];
        }

        if (!isset($categorias[$categoriaId]['subcategorias'][$subcategoriaId])) {
            $categorias[$categoriaId]['subcategorias'][$subcategoriaId] = [
                'id' => $subcategoriaId,
                'nombre' => $subcategoriaNombre,
            ];
        }
    }

}
