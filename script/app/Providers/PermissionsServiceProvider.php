<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $results = [];

    /**
     * Set the result array permissions and errors.
     *
     * @return mixed
     */
    public function __construct()
    {
        $this->results['permissions'] = [];
        $this->results['errors'] = null;
    }

    /**
     * Check for the folders permissions.
     *
     * @param array $folders
     * @return array
     */
    public function check()
    {
        $folders=[
            base_path() => '775',
            base_path('.env') => '775',
            str_replace('/script', '', base_path('uploads')) => '775',
            base_path('routes') => '775',
        ];
        foreach ($folders as $folder => $permission) {
            if (!($this->getPermission($folder) >= $permission)) {
                $this->addFileAndSetErrors($folder, $permission, false);
            } else {
                $this->addFile($folder, $permission, true);
            }
        }
        return $this->results;
    }

    /**
     * Get a folder permission.
     *
     * @param $folder
     * @return string
     */
    private function getPermission($folder)
    {

        return substr(sprintf('%o', fileperms($folder)), -4);
    }

    /**
     * Add the file and set the errors.
     *
     * @param $folder
     * @param $permission
     * @param $isSet
     */
    private function addFileAndSetErrors($folder, $permission, $isSet)
    {
        $this->addFile($folder, $permission, $isSet);
        $this->results['errors'] = true;
    }

    /**
     * Add the file to the list of results.
     *
     * @param $folder
     * @param $permission
     * @param $isSet
     */
    private function addFile($folder, $permission, $isSet)
    {
        array_push($this->results['permissions'], [
            'folder' => $folder,
            'permission' => $permission,
            'isSet' => $isSet,
        ]);
    }
}
