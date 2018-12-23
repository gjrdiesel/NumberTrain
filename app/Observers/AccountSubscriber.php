<?php

namespace App\Observers;

use App\Account;
use App\Jobs\FetchUserStats;

class AccountSubscriber
{
    function created(Account $account)
    {
        dispatch(new FetchUserStats($account->user));
    }
}
