<?php

namespace Infrastructure\Persistence\Eloquent\Repositories;

use Domains\ACL\Profiles\Contracts\ProfileRepository as ContractsProfileRepository;
use Domains\ACL\Profiles\DataTransferObjects\IndexProfilesPaginationData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesPaginatedData;
use Domains\ACL\Profiles\DataTransferObjects\SearchProfilesPaginationData;
use Domains\ACL\Profiles\Exceptions\ProfileNotFoundException;
use Infrastructure\Persistence\Eloquent\Models\Profile;
use Infrastructure\Shared\AbstractRepository;

class ProfileRepository extends AbstractRepository implements ContractsProfileRepository
{
    protected $modelClass = Profile::class;

    public function findById(int $id, array $with = []): ProfilesData
    {
        $profile = $this->model->with($with)->find($id)?->toArray();

        if (!$profile) {
            throw new ProfileNotFoundException();
        }

        return ProfilesData::createFromArray($profile);
    }

    public function create(ProfilesData $profileData): bool
    {
        return (bool) $this->model->create($profileData->except('id')->toArray());
    }

    public function update(int $id, ProfilesData $profileData): bool
    {
        $profile = $this->model->find($id);

        if (!$profile) {
            throw new ProfileNotFoundException();
        }

        return (bool) $profile->update($profileData->except('id')->toArray());
    }

    public function delete(int $id): bool
    {
        $profile = $this->model->find($id);

        if (!$profile) {
            throw new ProfileNotFoundException();
        }

        return (bool) $profile->delete();
    }

    public function getAllProfilesPaginated(IndexProfilesPaginationData $profilesPaginationData, array $with = []): ProfilesPaginatedData
    {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->when($profilesPaginationData->order, function ($query) use ($profilesPaginationData) {
                $query->orderBy($profilesPaginationData->order, $profilesPaginationData->sort);
            })
            ->latest()
            ->paginate($profilesPaginationData->per_page, $profilesPaginationData->page);

        return ProfilesPaginatedData::createFromPaginator($profiles);
    }

    public function getAllProfilesByPermissionIdPaginated(
        int $permissionId,
        IndexProfilesPaginationData $profilesPaginationData,
        array $with = []
    ): ProfilesPaginatedData {
        $profiles = $this->model
            ->select()
            ->with($with)
            ->whereHas('permissions', function ($query) use ($permissionId) {
                $query->where('permissions.id', $permissionId);
            })
            ->when($profilesPaginationData->order, function ($query) use ($profilesPaginationData) {
                $query->orderBy($profilesPaginationData->order, $profilesPaginationData->sort);
            })
            ->latest()
            ->paginate($profilesPaginationData->per_page, $profilesPaginationData->page);

        return ProfilesPaginatedData::createFromPaginator($profiles);
    }

    public function searchByNameAndDescription(SearchProfilesPaginationData $profilesPaginationData, array $with = []): ProfilesPaginatedData
    {
        $profiles = $this->model
            ->select()
            ->where('name', 'ilike', "%{$profilesPaginationData->filter}%")
            ->orWhere('description', 'ilike', "%{$profilesPaginationData->filter}%")
            ->latest()
            ->paginate($profilesPaginationData->per_page, $profilesPaginationData->page);

        return ProfilesPaginatedData::createFromPaginator($profiles);
    }

    public function attachPermissionsInProfile(int $profileId, array $permissions): bool
    {
        $profile = $this->model->find($profileId);

        if (!$profile) {
            throw new ProfileNotFoundException();
        }

        return (bool) $profile->permissions()->attach($permissions);
    }

    public function detachProfilePermission(int $profileId, int $permissionId): bool
    {
        $profile = $this->model->find($profileId);

        if (!$profile) {
            throw new ProfileNotFoundException();
        }

        return (bool) $profile->permissions()->detach($permissionId);
    }
}
