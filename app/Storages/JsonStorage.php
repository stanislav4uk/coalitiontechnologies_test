<?php

namespace App\Storages;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;

/**
 * Class JsonStorage
 * @package App\Storages
 */
class JsonStorage
{
    /**
     * @var Collection
     */
    private $content;

    /**
     * @var Filesystem
     */
    private $files;

    /**
     * @var string
     */
    private $pk;
    private $pathToFile;

    /**
     * @param Filesystem $files
     * @param $pathToFile
     * @param string $pk
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function __construct(Filesystem $files, $pathToFile, $pk = 'id')
    {
        $this->pk = $pk;
        $this->files = $files;
        $this->pathToFile = $pathToFile;
        $this->content = new Collection();

        if (!$this->files->exists($pathToFile)) {
            $this->files->put($pathToFile, null);
        }

        if ($content = $this->files->get($pathToFile)) {
            try {
                $data = json_decode($content, true);

                foreach ($data as $item) {
                    $this->content->put($item[$this->pk], $item);
                }
            }
            catch (\Exception $e) {
                abort(500, "Storage has been corrupted");
            }
        }
    }

    /**
     * Save data to file
     */
    public function __destruct()
    {
        $this->files->put($this->pathToFile, $this->content->toJson());
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->content;
    }

    /**
     * Save or update record
     *
     * @param array $data
     * @return int
     */
    public function save(array $data)
    {
        if (empty($data[$this->pk])) {
            $data[$this->pk] = $this->generateId();
        }

        $this->content->put($data[$this->pk], $data);

        return $data[$this->pk];
    }

    /**
     * @return int
     */
    protected function generateId()
    {
        $keys = $this->content->keys()->all();
        return ($keys) ? max($keys) + 1 : 1;
    }
}