<?php

namespace App\View\Components;

use App\Services\FacebookPageService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FacebookPage extends Component
{
    /**
     * The Facebook page profile, or null when unavailable.
     *
     * @var array{name: string, about: ?string, category: ?string, link: string, followers_count: int, fan_count: int, picture_url: ?string, cover_url: ?string}|null
     */
    public ?array $profile;

    /**
     * Create a new component instance.
     */
    public function __construct(FacebookPageService $facebookPageService)
    {
        $this->profile = $facebookPageService->profile();
    }

    /**
     * Only render the section when page data is available.
     */
    public function shouldRender(): bool
    {
        return $this->profile !== null;
    }

    /**
     * Shorten a count for display.
     */
    public function abbreviate(int $count): string
    {
        return FacebookPageService::abbreviate($count);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.facebook-page');
    }
}
