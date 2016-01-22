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

    /**
     * A page can belong to one category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(PageCategory::class);
    }

    /**
     * Handles the deletion of the page's content
     * and the page record from the database
     * @throws \Exception
     */
    public function deletePage()
    {
        $this->content->delete();
        $this->delete();
    }

    /**
     * Updates the page's content
     * @param $content
     */
    public function updateContent($content)
    {
        $currentContent = $this->content;
        $currentContent->content = $content;
        $currentContent->save();
    }

    /**
     * Update the page theme
     * @param $themeId
     */
    public function updateTheme($themeId)
    {
        $this->theme_id = $themeId;
        $this->save();
    }

    /**
     * Update page key
     * @param $key
     */
    public function updateKey($key)
    {
        $this->key = $key;
        $this->save();
    }

    /**
     * Update page title
     * @param $title
     */
    public function updateTitle($title)
    {
        $this->title = $title;
        $this->save();
    }
}