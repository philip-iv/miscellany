<?php

namespace App\Models\Concerns;

trait Boosted
{
    /**
     * Cached boost value
     * @var null
     */
    protected $cachedBoosted = null;

    /**
     * List of boosts the campaign is receiving
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boosts()
    {
        return $this->hasMany('App\Models\CampaignBoost', 'campaign_id', 'id');
    }

    /**
     * Determine if the campaign is boosted
     * @return bool
     */
    public function boosted(): bool
    {
        if ($this->cachedBoosted === null) {
            $this->cachedBoosted = $this->boosts->count() > 0;
        }
        return $this->cachedBoosted;
    }
}