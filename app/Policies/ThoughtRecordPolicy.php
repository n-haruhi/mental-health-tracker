<?php

namespace App\Policies;

use App\Models\ThoughtRecord;
use App\Models\User;

class ThoughtRecordPolicy
{
    /**
     * ユーザーが心の整理を閲覧できるか判定
     */
    public function view(User $user, ThoughtRecord $thoughtRecord): bool
    {
        return $user->id === $thoughtRecord->user_id;
    }

    /**
     * ユーザーが心の整理を更新できるか判定
     */
    public function update(User $user, ThoughtRecord $thoughtRecord): bool
    {
        return $user->id === $thoughtRecord->user_id;
    }

    /**
     * ユーザーが心の整理を削除できるか判定
     */
    public function delete(User $user, ThoughtRecord $thoughtRecord): bool
    {
        return $user->id === $thoughtRecord->user_id;
    }
}