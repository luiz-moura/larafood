<?php

namespace Interfaces\Http\Profiles\Controllers;

use Domains\ACL\Profiles\Actions\CreateProfileAction;
use Domains\ACL\Profiles\Actions\DeleteProfileAction;
use Domains\ACL\Profiles\Actions\FindProfileByIdAction;
use Domains\ACL\Profiles\Actions\GetAllProfilesPaginatedAction;
use Domains\ACL\Profiles\Actions\SearchProfileAction;
use Domains\ACL\Profiles\Actions\UpdateProfileAction;
use Domains\ACL\Profiles\DataTransferObjects\IndexProfilesPaginationData;
use Domains\ACL\Profiles\DataTransferObjects\ProfilesData;
use Domains\ACL\Profiles\DataTransferObjects\SearchProfilesPaginationData;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Infrastructure\Shared\Controller;
use Interfaces\Http\Profiles\Requests\IndexProfileRequest;
use Interfaces\Http\Profiles\Requests\SearchProfileRequest;
use Interfaces\Http\Profiles\Requests\StoreProfileRequest;

class ProfileController extends Controller
{
    public function index(
        IndexProfileRequest $request,
        GetAllProfilesPaginatedAction $getAllProfilesPaginatedAction
    ) {
        $indexProfilePaginationData = new IndexProfilesPaginationData($request->validated());
        $profiles = ($getAllProfilesPaginatedAction)($indexProfilePaginationData);

        return View::make('admin.pages.profiles.index', [
            'profiles' => $profiles->data,
            'pagination' => $profiles->pagination,
        ]);
    }

    public function create()
    {
        return View::make('admin.pages.profiles.create');
    }

    public function store(StoreProfileRequest $request, CreateProfileAction $createProfileAction)
    {
        $profileData = ProfilesData::createFromArray($request->validated());
        $success = ($createProfileAction)($profileData);

        return Redirect::route('profiles.index');
    }

    public function edit(int $id, FindProfileByIdAction $findProfileById)
    {
        $profile = ($findProfileById)($id);

        return View::make('admin.pages.profiles.edit', compact('profile'));
    }

    public function update(
        int $id,
        StoreProfileRequest $request,
        UpdateProfileAction $updateProfileAction
    ) {
        $profileData = ProfilesData::createFromArray($request->validated());
        $success = ($updateProfileAction)($id, $profileData);

        return Redirect::route('profiles.index');
    }

    public function show(int $id, FindProfileByIdAction $findProfileById)
    {
        $profile = ($findProfileById)($id);

        return View::make('admin.pages.profiles.show', compact('profile'));
    }

    public function destroy(int $id, DeleteProfileAction $deleteProfileAction)
    {
        $success = ($deleteProfileAction)($id);

        return Redirect::route('profiles.index');
    }

    public function search(SearchProfileRequest $request, SearchProfileAction $searchProfileAction)
    {
        $searchProfilesPaginationData = new SearchProfilesPaginationData($request->all());

        $profiles = ($searchProfileAction)($searchProfilesPaginationData);

        return View::make('admin.pages.profiles.index', [
            'profiles' => $profiles->data,
            'pagination' => $profiles->pagination,
        ]);
    }
}
