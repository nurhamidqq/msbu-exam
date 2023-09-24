<?php
namespace Src\Controller;

use Src\Repository\ProductRepository;

class ProductController{
    private $db;
    private $requestMethod;
    private $productRepository;

    public function __construct($db, $requestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;

        $this->productRepository = new ProductRepository($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if(isset($_GET['nama'])){
                    $response = $this->searchProduct($_GET['nama']);
                }else{
                    $response = $this->getAllProduct();
                }
                break;
            case 'POST':
                $response = $this->insertProduct();
                break;
            case 'PUT':
                if((int)$_GET['id']){
                    $response = $this->updateProduct($_GET['id']);
                }else{
                    $response = $this->notFoundResponse();
                }
                break;
            case 'DELETE':
                if((int)$_GET['id']){
                    $response = $this->deleteProduct($_GET['id']);
                }else{
                    $response = $this->notFoundResponse();
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllProduct()
    {
        $result = $this->productRepository->findAll();
        if(count($result) > 0){
            $data = [
                'status' => true,
                'data' => $result
            ];
            $response['status_code_header'] = 'HTTP/1.1 200';
            $response['body'] = json_encode($data);
            return $response;   
        }
        return $this->notFoundResponse();
    }

    private function searchProduct($name)
    {
        $result = $this->productRepository->search($name);
        if(count($result) > 0){
            $data = [
                'status' => true,
                'data' => $result
            ];
            $response['status_code_header'] = 'HTTP/1.1 200';
            $response['body'] = json_encode($data);
            return $response;   
        }
        return $this->notFoundResponse();
    }

    private function insertProduct(){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        
        $result = $this->productRepository->insert($input);
        if($result){
            $data = [
                'status' => true,
                'message' => 'success'
            ];
            $response['status_code_header'] = 'HTTP/1.1 200';
            $response['body'] = json_encode($data);
            return $response;
        }else{
            return $this->notFoundResponse();
        }
    }

    private function updateProduct($id){
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        
        $result = $this->productRepository->update($id,$input);
        if($result){
            $data = [
                'status' => true,
                'message' => 'success'
            ];
            $response['status_code_header'] = 'HTTP/1.1 200';
            $response['body'] = json_encode($data);
            return $response;
        }else{
            return $this->notFoundResponse();
        }
    }

    private function deleteProduct($id){
        $result = $this->productRepository->delete($id);
        if($result){
            $data = [
                'status' => true,
                'message' => 'success'
            ];
            $response['status_code_header'] = 'HTTP/1.1 200';
            $response['body'] = json_encode($data);
            return $response;
        }else{
            return $this->notFoundResponse();
        }
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404';
        $response['body'] = json_encode([
            'status' => false,
            'message' => 'not found'
        ]);
        return $response;
    }
}