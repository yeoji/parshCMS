<?php
namespace Yeoji\ParshCMS\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';

    protected $guarded = [];

    /**
     * A theme can have many pages
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    /**
     * Associates a page with the theme
     * @param $pageAttributes
     * @return Model
     */
    public function addPage($pageAttributes)
    {
        // create a new page record
        $page = $this->pages()->create([
            'title' => $pageAttributes['title'],
            'key' => $pageAttributes['key']
        ]);
        if ($page) {
            $page->content()->create([
                'content' => $pageAttributes['content']
            ]);
        }
        return $page;
    }
}