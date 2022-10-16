<?php

namespace Domains\Tenants\Actions;

use Domains\Tenants\Contracts\TenantRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageTenantImageAction
{
    public function __construct(private TenantRepository $tenantRepository)
    {
    }

    public function __invoke(int $id, UploadedFile $image): string
    {
        $tenant = $this->tenantRepository->find($id);

        if (Storage::exists($tenant->image)) {
            Storage::delete($tenant->image);
        }

        $uuid = auth()->user()->tenant->uuid;

        return Storage::putFile("tenants/{$uuid}", $image);
    }
}
