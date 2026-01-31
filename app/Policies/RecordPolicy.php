<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;

class RecordPolicy
{
    /**
     * ユーザーがモデルを閲覧できるか判定する
     */
    public function view(User $user, Record $record): bool
    {
        return $user->id === $record->user_id;
    }

    /**
     * ユーザーがモデルを更新できるか判定する
     */
    public function update(User $user, Record $record): bool
    {
        return $user->id === $record->user_id;
    }

    /**
     * ユーザーがモデルを削除できるか判定する
     */
    public function delete(User $user, Record $record): bool
    {
        return $user->id === $record->user_id;
    }
}