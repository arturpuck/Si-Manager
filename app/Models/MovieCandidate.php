<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nationality;
use App\Models\Location;
use App\Models\StoryOrCostumeType;

class MovieCandidate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function actressNationality()
    {
        return $this->belongsTo(Nationality::class, 'actress_nationality_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'action_location_id');
    }

    public function storyOrCostumeType()
    {
        return $this->belongsTo(StoryOrCostumeType::class, 'story_or_costume_type_id');
    }
}
