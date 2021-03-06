<?php


namespace App\Services;


use App\Models\Entity;
use App\Models\MiscModel;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class RecoveryService
{
    /**
     * @param array $params
     * @return $count
     */
    public function recover(array $params): int
    {
        $count = 0;
        $ids = Arr::get($params, 'ids', []);
        foreach ($ids as $id) {
            if ($this->entity($id)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Permanently delete old data
     * @return int
     */
    public function cleanup(): int
    {
        $count = 0;
        $entities = Entity::onlyTrashed()
            ->where('deleted_at', '<=', Carbon::now()->subMonth()->toDateString())
            ->get();

        foreach ($entities as $entity) {
            /** @var MiscModel $child */
            $child = $entity->child()->onlyTrashed()->first();
            if ($child) {
                $child->forceDelete();
            }

            $entity->forceDelete();

            $count++;
        }

        return $count;
    }

    /**
     * Restore an entity and it's child
     * @param int $id
     * @return bool if the restore worked
     */
    protected function entity(int $id): bool
    {
        $entity = Entity::onlyTrashed()->find($id);
        if (!$entity) {
            return false;
        }

        $child = $entity->child()->onlyTrashed()->first();
        if (!$child) {
            return false;
        }

        $entity->restore();

        // Refresh the child first to not re-trigger the entity creation on save
        $child->savingObserver = false;
        $child->refresh();
        $child->restore();
        return true;
    }
}
