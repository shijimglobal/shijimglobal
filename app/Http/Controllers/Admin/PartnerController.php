<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReorderPartnersRequest;
use App\Http\Requests\Admin\StorePartnerRequest;
use App\Http\Requests\Admin\UpdatePartnerRequest;
use App\Models\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    /**
     * List every partner in display order; adding and editing happen in a modal on this page.
     */
    public function index(): View
    {
        return view('admin.partners.index', [
            'partners' => Partner::query()->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    /**
     * Store a new partner at the end of the list.
     */
    public function store(StorePartnerRequest $request): RedirectResponse
    {
        Partner::create([
            ...$request->safe()->except('logo'),
            'sort_order' => (Partner::max('sort_order') ?? -1) + 1,
            'is_active' => $request->boolean('is_active'),
            'logo_path' => $request->file('logo')->store('partners', Partner::LOGO_DISK),
        ]);

        return redirect()->route('admin.partners.index')->with('status', __('Partner added.'));
    }

    /**
     * Update a partner, replacing its logo when a new one is uploaded.
     */
    public function update(UpdatePartnerRequest $request, Partner $partner): RedirectResponse
    {
        $attributes = [
            ...$request->safe()->except('logo'),
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('logo')) {
            Storage::disk(Partner::LOGO_DISK)->delete($partner->logo_path);
            $attributes['logo_path'] = $request->file('logo')->store('partners', Partner::LOGO_DISK);
        }

        $partner->update($attributes);

        return redirect()->route('admin.partners.index')->with('status', __('Partner updated.'));
    }

    /**
     * Save the order set by dragging the partners list.
     */
    public function reorder(ReorderPartnersRequest $request): JsonResponse
    {
        DB::transaction(function () use ($request): void {
            foreach ($request->validated('partners') as $position => $partnerId) {
                Partner::whereKey($partnerId)->update(['sort_order' => $position]);
            }
        });

        return response()->json(['message' => __('Order saved')]);
    }

    /**
     * Delete a partner and its logo file.
     */
    public function destroy(Partner $partner): RedirectResponse
    {
        Storage::disk(Partner::LOGO_DISK)->delete($partner->logo_path);
        $partner->delete();

        return redirect()->route('admin.partners.index')->with('status', __('Partner deleted.'));
    }
}
