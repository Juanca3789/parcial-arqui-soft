<?php
    interface StorageInterface{
        public function save_file(array $imagenObtenida, string $destino) : array;
    }
?>