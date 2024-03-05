<?php
use App\Models\Allocated;
use App\Models\User;

function get_assigned_artisan($issue_id)
{
    $allocated = Allocated::where('issue_id', $issue_id)->first();
    if(is_null($allocated)){
        return 'Not Allocated';
    }

    $artisan = User::find($allocated->user_id);
    if(is_null($artisan)){
        return 'NULL';
    }
    return $artisan->name;
}

function thread_sender($user_id)
{
    $username = 'NULL';
    $role = 'NULL';

    $user = User::find($user_id);
    if(!is_null($user)){
        $username = $user->name;
        $role = $user->roles->first();

        return $username.' ('.$role->display_name.')';
    }
    return $username.' ('.$role.')';
}

function issue_sender($user_id)
{
    $username = 'NULL';

    $user = User::find($user_id);
    if(!is_null($user)){
        $username = $user->name;
        return $username;
    }
    return $username;
}
