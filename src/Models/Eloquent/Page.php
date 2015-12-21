<?php
namespace Yeoji\ParshCMS\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';

    protected $guarded = [];

    /**
     * A page belongs to a theme
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * A page has one associated content
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function content()
    {
        return $this->hasOne(PageContent::class);
    }
}