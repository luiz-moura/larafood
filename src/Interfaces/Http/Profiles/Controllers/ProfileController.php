<?php

namespace Interfaces\Http\Profiles\Controllers;

use Domains\ACL\Profiles\Actions\CreateProfileAction;
use Domains\ACL\Profiles\Actions\DeleteProfileAction;
use Domains\ACL\Profiles\Actions\FindProfileAction;
use Domains\ACL\Profiles\Actions\GetAllProfilesAction;
use Domains\ACL\Profiles\Actions\SearchProfileAction;
use Domains\ACL\Profiles\Actions\UpdateProfileAction;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Profiles\DataTransferObjects\IndexProfileRequestData;
use Interfaces\Http\Profiles\DataTransferObjects\ProfileFormData;
use Interfaces\Http\Profiles\DataTransferObjects\SearchProfileRequestData;
use Interfaces\Http\Profiles\Requests\IndexProfileRequest;
use Interfaces\Http\Profiles\Requests\SearchProfileRequest;
use Interfaces\Http\Profiles\Requests\StoreProfileRequest;

class ProfileController extends Controller
{
    public function index(
        IndexProfileRequest $request,
        GetAllProfilesAction $getAllProfilesAction
    ) {
        $paginationData = IndexProfileRequestData::fromRequest($request->validated());
        $paginatedData = $getAllProfilesAction($paginationData);

        return view('admin.pages.profiles.index', [
            'profiles' => $paginatedData->data,
            'pagination' => $paginatedData->pagination,
        ]);
    }

    public function create()
    {
        return view('admin.pages.profiles.create');
    }

    public function store(StoreProfileRequest $request, CreateProfileAction $createProfileAction)
    {
        $profileData = ProfileFormData::fromRequest($request->validated());
        $createProfileAction($profileData);

        return to_route('profiles.index');
    }

    public function edit(int $id, FindProfileAction $findProfileAction)
    {
        $profile = $findProfileAction($id);

        return view('admin.pages.profiles.edit', compact('profile'));
    }

    public function update(
        int $id,
        StoreProfileRequest $request,
        UpdateProfileAction $updateProfileAction
    ) {
        $profileData = ProfileFormData::fromRequest($request->validated());
        $updateProfileAction($id, $profileData);

        return to_route('profiles.index');
    }

    public function show(int $id, FindProfileAction $findProfileAction)
    {
        $profile = $findProfileAction($id);

        return view('admin.pages.profiles.show', compact('profile'));
    }

    public function destroy(int $id, DeleteProfileAction $deleteProfileAction)
    {
        $deleteProfileAction($id);

        return to_route('profiles.index');
    }

    public function search(SearchProfileRequest $request, SearchProfileAction $searchProfileAction)
    {
        $paginationData = SearchProfileRequestData::fromRequest($request->validated());
        $profileData = $searchProfileAction($paginationData);

        return view('admin.pages.profiles.index', [
            'profiles' => $profileData->data,
            'pagination' => $profileData->pagination,
        ]);
    }
}
