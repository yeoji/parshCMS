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
     * @param $category
     * @return Model
     */
    public function addPage($pageAttributes, $category = null)
    {
        // create a new page record
        $page = $this->pages()->create([
            'category_id' => $category ? $category->id : 0,
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