<?php

namespace App\Http\Controllers\CMS\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use DB;

class HomepageSliderController extends Controller
{
    private $baseView;
    
    public function __construct()
    {
        $this->baseView = 'cms/website/homepage-sliders';
    }

    public function index()
    {
        $sliders = Slider::oldest('sort')->get();
        return view($this->baseView . '/index', compact('sliders'));
    }

    public function create()
    {
        return view($this->baseView . '/create');
    }

    public function store(SliderRequest $request)
    {

        $finalThumbnail = '';
        if ($request->hasFile('thumbnail')) {
            $finalThumbnail = $this->fileUploadHandler($request->thumbnail, 'uploads/sliders/');
        }

        $slider = new Slider;
        $slider->title = $request->title;
        $slider->thumbnail = $finalThumbnail;
        $slider->sort = $request->sort;
        $slider->save();

        return back()->with('success', 'New slider has been added.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view($this->baseView . '/edit', compact('slider'));
    }

    public function update(SliderRequest $request, $id)
    {

        $slider = Slider::findOrFail($id);

        $finalThumbnail = $slider->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if (!empty($slider->thumbnail) && file_exists(public_path('uploads/sliders/' . $slider->thumbnail))) {
                unlink(public_path('uploads/sliders/' . $slider->thumbnail));
            }
            $finalThumbnail = $this->fileUploadHandler($request->thumbnail, 'uploads/sliders/');
        }

        $slider->title = $request->title;
        $slider->thumbnail = $finalThumbnail;
        $slider->sort = $request->sort;
        $slider->save();

        return back()->with('success', 'Slider updated successfully.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        if (!empty($slider->thumbnail) && file_exists(public_path('uploads/sliders/' . $slider->thumbnail))) {
            unlink(public_path('uploads/sliders/' . $slider->thumbnail));
        }

        $slider->delete();
        return redirect()->route('homepage-sliders.index')->with('success', 'Slider deleted successfully.');
    }

    // public function destroy($id)
    // {
    //     $slider = Slider::findOrFail($id);
    //     $message = 'deactivated';
    //     $isActive = false;

    //     if (!$slider->is_active) {
    //         $message = 'activated';
    //         $isActive = true;
    //     }

    //     $slider->is_active = $isActive;
    //     $slider->save();

    //     return redirect()->route('homepage-sliders.index')->with('success', 'Slider '.$message.' successfully.');
    // }
}
