<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developements extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'development';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "contacts_id",
        "have_website",
        "website_type",
        "website_value",
        "website_link",
        "website_dev_date",
        "have_crm",
        "crm_type",
        "crm_dev",
        "crm_name",
        "erp_name",
        "crm_dev_date",
        "agency_name",
    ];
}
