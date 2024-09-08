<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    private $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }
    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }
    public function update(array $data, $id)
    {
        return $this->productRepository->update($data,$id);
    }
    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }


}
