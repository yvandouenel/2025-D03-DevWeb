<?php

namespace Diginamic\UserManagement\Repository;

interface RepositoryInterface {
    public function findAll(): array;
    public function findById(int $id): ?object;
    public function save(object $entity): bool;
    public function delete(int $id): bool;
}