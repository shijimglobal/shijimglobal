<?php

use App\Models\Partner;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake(Partner::LOGO_DISK);
});

test('guests cannot manage partners', function () {
    $this->get(route('admin.partners.index'))->assertRedirect(route('login'));
    $this->post(route('admin.partners.store'))->assertRedirect(route('login'));
});

test('partners list is displayed', function () {
    Partner::factory()->create(['name' => 'Хаан Банк']);

    $this->actingAs(User::factory()->create())
        ->get(route('admin.partners.index'))
        ->assertOk()
        ->assertSee('Хаан Банк');
});

test('partner can be added with a logo', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('admin.partners.store'), [
            'name' => 'Голомт Банк',
            'logo' => UploadedFile::fake()->image('logo.png', 400, 200),
            'website_url' => 'https://golomtbank.com',
            'is_active' => '1',
        ])
        ->assertRedirect(route('admin.partners.index'))
        ->assertSessionHasNoErrors();

    $partner = Partner::sole();

    expect($partner->name)->toBe('Голомт Банк')
        ->and($partner->sort_order)->toBe(0)
        ->and($partner->is_active)->toBeTrue();

    Storage::disk(Partner::LOGO_DISK)->assertExists($partner->logo_path);
});

test('partners page contains the add partner modal', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('admin.partners.index'))
        ->assertOk()
        ->assertSee('data-partner-modal', false)
        ->assertSee('action="'.route('admin.partners.store').'"', false)
        ->assertDontSee('data-open-on-load', false);
});

test('modal reopens with the entered values after a validation error', function () {
    $this->actingAs(User::factory()->create())
        ->from(route('admin.partners.index'))
        ->followingRedirects()
        ->post(route('admin.partners.store'), ['name' => 'Лого мартсан хамтрагч'])
        ->assertOk()
        ->assertSee('data-open-on-load', false)
        ->assertSee('value="Лого мартсан хамтрагч"', false);
});

test('modal reopens in edit mode after an update validation error', function () {
    $partner = Partner::factory()->create();

    $this->actingAs(User::factory()->create())
        ->from(route('admin.partners.index'))
        ->followingRedirects()
        ->put(route('admin.partners.update', $partner), ['name' => '', 'editing_partner_id' => $partner->id])
        ->assertOk()
        ->assertSee('data-open-on-load', false)
        ->assertSee('action="'.route('admin.partners.update', $partner).'"', false);
});

test('new partners are appended to the end of the list', function () {
    Partner::factory()->create(['sort_order' => 4]);

    $this->actingAs(User::factory()->create())
        ->post(route('admin.partners.store'), [
            'name' => 'Сүүлийн хамтрагч',
            'logo' => UploadedFile::fake()->image('logo.png'),
            'is_active' => '1',
        ]);

    expect(Partner::firstWhere('name', 'Сүүлийн хамтрагч')->sort_order)->toBe(5);
});

test('partners can be reordered by dragging', function () {
    [$first, $second, $third] = Partner::factory()->count(3)->sequence(
        ['sort_order' => 0],
        ['sort_order' => 1],
        ['sort_order' => 2],
    )->create();

    $this->actingAs(User::factory()->create())
        ->patchJson(route('admin.partners.reorder'), ['partners' => [$third->id, $first->id, $second->id]])
        ->assertOk();

    expect(Partner::visible()->pluck('id')->all())->toBe([$third->id, $first->id, $second->id]);
});

test('reorder rejects unknown partners', function () {
    $this->actingAs(User::factory()->create())
        ->patchJson(route('admin.partners.reorder'), ['partners' => [999]])
        ->assertUnprocessable();
});

test('guests cannot reorder partners', function () {
    $this->patchJson(route('admin.partners.reorder'), ['partners' => [1]])->assertUnauthorized();
});

test('logo is required and must be an image', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('admin.partners.store'), ['name' => 'Нэр'])
        ->assertSessionHasErrors('logo');

    $this->post(route('admin.partners.store'), [
        'name' => 'Нэр',
        'logo' => UploadedFile::fake()->create('logo.svg', 10, 'image/svg+xml'),
    ])->assertSessionHasErrors('logo');
});

test('partner can be updated without replacing the logo', function () {
    $partner = Partner::factory()->create(['logo_path' => 'partners/original.png']);

    $this->actingAs(User::factory()->create())
        ->put(route('admin.partners.update', $partner), [
            'name' => 'Шинэ нэр',
            'is_active' => '0',
        ])
        ->assertRedirect(route('admin.partners.index'))
        ->assertSessionHasNoErrors();

    $partner->refresh();

    expect($partner->name)->toBe('Шинэ нэр')
        ->and($partner->logo_path)->toBe('partners/original.png')
        ->and($partner->is_active)->toBeFalse();
});

test('replacing the logo deletes the old file', function () {
    $oldLogoPath = UploadedFile::fake()->image('old.png')->store('partners', Partner::LOGO_DISK);
    $partner = Partner::factory()->create(['logo_path' => $oldLogoPath]);

    $this->actingAs(User::factory()->create())
        ->put(route('admin.partners.update', $partner), [
            'name' => $partner->name,
            'logo' => UploadedFile::fake()->image('new.png'),
            'is_active' => '1',
        ])
        ->assertSessionHasNoErrors();

    Storage::disk(Partner::LOGO_DISK)->assertMissing($oldLogoPath);
    Storage::disk(Partner::LOGO_DISK)->assertExists($partner->fresh()->logo_path);
});

test('deleting a partner removes its logo', function () {
    $logoPath = UploadedFile::fake()->image('logo.png')->store('partners', Partner::LOGO_DISK);
    $partner = Partner::factory()->create(['logo_path' => $logoPath]);

    $this->actingAs(User::factory()->create())
        ->delete(route('admin.partners.destroy', $partner))
        ->assertRedirect(route('admin.partners.index'));

    $this->assertModelMissing($partner);
    Storage::disk(Partner::LOGO_DISK)->assertMissing($logoPath);
});

test('home page shows visible partners in a marquee', function () {
    Partner::factory()->create(['name' => 'Харагдах Хамтрагч', 'website_url' => 'https://partner.mn']);
    Partner::factory()->hidden()->create(['name' => 'Нуусан Хамтрагч']);

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('Хамтрагч байгууллагууд')
        ->assertSee('alt="Харагдах Хамтрагч"', false)
        ->assertSee('href="https://partner.mn"', false)
        ->assertDontSee('Нуусан Хамтрагч');
});

test('partners section is hidden when there are no visible partners', function () {
    Partner::factory()->hidden()->create();

    $this->get(route('home'))
        ->assertOk()
        ->assertDontSee('id="partners"', false);
});
