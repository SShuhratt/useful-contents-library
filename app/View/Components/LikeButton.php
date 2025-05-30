<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use App\Models\Content;

class LikeButton extends Component
{
    public Content $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('components.like-button');
    }
}

