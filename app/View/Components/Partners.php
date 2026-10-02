<?php

namespace App\View\Components;

use App\Models\Partner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Partners extends Component
{
    /**
     * Minimum number of logos in one marquee track so the loop never shows a gap.
     */
    private const MINIMUM_TRACK_LENGTH = 8;

    /**
     * Visible partners in display order.
     *
     * @var Collection<int, Partner>
     */
    public Collection $partners;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->partners = Partner::visible()->get();
    }

    /**
     * Only render the section when there is at least one partner.
     */
    public function shouldRender(): bool
    {
        return $this->partners->isNotEmpty();
    }

    /**
     * Partners repeated until one track is long enough to fill wide screens.
     *
     * @return Collection<int, Partner>
     */
    public function track(): Collection
    {
        $repeatCount = (int) ceil(self::MINIMUM_TRACK_LENGTH / $this->partners->count());

        return Collection::times($repeatCount, fn () => $this->partners)->flatten(1);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.partners');
    }
}
