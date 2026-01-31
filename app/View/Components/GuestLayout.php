<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * コンポーネントを表すビュー/コンテンツを取得する
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
