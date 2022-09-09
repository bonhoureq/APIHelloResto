<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "grade",
        "localization",
        "phone_number",
        "website",
        "hours"
    ];
    protected $guarded = [];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
