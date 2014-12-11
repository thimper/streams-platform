<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Form\Contract\FormModelInterface;
use Anomaly\Streams\Platform\Ui\Form\Exception\IncompatibleModelException;

class StandardizeModelInputCommandHandler
{
    public function handle(StandardizeModelInputCommand $command)
    {
        $builder = $command->getBuilder();
        $table   = $builder->getForm();
        $model   = $builder->getModel();

        if (!$model) {
            return;
        }

        if (is_string($model)) {
            $model = app($model);
        }

        /**
         * If the model can extract a Stream then
         * set it on the table at this time so we
         * can use it later if we need.
         */
        if ($model instanceof EntryInterface) {
            $table->setStream($model->getStream());
        }

        if (!$model instanceof FormModelInterface) {
            throw new IncompatibleModelException("[get_class($model)] must implement Anomaly\\Streams\\Platform\\Ui\\Form\\Contract\\FormModelInterface");
        }

        $builder->setModel($model);
    }
}
