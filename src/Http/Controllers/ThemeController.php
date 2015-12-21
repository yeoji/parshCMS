<?php
namespace Yeoji\ParshCMS\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yeoji\ParshCMS\Http\Requests\StoreThemeRequest;
use Yeoji\ParshCMS\Repositories\Interfaces\ThemeRepository;

class ThemeController extends Controller
{
    /**
     * @var ThemeRepository
     */
    protected $themes;

    /**
     * @param ThemeRepository $themes
     */
    public function __construct(ThemeRepository $themes)
    {
        $this->themes = $themes;
    }

    /**
     * Retrieves a list of the resource
     * GET /themes
     */
    public function index()
    {
        // @TODO: pagination
        return view('parshcms::themes.index', ['themes' => $this->themes->all()]);
    }

    /**
     * Shows the form to create a resource
     * GET /themes/create
     */
    public function create()
    {
        return view('parshcms::themes.create');
    }

    /**
     * Creates a new resource
     * POST /themes
     * @param StoreThemeRequest $request
     */
    public function store(StoreThemeRequest $request)
    {
        $file = $request->file('template_file');
        $filename = Carbon::now()->toDateString() . '-' . $file->getClientOriginalName();
        if (preg_match('/.+\.blade\.php/', $filename) && $file->getClientMimeType() == 'text/php') {
            Storage::disk('local')->put('yeoji/parshCMS/templates/' . $filename,  File::get($file));

            $theme = $this->themes->create([
                'title' => $request->get('title'),
                'filename' => $filename
            ]);

            return Redirect::to('/parsh-admin/themes')->with('message', 'New template added!');
        }

        return Redirect::back()->withErrors(['Template file format has to be *.blade.php']);
    }

    /**
     * Shows the form to edit a resource
     * GET /themes/{id}/edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $theme = $this->themes->findOrFail($id);
        return view('parshcms::themes.edit', ['theme' => $theme]);
    }

    /**
     * Updates a resource in storage
     * PUT /themes/{id}
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        // only update title for now
        $theme = $this->themes->findOrFail($id);
        $theme->title = $request->get('title');
        $theme->save();

        return Redirect::to('/parsh-admin/themes')->with('message', 'Template has been updated.');
    }

    /**
     * Deletes a resource in storage
     * DELETE /themes/{id}
     * @param $id
     */
    public function destroy($id)
    {
        $theme = $this->themes->findOrFail($id);
        // delete template file
        Storage::disk('local')->delete('yeoji/parshCMS/templates/' . $theme->filename);
        $this->themes->delete($id);

        return Redirect::to('/parsh-admin/themes')->with('message', 'Template has been deleted');
    }

    /**
     * Returns the view to be rendered
     * for the theme preview
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPreview($id)
    {
        $theme = $this->themes->findOrFail($id);
        preg_match('/(.+)\.blade\.php/', $theme->filename, $name);

        return view("parshtemplates::{$name[1]}");
    }
}