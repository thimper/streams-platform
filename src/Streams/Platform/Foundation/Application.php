<?php namespace Streams\Platform\Foundation;

use Illuminate\Container\Container;

class Application
{
    /**
     * The application reference.
     *
     * @var null
     */
    protected $reference = null;

    /**
     * Keep installed status around.
     *
     * @var null
     */
    protected $installed = null;

    /**
     * The application model.
     *
     * @var ApplicationModel
     */
    protected $model;

    /**
     * Create a new Application instance
     */
    public function __construct(ApplicationModel $model = null)
    {
        $this->model = $model;
    }

    /**
     * Setup the application.
     */
    public function setup()
    {
        $this->setTablePrefix();
    }

    /**
     * Set the database table prefix going forward.
     * We really don't need a core table from here on out.
     */
    public function setTablePrefix()
    {
        \Schema::getConnection()->getSchemaGrammar()->setTablePrefix($this->tablePrefix());
        \Schema::getConnection()->setTablePrefix($this->tablePrefix());
    }

    /**
     * Locate the app by request or passed variable and set the application reference.
     *
     * @return bool
     */
    public function locate($domain = null)
    {
        if (\Schema::hasTable('applications')) {
            if (!$this->reference) {
                if (!$domain) {
                    $domain = \Request::root();
                }

                if ($app = $this->model->findByDomain($domain)) {

                    $this->installed = true;

                    $this->reference = $app->reference;

                    return true;
                }

                //throw new \Exception('Could not locate app.');
                return false;
            }
        } else {
            //throw new \Exception('Could not locate app.');
            return false;
        }

        return true;
    }

    /**
     * Get the current app ref
     *
     * @return null
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Return the app reference.
     *
     * @return string
     */
    public function tablePrefix()
    {
        if (!$this->reference) {
            $this->locate();
        }

        return $this->reference . '_';
    }

    /**
     * Is the application installed?
     *
     * @return bool
     */
    public function isInstalled()
    {
        return ($this->installed or $this->locate());
    }

    /**
     * Has the application already been located?
     *
     * @return null
     */
    protected function isLocated()
    {
        return $this->installed;
    }
}
