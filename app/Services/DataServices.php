<?php

namespace App\Services;
use App\Models\Data; 

class DataServices {

    protected $dataModel;

    public function __construct(Data $dataModel) {
        $this->dataModel = $dataModel;
    }

    public function dataExists($id) {
        return $this->findDataById($id);
    }

    public function findDataByOwner($owner_id) {
        return $this->dataModel->whereAll('owner', $owner_id);
    }

    public function findDataByOwnerDescend($owner_id, $descending_column) {
        return $this->dataModel->whereAllDescend('owner', $owner_id, $descending_column);
    }

    public function findDataById($data_id) {
        return $this->dataModel->find($data_id);
    }

    public function createData($owner, $title, $description, $content) {
        do {
            $id = random_int_digits(16); // Larger than 16 digits will cause issues with auto-rounding
        } while ($this->dataExists($id));
        return $this->dataModel->create($id, $owner, $title, $description, $content);
    }

    public function deleteData($id) {
        $this->dataModel->delete($id);
    }
}

