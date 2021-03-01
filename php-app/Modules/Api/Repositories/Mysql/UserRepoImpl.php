<?php

namespace Modules\Api\Repositories\Mysql;

use Modules\Api\Contracts\Repositories\Mysql\UserRepository;
use Modules\Api\Entities\User;

class UserRepoImpl implements UserRepository
{
    /**
     * Save User to database
     *
     * @param User $user
     * @return User
     */
    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    /**
     * Get User by id
     *
     * @param int $userId
     * @return User|null
     */
    public function findById(int $userId): ?User
    {
        return User::query()
            ->find($userId);
    }

    /**
     * Get User by phone
     *
     * @param string $phone
     * @return User|null
     */
    public function findByPhone(string $phone): ?User
    {
        return User::query()
            ->where('phone', $phone)
            ->first();
    }

    /**
     * Update data.
     *
     * @param array $data
     * @param int $id
     *
     * @return bool
     */
    public function update(array $data, int $id): bool
    {
        return User::query()
            ->find($id)
            ->update($data);
    }
}
